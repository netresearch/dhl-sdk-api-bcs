<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
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
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ErrorHandlerDecorator extends AbstractDecorator
{
    /**
     * Transform SOAP Faults into appropriate exceptions.
     *
     * @param \SoapFault $fault
     * @return AuthenticationException|ClientException|ClientException|ServerException
     */
    private function createServiceException(\SoapFault $fault): ServiceException
    {
        if ($fault->faultcode === 'HTTP' && $fault->faultstring === 'Unauthorized') {
            return new AuthenticationException($fault->getMessage(), 401, $fault);
        }

        if (false !== strpos($fault->faultcode, 'Client')) {
            return new ClientException(sprintf('[%s] %s', $fault->faultcode, $fault->getMessage()), 400, $fault);
        }

        if (false !== strpos($fault->faultcode, 'Server')) {
            return new ServerException(sprintf('[%s] %s', $fault->faultcode, $fault->getMessage()), 500, $fault);
        }

        return new ClientException($fault->getMessage(), $fault->getCode(), $fault);
    }

    /**
     * Transform error responses into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     * @return void
     * @throws AuthenticationException
     * @throws ServerException
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function validateResponse(StatusInformation $responseStatus)
    {
        if (in_array($responseStatus->getStatusCode(), [1001, 112], true)) {
            // login failed | password expired
            throw new AuthenticationException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        } elseif (in_array($responseStatus->getStatusCode(), [500, 1000], true)) {
            // Service temporary not available | General error
            throw new ServerException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        }
    }

    /**
     * Transform shipment creation errors into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     * @param CreationState[] $creationStates
     * @return void
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function validateCreateShipmentResponse(StatusInformation $responseStatus, array $creationStates)
    {
        $this->validateResponse($responseStatus);

        if ($responseStatus->getStatusCode() === 1101) {
            // Hard validation error occured
            $messages = array_reduce(
                $creationStates,
                function (array $messages, CreationState $creationState) {
                    $messages = array_merge($messages, $creationState->getLabelData()->getStatus()->getStatusMessage());

                    return $messages;
                },
                []
            );

            array_unshift($messages, $responseStatus->getStatusText());
            $messages = array_unique($messages);

            $message = implode(' ', $messages);
            throw new ClientException($message, $responseStatus->getStatusCode());
        }
    }

    /**
     * Transform shipment deletion errors into appropriate exceptions.
     *
     * @param StatusInformation $responseStatus
     * @param DeletionState[] $deletionStates
     * @return void
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     * @link https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function validateDeleteShipmentResponse(StatusInformation $responseStatus, array $deletionStates)
    {
        $this->validateResponse($responseStatus);

        if ($responseStatus->getStatusCode() === 2000) {
            // Unknown shipment number, check item status
            $allFailed = array_reduce(
                $deletionStates,
                function (bool $fail, DeletionState $deletionState) {
                    return ($fail && ($deletionState->getStatus()->getStatusCode() !== 0));
                },
                true
            );

            if ($allFailed) {
                // no successfully cancelled shipments in response
                throw new ClientException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
            }
        }
    }

    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param CreateShipmentOrderRequest $requestType
     * @return CreateShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     * @throws ServiceException
     */
    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        try {
            /** @var CreateShipmentOrderResponse $response */
            $response = parent::createShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            $exception = $this->createServiceException($fault);
            throw $exception;
        }

        $this->validateCreateShipmentResponse($response->getStatus(), $response->getCreationState());

        return $response;
    }

    /**
     * Cancel earlier created shipments. Cancellation is only possible before the end-of-the-day manifest.
     *
     * @param DeleteShipmentOrderRequest $requestType
     * @return DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     * @throws ServiceException
     */
    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        try {
            /** @var DeleteShipmentOrderResponse $response */
            $response = parent::deleteShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            $exception = $this->createServiceException($fault);
            throw $exception;
        }

        $this->validateDeleteShipmentResponse($response->getStatus(), $response->getDeletionState());

        return $response;
    }
}
