<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\TestCase\Service\Soap;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\ShipmentServiceTestExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Service\CancelShipmentTestProvider;
use Psr\Log\Test\TestLogger;

class CancelShipmentTest extends AbstractApiTest
{
    /**
     * @return mixed[]
     */
    public function cancellationSuccessDataProvider(): array
    {
        return CancelShipmentTestProvider::cancelShipmentsSuccess();
    }

    /**
     * @return mixed[]
     */
    public function cancellationPartialSuccessDataProvider(): array
    {
        return CancelShipmentTestProvider::cancelShipmentsPartialSuccess();
    }

    /**
     * @return mixed[]
     */
    public function cancellationErrorDataProvider(): array
    {
        return CancelShipmentTestProvider::cancelShipmentsError();
    }

    /**
     * @return mixed[]
     */
    public function cancellationValidationErrorDataProvider(): array
    {
        return CancelShipmentTestProvider::cancelShipmentsValidationError();
    }

    /**
     * Test shipment cancellation success case (all shipments cancelled, no issues).
     *
     * @test
     * @dataProvider cancellationSuccessDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param string[] $shipmentNumbers
     * @param string $responseXml
     *
     * @throws ServiceException
     */
    public function cancelShipmentsSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentNumbers,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->cancelShipments($shipmentNumbers);

        // assert that all shipments were created
        Expectation::assertAllShipmentsCancelled(
            $soapClient->__getLastRequest(),
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
     * Test shipment cancellation partial success case (some shipments cancelled).
     *
     * @test
     * @dataProvider cancellationPartialSuccessDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param string[] $shipmentNumbers
     * @param string $responseXml
     *
     * @throws ServiceException
     */
    public function cancelShipmentsPartialSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentNumbers,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->cancelShipments($shipmentNumbers);

        // assert that all shipments were created
        Expectation::assertSomeShipmentsCancelled(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $result
        );
        // assert successful communication gets logged.
        CommunicationExpectation::assertErrorsLogged(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $logger
        );
    }

    /**
     * Test shipment cancellation failure case (HTTP 200, 2000 status in response).
     *
     * @test
     * @dataProvider cancellationErrorDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param array $shipmentNumbers
     * @param string $responseXml
     *
     * @throws ServiceException
     */
    public function cancelShipmentsError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentNumbers,
        string $responseXml
    ): void {
        $this->expectException(DetailedServiceException::class);
        $this->expectExceptionCode(2000);
        $this->expectExceptionMessage('Unknown shipment number.');

        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        try {
            $service->cancelShipments($shipmentNumbers);
        } catch (DetailedServiceException $exception) {
            // assert successful communication gets logged.
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            throw $exception;
        }
    }

    /**
     * Test shipment cancellation failure case (HTTP 500, soap fault).
     *
     * @test
     * @dataProvider cancellationValidationErrorDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param \SoapFault $soapFault
     *
     * @throws ServiceException
     */
    public function cancelShipmentsValidationError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        \SoapFault $soapFault
    ): void {
        $this->expectException(ServiceException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('Invalid XML: cvc-minLength-valid.');

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
