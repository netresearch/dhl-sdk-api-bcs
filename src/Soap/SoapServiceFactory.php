<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\LabelServiceInterface;
use Dhl\Sdk\Paket\Bcs\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Service\LabelService;
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
     * @param AuthenticationStorageInterface $authStorage
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     * @return LabelServiceInterface
     */
    public function createLabelService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): LabelServiceInterface {
        $createShipmentResponseMapper = new CreateShipmentResponseMapper();
        $deleteShipmentResponseMapper = new DeleteShipmentResponseMapper();

        $authFactory = new AuthHeaderFactory();
        $authHeader  = $authFactory->create($authStorage->getUser(), $authStorage->getSignature());
        $this->soapClient->__setSoapHeaders([ $authHeader ]);


        $service = new LabelService(
            $this->soapClient,
            $logger,
            $createShipmentResponseMapper,
            $deleteShipmentResponseMapper
        );

        return $service;
    }
}
