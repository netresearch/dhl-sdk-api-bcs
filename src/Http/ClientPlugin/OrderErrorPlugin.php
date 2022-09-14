<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Http\ClientPlugin;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedErrorException;
use Http\Client\Common\Plugin;
use Http\Client\Exception\HttpException;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class OrderErrorPlugin
 *
 * On request errors, throw an HTTP exception with message extracted from response.
 */
final class OrderErrorPlugin implements Plugin
{
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

    /**
     * Try to extract the error message from the response. If not possible, return default message.
     *
     * @param string[] $responseData
     * @param string $defaultMessage
     * @return string
     */
    private function createErrorMessage(array $responseData, string $defaultMessage): string
    {
        if (isset($responseData['statusCode'], $responseData['statusText'])) {
            return sprintf('%s (Error %s)', $responseData['statusText'], $responseData['statusCode']);
        }
        if (isset($responseData['code'], $responseData['detail'])) {
            return sprintf('%s (Error %s)', $responseData['detail'], $responseData['code']);
        }
        return $defaultMessage;
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
                    throw new AuthenticationErrorException($errorMessage, $statusCode);
                }

                if ($statusCode >= 400 && $statusCode < 600) {
                    throw new HttpException($response->getReasonPhrase(), $request, $response);
                }
            } else {
                $responseJson = (string)$response->getBody();
                $responseData = \json_decode($responseJson, true);
                $errorMessage = $this->createErrorMessage($responseData, $response->getReasonPhrase());

                if ($statusCode === 401 || $statusCode === 403) {
                    throw new AuthenticationErrorException($errorMessage, $statusCode);
                }

                if ($statusCode >= 400 && $statusCode < 600) {
                    throw new DetailedErrorException($errorMessage, $statusCode);
                }
            }

            // no error
            return $response;
        };

        return $promise->then($fnFulfilled);
    }
}
