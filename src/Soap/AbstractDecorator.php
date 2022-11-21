<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\GetVersion\GetVersionResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentResponse;

/**
 * AbstractDecorator
 *
 * Wrapper around actual soap client to perform the following tasks:
 * - add authentication
 * - transform errors into exceptions
 * - log communication
 */
abstract class AbstractDecorator extends AbstractClient
{
    /**
     * @var AbstractClient
     */
    private $client;

    public function __construct(AbstractClient $client)
    {
        $this->client = $client;
    }

    public function getVersion(Version $requestType): GetVersionResponse
    {
        return $this->client->getVersion($requestType);
    }

    public function validateShipment(ValidateShipmentOrderRequest $requestType): ValidateShipmentResponse
    {
        return $this->client->validateShipment($requestType);
    }

    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        return $this->client->createShipmentOrder($requestType);
    }

    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        return $this->client->deleteShipmentOrder($requestType);
    }
}
