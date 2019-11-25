<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;

/**
 * Class Client
 *
 * Wrapper around actual soap client to perform the following tasks:
 * - add authentication
 * - transform errors into exceptions
 * - log communication
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class Client extends AbstractClient
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    /**
     * Client constructor.
     * @param \SoapClient $soapClient
     */
    public function __construct(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
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
        /** @var CreateShipmentOrderResponse $response */
        $response = $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);

        return $response;
    }

    /**
     * @param DeleteShipmentOrderRequest $requestType
     * @return DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     */
    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        /** @var DeleteShipmentOrderResponse $response */
        $response = $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);

        return $response;
    }
}
