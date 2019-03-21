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
use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
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
 * @package Dhl\Sdk\Paket\Bcs\Soap
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ErrorHandlerDecorator extends AbstractDecorator
{
    /**
     * Transform error responses into appropriate exceptions.
     *
     * @param AbstractResponse $response
     * @return AbstractResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @see https://entwickler.dhl.de/group/ep/allg.-fehlerbehandlung
     */
    private function handleResponseError(AbstractResponse $response)
    {
        $responseStatus = $response->getStatus();

        switch ($responseStatus->getStatusCode()) {
            case 1001:
            case 112:
                // login failed | password expired
                throw new AuthenticationException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
            case 500:
            case 1000:
                // Service temporary not available | General error
                throw new ServerException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
            case 1101:
                // Hard validation error occured
                // needs specific handling
            case 2000:
                // Unknown shipment number, check item status
                // needs specific handling
            default:
                // ok | Weak validation error occured.
                return $response;
        }
    }

    /**
     * Transform SOAP Faults into appropriate exceptions.
     *
     * @param \SoapFault $fault
     * @return AuthenticationException|ClientException|ClientException|ServerException
     */
    private function handleSoapFault(\SoapFault $fault): ServiceException
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
            throw $this->handleSoapFault($fault);
        }

        $response = $this->handleCreateShipmentResponseErrors($response);

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
            throw $this->handleSoapFault($fault);
        }

        $response = $this->handleDeleteShipmentResponseErrors($response);

        return $response;
    }

    /**
     * @param CreateShipmentOrderResponse $response
     * @return CreateShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     */
    private function handleCreateShipmentResponseErrors(
        CreateShipmentOrderResponse $response
    ): CreateShipmentOrderResponse {
        $this->handleResponseError($response);

        $responseStatus = $response->getStatus();
        if ($responseStatus->getStatusCode() === 1101) {
            // Hard validation error occured
            $creationStates = $response->getCreationState();
            /** @var CreationState[] $creationStates */
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

        return $response;
    }

    /**
     * @param DeleteShipmentOrderResponse $response
     * @return DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     */
    private function handleDeleteShipmentResponseErrors(
        DeleteShipmentOrderResponse $response
    ): DeleteShipmentOrderResponse {
        $this->handleResponseError($response);
        $responseStatus = $response->getStatus();
        if ($responseStatus->getStatusCode() === 2000) {
            // Unknown shipment number, check item status
            $deletionStates = $response->getDeletionState();
            /** @var DeletionState[] $deletionStates */
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

        // some or all shipments were cancelled successfully
        return $response;
    }
}
