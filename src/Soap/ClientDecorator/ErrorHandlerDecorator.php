<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedErrorException;
use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\ResponseType\CreationState;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractDecorator;

/**
 * ErrorHandlerDecorator
 *
 * Handle errors when a response was received, i.e. no soap fault occurred.
 *
 * @author Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class ErrorHandlerDecorator extends AbstractDecorator
{
    const AUTH_ERROR_MESSAGE = 'Authentication failed. Please check your access credentials.';
    const FAULT_CODE_HTTP    = 'HTTP';
    const FAULT_UNAUTHORIZED = 'Unauthorized';

    /**
     * Transform error responses into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     *
     * @return void
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     *
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function validateResponse(StatusInformation $responseStatus)
    {
        if (in_array($responseStatus->getStatusCode(), [112, 118, 1001], true)) {
            // password expired | invalid credentials | login failed
            throw new AuthenticationErrorException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        }

        if (in_array($responseStatus->getStatusCode(), [500, 1000], true)) {
            // Service temporary not available | General error
            throw new DetailedErrorException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        }
    }

    /**
     * Transform shipment creation errors into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     * @param CreationState[] $creationStates
     *
     * @return void
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     *
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function validateCreateShipmentResponse(StatusInformation $responseStatus, array $creationStates)
    {
        $this->validateResponse($responseStatus);

        if ($responseStatus->getStatusCode() === 1101) {
            // Hard validation error occurred
            $messages = array_reduce(
                $creationStates,
                static function (array $messages, CreationState $creationState) {
                    $messages = array_merge($messages, $creationState->getLabelData()->getStatus()->getStatusMessage());

                    return $messages;
                },
                []
            );

            array_unshift($messages, $responseStatus->getStatusText());
            $messages = array_unique($messages);
            $message = implode(' ', $messages);

            throw new DetailedErrorException($message, $responseStatus->getStatusCode());
        }
    }

    /**
     * Transform shipment deletion errors into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     * @param DeletionState[] $deletionStates
     *
     * @return void
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     *
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function validateDeleteShipmentResponse(StatusInformation $responseStatus, array $deletionStates)
    {
        $this->validateResponse($responseStatus);

        if ($responseStatus->getStatusCode() === 2000) {
            // Unknown shipment number, check item status
            $allFailed = array_reduce(
                $deletionStates,
                static function (bool $fail, DeletionState $deletionState) {
                    return ($fail && ($deletionState->getStatus()->getStatusCode() !== 0));
                },
                true
            );

            if ($allFailed) {
                // no successfully cancelled shipments in response
                throw new DetailedErrorException(
                    $responseStatus->getStatusText(),
                    $responseStatus->getStatusCode()
                );
            }
        }
    }

    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        try {
            /** @var CreateShipmentOrderResponse $response */
            $response = parent::createShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            if ($fault->faultcode === self::FAULT_CODE_HTTP && $fault->faultstring === self::FAULT_UNAUTHORIZED) {
                throw new AuthenticationErrorException(self::AUTH_ERROR_MESSAGE, 401, $fault);
            }

            throw $fault;
        }

        $this->validateCreateShipmentResponse($response->getStatus(), $response->getCreationState());

        return $response;
    }

    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        try {
            /** @var DeleteShipmentOrderResponse $response */
            $response = parent::deleteShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            if ($fault->faultcode === self::FAULT_CODE_HTTP && $fault->faultstring === self::FAULT_UNAUTHORIZED) {
                throw new AuthenticationErrorException(self::AUTH_ERROR_MESSAGE, 401, $fault);
            }

            throw $fault;
        }

        $this->validateDeleteShipmentResponse($response->getStatus(), $response->getDeletionState());

        return $response;
    }
}
