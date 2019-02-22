<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Service\ShipmentService;
use Psr\Log\LoggerInterface;

/**
 * Class SoapServiceFactory
 *
 * @package Dhl\Sdk\Paket\Bcs\Soap
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class SoapServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    /**
     * SoapServiceFactory constructor.
     * @param \SoapClient $soapClient
     */
    public function __construct(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    /**
     * Create the shipment service able to perform shipment operations (create, delete).
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     * @return ShipmentServiceInterface
     */
    public function createShipmentService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): ShipmentServiceInterface {
        $createShipmentResponseMapper = new CreateShipmentResponseMapper();
        $deleteShipmentResponseMapper = new DeleteShipmentResponseMapper();

        $pluginClient = new Client($this->soapClient);
        $pluginClient = new ErrorHandlerDecorator($pluginClient);
        $pluginClient = new LoggerDecorator($pluginClient, $this->soapClient, $logger);
        $pluginClient = new AuthenticationDecorator($pluginClient, $this->soapClient, $authStorage);

        $service = new ShipmentService(
            $pluginClient,
            $createShipmentResponseMapper,
            $deleteShipmentResponseMapper
        );

        return $service;
    }
}
