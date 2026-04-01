<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceExceptionFactory;
use Dhl\Sdk\Paket\Bcs\Http\HttpServiceFactory;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Http\Discovery\Exception\NotFoundException;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Log\LoggerInterface;

class ServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var string
     */
    private $apiType;

    /**
     * @var string
     */
    private $userAgent;

    public function __construct(string $apiType = self::API_TYPE_SOAP, string $userAgent = '')
    {
        $this->apiType = $apiType;
        $this->userAgent = $userAgent;
    }

    /**
     * Create the service instance able to connect to the DHL "Parcel DE Shipping" web service.
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     *
     * @return ShipmentServiceInterface
     * @throws ServiceException
     */
    private function createRestService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): ShipmentServiceInterface {
        try {
            $httpClient = Psr18ClientDiscovery::find();
        } catch (NotFoundException $exception) {
            throw ServiceExceptionFactory::createServiceException($exception);
        }

        if ($sandboxMode) {
            $httpServiceFactory = new HttpServiceFactory($httpClient, $this->userAgent);
        } else {
            $httpServiceFactory = HttpServiceFactory::withSchemaValidationDisabled($httpClient, $this->userAgent);
        }

        return $httpServiceFactory->createShipmentService($authStorage, $logger, $sandboxMode);
    }

    /**
     * Create the service instance able to connect to the DHL "Business Customer Shipping" web service.
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     *
     * @return ShipmentServiceInterface
     * @throws ServiceException
     */
    private function createSoapService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): ShipmentServiceInterface {
        // the last publicly available WSDL version is 3.1.2, later features can only be booked via REST API
        $wsdl = sprintf(
            '%s/%s/%s',
            'https://cig.dhl.de/cig-wsdls/com/dpdhl/wsdl/geschaeftskundenversand-api',
            '3.1.2',
            'geschaeftskundenversand-api-3.1.2.wsdl'
        );

        $options = [
            'trace' => 1,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
            'login' => $authStorage->getApplicationId(),
            'password' => $authStorage->getApplicationToken(),
        ];

        if ($sandboxMode) {
            // override wsdl's default service location
            $options['location'] = self::SOAP_URL_SANDBOX;
        }

        try {
            $soapClient = new \SoapClient($wsdl, $options);
        } catch (\SoapFault $soapFault) {
            throw new ServiceException($soapFault->getMessage(), $soapFault->getCode(), $soapFault);
        }

        $soapServiceFactory = new SoapServiceFactory($soapClient);
        return $soapServiceFactory->createShipmentService($authStorage, $logger, $sandboxMode);
    }

    public function createShipmentService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): ShipmentServiceInterface {
        if ($this->apiType === self::API_TYPE_SOAP) {
            return $this->createSoapService($authStorage, $logger, $sandboxMode);
        } elseif ($this->apiType === self::API_TYPE_REST) {
            return $this->createRestService($authStorage, $logger, $sandboxMode);
        } else {
            throw new \RuntimeException('Cannot instantiate service of type ' . $this->apiType);
        }
    }
}
