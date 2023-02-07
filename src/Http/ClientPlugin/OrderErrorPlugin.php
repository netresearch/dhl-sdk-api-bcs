<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Http\ClientPlugin;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationErrorHttpException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedErrorHttpException;
use Http\Client\Common\Plugin;
use Http\Client\Exception\HttpException;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class OrderErrorPlugin
 *
 * On request errors, throw an HTTP exception with message extracted from response.
 */
final class OrderErrorPlugin implements Plugin
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Returns TRUE if the response contains a detailed error response.
     *
     * @param ResponseInterface $response
     *
     * @return bool
     */
    private function isDetailedErrorResponse(ResponseInterface $response): bool
    {
        $contentTypes = $response->getHeader('Content-Type');
        return $contentTypes && ($contentTypes[0] === 'application/json');
    }

    private function createTechnicalErrorMessage(string $propertyPath, string $message): string
    {
        return sprintf('%s: %s', $propertyPath, $message);
    }

    /**
     * @param string[]|int[] $itemStatus
     * @param array{
     *            array{'property'?: string, 'validationState': string, 'validationMessage': string}
     *        }|array{} $itemMessages
     * @return string
     */
    private function createValidationErrorMessage(array $itemStatus, array $itemMessages): string
    {
        $message = '';

        if ($itemStatus['status'] === 200) {
            return $message;
        }

        $message .= $itemStatus['detail'] ?? $itemStatus['title'];

        if (empty($itemMessages)) {
            return $message;
        }

        $itemMessages = array_map(
            function (array $itemMessage) {
                if (!isset($itemMessage['property'])) {
                    return sprintf(
                        '%s: %s',
                        $itemMessage['validationState'],
                        $itemMessage['validationMessage']
                    );
                } else {
                    return sprintf(
                        '%s (%s): %s',
                        $itemMessage['validationState'],
                        $itemMessage['property'],
                        $itemMessage['validationMessage']
                    );
                }
            },
            $itemMessages
        );

        return $message . "\n" . implode("\n", $itemMessages);
    }

    /**
     * Try to extract the error message from the response. If not possible, return default message.
     *
     * @param array{
     *     'status': array{'title': string, 'status': int, 'detail': string},
     *     'items': array{
     *                  array{
     *                      'propertyPath': string,
     *                      'message': string
     *                 }
     *             }|array{
     *                  array{
     *                      'sequenceNumber'?: int,
     *                      'shipmentNo'?: string,
     *                      'sstatus': array{'title': string, 'status': int, 'detail'?: string},
     *                      'validationMessages'?: string[][]
     *                 }
     *             }
     * } $responseData
     * @param string $defaultMessage
     * @return string
     */
    private function createErrorMessage(array $responseData, string $defaultMessage): string
    {
        if (!isset($responseData['status'], $responseData['items'])) {
            return $defaultMessage;
        }

        $messages = array_map(
            function (array $responseItem) {
                if (isset($responseItem['propertyPath'], $responseItem['message'])) {
                    $message = $this->createTechnicalErrorMessage(
                        $responseItem['propertyPath'],
                        $responseItem['message']
                    );
                } elseif (isset($responseItem['sstatus'])) {
                    $message = $this->createValidationErrorMessage(
                        $responseItem['sstatus'],
                        $responseItem['validationMessages'] ?? []
                    );
                } else {
                    $message = '';
                }

                if ($message && isset($responseItem['shipmentNo'])) {
                    $message = sprintf('[%s] %s', $responseItem['shipmentNo'], $message);
                } elseif ($message && isset($responseItem['sequenceNumber'])) {
                    $message = sprintf('[%s] %s', $responseItem['sequenceNumber'], $message);
                }

                return $message;
            },
            $responseData['items']
        );

        $messages = array_filter($messages);
        sort($messages);

        $responseStatus = $responseData['status'];
        array_unshift($messages, sprintf('Error %s: %s', $responseStatus['status'], $responseStatus['detail']));

        return implode("\n", $messages);
    }

    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        /** @var Promise $promise */
        $promise = $next($request);
        $fnFulfilled = function (ResponseInterface $response) use ($request) {
            $statusCode = $response->getStatusCode();

            if (!$this->isDetailedErrorResponse($response)) {
                if ($statusCode === 401 || $statusCode === 403) {
                    $errorMessage = 'Authentication failed. Please check your access credentials.';
                    throw new AuthenticationErrorHttpException($errorMessage, $request, $response);
                }

                if ($statusCode >= 400 && $statusCode < 600) {
                    throw new HttpException($response->getReasonPhrase(), $request, $response);
                }
            } else {
                $responseJson = (string)$response->getBody();
                $responseData = \json_decode($responseJson, true);
                $errorMessage = $this->createErrorMessage($responseData, $response->getReasonPhrase());

                if ($statusCode === 401 || $statusCode === 403) {
                    throw new AuthenticationErrorHttpException($errorMessage, $request, $response);
                }

                if ($statusCode >= 400 && $statusCode < 600) {
                    throw new DetailedErrorHttpException($errorMessage, $request, $response);
                }

                if ($statusCode === 207) {
                    $itemStatus = array_unique(
                        array_map(
                            function (array $responseItem) {
                                return $responseItem['sstatus']['status'];
                            },
                            $responseData['items']
                        )
                    );

                    if (!in_array(200, $itemStatus)) {
                        // all failed
                        throw new DetailedErrorHttpException($errorMessage, $request, $response);
                    } elseif (count($itemStatus) > 1) {
                        // some failed
                        $this->logger->error($errorMessage);
                    }
                }
            }

            // no error
            return $response;
        };

        return $promise->then($fnFulfilled);
    }
}
