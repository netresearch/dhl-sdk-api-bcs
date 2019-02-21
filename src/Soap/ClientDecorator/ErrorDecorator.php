<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;

/**
 * ErrorDecorator
 *
 * Handle errors when a response was received, i.e. no soap fault occurred.
 *
 * @package Dhl\Sdk\Paket\Bcs\Soap
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ErrorDecorator extends AbstractDecorator
{
    /**
     * @param AbstractResponse $response
     * @return AbstractResponse
     * @throws AuthenticationException
     */
    private function handleErrors(AbstractResponse $response)
    {
        $responseStatus = $response->getStatus();
        if ($responseStatus->getStatusCode() === 1001) {
            // login failed
            throw new AuthenticationException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        } elseif ($response->getStatus()->getStatusCode() === 112) {
            // password expired
            throw new AuthenticationException($responseStatus->getStatusText(), $responseStatus->getStatusCode());
        }

        return $response;
    }

    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param CreateShipmentOrderRequest $requestType
     * @return CreateShipmentOrderResponse
     * @throws AuthenticationException
     * @throws \SoapFault
     */
    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        $response = parent::createShipmentOrder($requestType);

        /** @var CreateShipmentOrderResponse $response */
        $response = $this->handleErrors($response);

        return $response;
    }

    /**
     * Cancel earlier created shipments. Cancellation is only possible before the end-of-the-day manifest.
     *
     * @param DeleteShipmentOrderRequest $requestType
     * @return DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws \SoapFault
     */
    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        $response = parent::deleteShipmentOrder($requestType);

        /** @var DeleteShipmentOrderResponse $response */
        $response = $this->handleErrors($response);

        return $response;
    }
}
