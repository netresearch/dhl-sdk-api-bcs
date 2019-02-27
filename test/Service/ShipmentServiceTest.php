<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\ShipmentServiceTestExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\ShipmentServiceTestProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\Test\TestLogger;

/**
 * Class ShipmentServiceTest
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return mixed[]
     */
    public function successDataProvider()
    {
        return ShipmentServiceTestProvider::createShipmentsSuccess();
    }

    /**
     * @return mixed[]
     */
    public function partialSuccessDataProvider()
    {
        return ShipmentServiceTestProvider::createShipmentsPartialSuccess();
    }

    /**
     * @return mixed[]
     */
    public function validationWarningDataProvider()
    {
        return ShipmentServiceTestProvider::createShipmentsValidationWarning();
    }

    /**
     * @return mixed[]
     */
    public function validationErrorDataProvider()
    {
        return ShipmentServiceTestProvider::createShipmentsError();
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
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createShipmentsSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ) {
        $logger = new TestLogger();

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
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createShipmentsPartialSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ) {
        $logger = new TestLogger();

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

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->createShipments($shipmentOrders);

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
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createShipmentsValidationWarning(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ) {
        $logger = new TestLogger();

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
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createShipmentsValidationError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ) {
        $this->expectException(ClientException::class);
        $this->expectExceptionCode(1101);
        $this->expectExceptionMessage('Hard validation error occured.');

        $logger = new TestLogger();

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

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        try {
            $service->createShipments($shipmentOrders);
        } catch (ClientException $exception) {
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
     * Test shipment error case (server error or general error, server exception thrown).
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createShipmentsError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ) {

    }
}
