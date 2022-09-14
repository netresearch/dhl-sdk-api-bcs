<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Service\Soap;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\ShipmentServiceTestExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\ShipmentServiceTestProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\Test\TestLogger;

class ShipmentServiceValidateTest extends TestCase
{
    /**
     * @param AuthenticationStorageInterface $authStorage
     * @return mixed[]
     */
    private function getSoapClientOptions(AuthenticationStorageInterface $authStorage): array
    {
        $clientOptions = [
            'trace' => 1,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
            'login' => $authStorage->getApplicationId(),
            'password' => $authStorage->getApplicationToken(),
        ];

        return $clientOptions;
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function successDataProvider(): array
    {
        return ShipmentServiceTestProvider::validateShipmentsSuccess();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function partialSuccessDataProvider(): array
    {
        return ShipmentServiceTestProvider::validateShipmentsPartialSuccess();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function validationWarningDataProvider(): array
    {
        return ShipmentServiceTestProvider::validateShipmentsWarning();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function validationErrorDataProvider(): array
    {
        return ShipmentServiceTestProvider::validateShipmentsError();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function serverErrorDataProvider(): array
    {
        return ShipmentServiceTestProvider::createServerError();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function serverFaultDataProvider(): array
    {
        return ShipmentServiceTestProvider::createServerFault();
    }

    /**
     * Test shipment success case (all requests valid, no issues).
     *
     * @test
     * @dataProvider successDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function validateShipmentsSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $clientOptions = $this->getSoapClientOptions($authStorage);

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);

        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->validateShipments($shipmentOrders);

        // assert that all shipments were validated
        Expectation::assertAllShipmentsValid(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $result
        );
        // assert successful communication gets logged.
        CommunicationExpectation::assertCommunicationLogged(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $logger
        );
    }

    /**
     * Test shipment partial success case (some requests valid).
     *
     * @test
     * @dataProvider partialSuccessDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function validateShipmentsPartialSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        self::markTestIncomplete('Web service does not validate wrong addresses properly.');

        $logger = new TestLogger();

        $clientOptions = $this->getSoapClientOptions($authStorage);

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);

        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->validateShipments($shipmentOrders);

        // assert that shipments were created but not all of them
        Expectation::assertSomeShipmentsValid(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $result
        );
        // assert hard validation errors are logged.
        CommunicationExpectation::assertErrorsLogged(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $logger
        );
    }

    /**
     * Test shipment success case (all requests valid, warnings exist).
     *
     * @test
     * @dataProvider validationWarningDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function validateShipmentsValidationWarning(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $clientOptions = $this->getSoapClientOptions($authStorage);

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);

        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->validateShipments($shipmentOrders);

        Expectation::assertAllShipmentsValid(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $result
        );
        // assert weak validation errors are logged.
        CommunicationExpectation::assertWarningsLogged(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $logger
        );
    }

    /**
     * Test shipment validation failure case (all requests invalid, client exception thrown).
     *
     * @test
     * @dataProvider validationErrorDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     *
     * @throws ServiceException
     */
    public function validateShipmentsValidationError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        self::markTestIncomplete('Web service does not validate wrong addresses properly.');

        $this->expectException(DetailedServiceException::class);
        $this->expectExceptionCode(1101);
        $this->expectExceptionMessage('Hard validation error occured.');

        $logger = new TestLogger();

        $clientOptions = $this->getSoapClientOptions($authStorage);

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);

        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        try {
            $service->validateShipments($shipmentOrders);
        } catch (DetailedServiceException $exception) {
            // assert hard validation errors are logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            throw $exception;
        }
    }

    /**
     * Test shipment error case (HTTP 200, 500 "service not available" or 1000 "general error" status in response).
     *
     * @test
     * @dataProvider serverErrorDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     */
    public function validateShipmentsError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        self::markTestIncomplete('No such response observed/recorded yet.');
    }

    /**
     * Test shipment error case (HTTP 500, soap fault).
     *
     * @test
     * @dataProvider serverFaultDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param \SoapFault $soapFault
     *
     * @throws ServiceException
     */
    public function validateShipmentsServerError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        \SoapFault $soapFault
    ): void {
        $this->expectException(ServiceException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('INVALID_CONFIGURATION');

        $logger = new TestLogger();

        $clientOptions = $this->getSoapClientOptions($authStorage);

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);

        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willThrowException($soapFault);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger);

        try {
            $service->validateShipments($shipmentOrders);
        } catch (ServiceException $exception) {
            // assert errors are logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapFault->getMessage(),
                $logger
            );

            throw $exception;
        }
    }
}
