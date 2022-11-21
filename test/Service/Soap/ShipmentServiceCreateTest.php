<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Service\Soap;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\Data\OrderConfigurationInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Service\ShipmentService\OrderConfiguration;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\RequestTypeExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\ShipmentServiceTestExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\ShipmentServiceTestProvider;
use Psr\Log\Test\TestLogger;

class ShipmentServiceCreateTest extends AbstractApiTest
{
    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function successDataProvider(): array
    {
        return ShipmentServiceTestProvider::createShipmentsSuccess();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function partialSuccessDataProvider(): array
    {
        return ShipmentServiceTestProvider::createShipmentsPartialSuccess();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function validationWarningDataProvider(): array
    {
        return ShipmentServiceTestProvider::createShipmentsValidationWarning();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function validationErrorDataProvider(): array
    {
        return ShipmentServiceTestProvider::createShipmentsError();
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
     * Assert that order configuration parameters appear in the request body.
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
    public function configureShipmentOrder(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $configuration = new OrderConfiguration(
            $printOnlyIfCodable = true,
            $combinedPrinting = false,
            $docFormat = OrderConfigurationInterface::DOC_FORMAT_PDF,
            $printFormat = OrderConfigurationInterface::PRINT_FORMAT_A4,
            $printFormatReturn = OrderConfigurationInterface::PRINT_FORMAT_910_300_300,
            $profile = '4711'
        );

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $service->createShipments($shipmentOrders, $configuration);

        $requestData = [
            'mustEncode' => $printOnlyIfCodable ? '1' : '0',
            'labelResponseType' => ($docFormat === OrderConfigurationInterface::DOC_FORMAT_ZPL2) ? 'ZPL2' : 'B64',
            'groupProfileName' => $profile,
            'labelFormat' => $printFormat,
            'labelFormatRetoure' => $printFormatReturn,
            'combinedPrinting' => $combinedPrinting ? '1' : '0',
        ];

        $requestXml = $soapClient->__getLastRequest();
        RequestTypeExpectation::assertOrderConfigurationAvailable($requestData, $requestXml);
    }

    /**
     * Test shipment success case (all labels available, no issues).
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
    public function createShipmentsSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->createShipments($shipmentOrders);

        // assert that all shipments were created
        Expectation::assertAllShipmentsBooked(
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
     * Test shipment partial success case (some labels available).
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
    public function createShipmentsPartialSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        $logger = new TestLogger();
        $configuration = new OrderConfiguration(true);

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->createShipments($shipmentOrders, $configuration);

        // assert that shipments were created but not all of them
        Expectation::assertSomeShipmentsBooked(
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
     * Test shipment success case (all labels available, warnings exist).
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
    public function createShipmentsValidationWarning(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->createShipments($shipmentOrders);

        Expectation::assertAllShipmentsBooked(
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
     * Test shipment validation failure case (no labels available, client exception thrown).
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
    public function createShipmentsValidationError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        $this->expectException(DetailedServiceException::class);
        $this->expectExceptionCode(1101);
        $this->expectExceptionMessage('Hard validation error occured.');

        $logger = new TestLogger();
        $configuration = new OrderConfiguration(true);

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        try {
            $service->createShipments($shipmentOrders, $configuration);
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
     * Test shipment error case (HTTP 200, 10/500/1000 status in response).
     *
     * @test
     * @dataProvider serverErrorDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     *
     * @throws ServiceException
     */
    public function createShipmentsError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ): void {
        preg_match('|<statusCode>([^<]+)|', $responseXml, $matches);

        $this->expectException(ServiceException::class);
        $this->expectExceptionCode($matches[1]);

        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $configuration = new OrderConfiguration(
            false,
            false,
            OrderConfigurationInterface::DOC_FORMAT_PDF,
            OrderConfigurationInterface::PRINT_FORMAT_A4,
            OrderConfigurationInterface::PRINT_FORMAT_100X70 // invalid format for return labels
        );

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        try {
            $service->createShipments($shipmentOrders, $configuration);
        } catch (ServiceException $exception) {
            // assert server errors are logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            throw $exception;
        }
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
    public function createShipmentsServerError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        \SoapFault $soapFault
    ): void {
        $this->expectException(ServiceException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('INVALID_CONFIGURATION');

        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willThrowException($soapFault);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger);

        try {
            $service->createShipments($shipmentOrders);
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
