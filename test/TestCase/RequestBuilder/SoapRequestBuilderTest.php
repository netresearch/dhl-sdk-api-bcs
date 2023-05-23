<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\TestCase\RequestBuilder;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\RequestTypeExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\AbstractRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\CrossBorder;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\CrossBorderWithServices;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\Domestic;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\DomesticWithServices;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\Locker;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\PostOffice;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Credentials\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class SoapRequestBuilderTest extends TestCase
{
    private const REQUEST_TYPE = ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_SOAP;

    /**
     * @return mixed[]
     * @throws \Exception
     */
    public function simpleDataProvider(): array
    {
        $wsdl = __DIR__ . '/../../Provider/_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();
        $requestData = [new Domestic()];

        // response does not matter really, just to make it not fail
        $responseXml = \file_get_contents(__DIR__ . '/../../Provider/_files/createshipment/singleShipmentSuccess.xml');

        return [
            'label request' => [$wsdl, $authStorage, $requestData, $responseXml],
        ];
    }

    /**
     * @return mixed[]
     * @throws \Exception
     */
    public function complexDataProvider(): array
    {
        $wsdl = __DIR__ . '/../../Provider/_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();
        $requestData = [new CrossBorder(), new DomesticWithServices(), new Locker(), new PostOffice()];

        // response does not matter really, just to make it not fail
        $responseXml = \file_get_contents(__DIR__ . '/../../Provider/_files/createshipment/singleShipmentSuccess.xml');

        return [
            'label request' => [$wsdl, $authStorage, $requestData, $responseXml],
        ];
    }

    /**
     * @test
     * @dataProvider simpleDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param AbstractRequestData[] $requestData
     * @param string $responseXml
     * @throws ServiceException
     */
    public function createMinimalShipmentRequest(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseXml
    ): void {
        // mock API communication
        $logger = new NullLogger();

        $clientOptions = [
            'trace' => 1,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
            'login' => $authStorage->getApplicationId(),
            'password' => $authStorage->getApplicationToken(),
        ];

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        // create service
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        // build shipment orders
        $requestBuilder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);
        $shipmentOrders = [];
        $requestValues = [];

        foreach ($requestData as $sequenceNumber => $data) {
            $data->setSequenceNumber((string) $sequenceNumber);
            $shipmentOrders[] = $data->createShipmentOrder($requestBuilder);
            $requestValues[] = $data->get();
        }

        // send shipment orders to service
        $service->createShipments($shipmentOrders);

        // validate response
        $requestXml = $soapClient->__getLastRequest();
        Expectation::assertXmlContentsAvailable($requestValues, $requestXml);
    }

    /**
     * @test
     * @dataProvider complexDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param AbstractRequestData[] $requestData
     * @param string $responseXml
     * @throws ServiceException
     */
    public function createMultiShipmentRequest(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseXml
    ): void {
        // mock API communication
        $logger = new NullLogger();

        $clientOptions = [
            'trace' => 1,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
            'login' => $authStorage->getApplicationId(),
            'password' => $authStorage->getApplicationToken(),
            'cache_wsdl' => WSDL_CACHE_NONE,
        ];

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        // create service
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        // build shipment orders
        $requestBuilder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);
        $shipmentOrders = [];
        $requestValues = [];

        foreach ($requestData as $sequenceNumber => $data) {
            $data->setSequenceNumber((string) $sequenceNumber);
            $shipmentOrders[] = $data->createShipmentOrder($requestBuilder);
            $requestValues[] = $data->get();
        }

        // send shipment orders to service
        $service->createShipments($shipmentOrders);

        // unset address data that are not transmitted with delivery location (post office) shipments
        unset($requestValues[3]['recipientName']);
        unset($requestValues[3]['recipientCountryCode']);
        unset($requestValues[3]['recipientPostalCode']);
        unset($requestValues[3]['recipientCity']);
        unset($requestValues[3]['recipientStreet']);
        unset($requestValues[3]['recipientStreetNumber']);

        // validate response
        $requestXml = $soapClient->__getLastRequest();
        Expectation::assertXmlContentsAvailable($requestValues, $requestXml);
    }

    /**
     * Assert that request builder throws exception if PDDP service is attempted to be booked via SOAP API.
     *
     * @test
     * @throws RequestValidatorException
     */
    public function validationExceptionOnPDDPService()
    {
        $this->expectException(RequestValidatorException::class);
        $regEx = str_replace('%s', '[\w\s]+', ShipmentOrderRequestBuilderInterface::MSG_SERVICE_UNSUPPORTED);
        $this->expectExceptionMessageMatches("~$regEx~");

        $builder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);
        $requestData = new CrossBorderWithServices();
        $requestData->createShipmentOrder($builder);
    }

    /**
     * Assert that request builder throws exception if CDP service is attempted to be booked via SOAP API.
     *
     * @test
     * @throws RequestValidatorException
     */
    public function validationExceptionOnCDPService()
    {
        $this->expectException(RequestValidatorException::class);
        $regEx = str_replace('%s', '[\w\s]+', ShipmentOrderRequestBuilderInterface::MSG_SERVICE_UNSUPPORTED);
        $this->expectExceptionMessageMatches("~$regEx~");

        $builder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);
        $requestData = new CrossBorderWithServices();
        $requestData->createShipmentOrder($builder, ['premium' => false, 'closestDropPoint' => true]);
    }
}
