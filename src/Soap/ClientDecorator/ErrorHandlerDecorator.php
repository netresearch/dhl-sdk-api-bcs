<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
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
     * @throws ClientException
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
                throw new ClientException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
            case 2000:
                // Unknown shipment number, check item status
                /** @var DeleteShipmentOrderResponse $response */
                $deletionStates = $response->getDeletionState();
                /** @var DeletionState[] $deletionStates */
                $allFailed = array_reduce($deletionStates, function (bool $fail, DeletionState $deletionState) {
                    return ($fail && ($deletionState->getStatus()->getStatusCode() !== 0));
                }, true);

                if ($allFailed) {
                    // no successfully cancelled shipments in response
                    throw new ClientException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
                }

                // some shipments were cancelled successfully
                return $response;
            default:
                // ok | Weak validation error occured.
                return $response;
        }
    }

    /**
     * @param \SoapFault $fault
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    private function handleSoapFault(\SoapFault $fault)
    {
        if ($fault->faultcode === 'HTTP' && $fault->faultstring === 'Unauthorized') {
            throw new AuthenticationException($fault->getMessage(), 401, $fault);
        }

        if (false !== strpos($fault->faultcode, 'Client')) {
            throw new ClientException(sprintf('[%s] %s', $fault->faultcode, $fault->getMessage()), 400, $fault);
        }

        if (false !== strpos($fault->faultcode, 'Server')) {
            throw new ServerException(sprintf('[%s] %s', $fault->faultcode, $fault->getMessage()), 500, $fault);
        }

        throw new ClientException($fault->getMessage(), $fault->getCode(), $fault);
    }

    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param CreateShipmentOrderRequest $requestType
     * @return CreateShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     */
    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        try {
            $response = parent::createShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            $exception = $this->handleSoapFault($fault);
            throw $exception;
        }

        /** @var CreateShipmentOrderResponse $response */
        $response = $this->handleResponseError($response);

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
     */
    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        try {
            $response = parent::deleteShipmentOrder($requestType);
        } catch (\SoapFault $fault) {
            $exception = $this->handleSoapFault($fault);
            throw $exception;
        }

        /** @var DeleteShipmentOrderResponse $response */
        $response = $this->handleResponseError($response);

        return $response;
    }
}
