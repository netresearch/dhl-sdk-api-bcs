<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ValidateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Service\ShipmentService;
use Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator\AuthenticationDecorator;
use Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator\ErrorHandlerDecorator;
use Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator\LoggerDecorator;
use Psr\Log\LoggerInterface;

class SoapServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    public function __construct(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    public function createShipmentService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): ShipmentServiceInterface {
        $validateShipmentResponseMapper = new ValidateShipmentResponseMapper();
        $createShipmentResponseMapper = new CreateShipmentResponseMapper();
        $deleteShipmentResponseMapper = new DeleteShipmentResponseMapper();

        $pluginClient = new Client($this->soapClient);
        $pluginClient = new ErrorHandlerDecorator($pluginClient);
        $pluginClient = new LoggerDecorator($pluginClient, $this->soapClient, $logger);
        $pluginClient = new AuthenticationDecorator($pluginClient, $this->soapClient, $authStorage);

        return new ShipmentService(
            $pluginClient,
            $validateShipmentResponseMapper,
            $createShipmentResponseMapper,
            $deleteShipmentResponseMapper
        );
    }
}
