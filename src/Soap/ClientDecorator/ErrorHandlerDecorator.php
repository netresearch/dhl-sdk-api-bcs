<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedErrorException;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\ResponseType\CreationState;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\ResponseType\DeletionState;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\GetVersion\GetVersionResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ResponseType\ValidationState;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentResponse;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractDecorator;

/**
 * ErrorHandlerDecorator
 *
 * Handle errors when a response was received, i.e. no soap fault occurred.
 */
class ErrorHandlerDecorator extends AbstractDecorator
{
    public const AUTH_ERROR_MESSAGE = 'Authentication failed. Please check your access credentials.';
    public const FAULT_CODE_HTTP = 'HTTP';
    public const FAULT_UNAUTHORIZED = 'Unauthorized';

    /**
     * Transform error responses into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     *
     * @throws AuthenticationErrorException
     * @throws \Exception
     *
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function processResponse(StatusInformation $responseStatus): void
    {
        if (in_array($responseStatus->getStatusCode(), [112, 118, 1001], true)) {
            // password expired | invalid credentials | login failed
            throw new AuthenticationErrorException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        }

        if (in_array($responseStatus->getStatusCode(), [10, 500, 1000], true)) {
            // Service temporary not available | General error
            throw new \Exception($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        }
    }

    /**
     * Transform shipment validation errors into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     * @param ValidationState[] $validationStates
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     *
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function processValidateShipmentResponse(StatusInformation $responseStatus, array $validationStates): void
    {
        $this->processResponse($responseStatus);

        if ($responseStatus->getStatusCode() === 1101) {
            // Hard validation error occurred
            $messages = array_reduce(
                $validationStates,
                static function (array $messages, ValidationState $validationState) {
                    return array_merge($messages, $validationState->getStatus()->getStatusMessage());
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
     * Transform shipment creation errors into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     * @param CreationState[] $creationStates
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     *
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function processCreateShipmentResponse(StatusInformation $responseStatus, array $creationStates): void
    {
        $this->processResponse($responseStatus);

        if ($responseStatus->getStatusCode() === 1101) {
            // Hard validation error occurred
            $messages = array_reduce(
                $creationStates,
                static function (array $messages, CreationState $creationState) {
                    return array_merge($messages, $creationState->getLabelData()->getStatus()->getStatusMessage());
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
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     *
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function processDeleteShipmentResponse(StatusInformation $responseStatus, array $deletionStates): void
    {
        $this->processResponse($responseStatus);

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

    public function getVersion(Version $requestType): GetVersionResponse
    {
        try {
            $response = parent::getVersion($requestType);
        } catch (\SoapFault $fault) {
            if ($fault->faultcode === self::FAULT_CODE_HTTP && $fault->faultstring === self::FAULT_UNAUTHORIZED) {
                throw new AuthenticationErrorException(self::AUTH_ERROR_MESSAGE, 401, $fault);
            }

            throw $fault;
        }

        return $response;
    }

    public function validateShipment(ValidateShipmentOrderRequest $requestType): ValidateShipmentResponse
    {
        try {
            $response = parent::validateShipment($requestType);
        } catch (\SoapFault $fault) {
            if ($fault->faultcode === self::FAULT_CODE_HTTP && $fault->faultstring === self::FAULT_UNAUTHORIZED) {
                throw new AuthenticationErrorException(self::AUTH_ERROR_MESSAGE, 401, $fault);
            }

            throw $fault;
        }

        $this->processValidateShipmentResponse($response->getStatus(), $response->getValidationState());

        return $response;
    }

    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        try {
            $response = parent::createShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            if ($fault->faultcode === self::FAULT_CODE_HTTP && $fault->faultstring === self::FAULT_UNAUTHORIZED) {
                throw new AuthenticationErrorException(self::AUTH_ERROR_MESSAGE, 401, $fault);
            }

            throw $fault;
        }

        $this->processCreateShipmentResponse($response->getStatus(), $response->getCreationState());

        return $response;
    }

    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        try {
            $response = parent::deleteShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            if ($fault->faultcode === self::FAULT_CODE_HTTP && $fault->faultstring === self::FAULT_UNAUTHORIZED) {
                throw new AuthenticationErrorException(self::AUTH_ERROR_MESSAGE, 401, $fault);
            }

            throw $fault;
        }

        $this->processDeleteShipmentResponse($response->getStatus(), $response->getDeletionState());

        return $response;
    }
}
