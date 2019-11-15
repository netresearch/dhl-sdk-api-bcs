<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator\ErrorHandlerDecorator;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\AuthenticationTestProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\Test\TestLogger;

/**
 * Class AuthenticationTest
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class AuthenticationTest extends TestCase
{
    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function unauthorizedDataProvider(): array
    {
        return AuthenticationTestProvider::appAuthFailure();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function loginFailedDataProvider(): array
    {
        return AuthenticationTestProvider::userAuthFailure();
    }

    /**
     * Test authentication error (application level, basic auth, 401 Unauthorized).
     *
     * @test
     * @dataProvider unauthorizedDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param \SoapFault $soapFault
     * @throws ServiceException
     */
    public function createShipmentsAppAuthenticationError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        \SoapFault $soapFault
    ) {
        $this->expectException(AuthenticationException::class);
        $this->expectExceptionCode(401);
        $this->expectExceptionMessage(ErrorHandlerDecorator::AUTH_ERROR_MESSAGE);

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
            ->willThrowException($soapFault);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger);

        try {
            $service->createShipments($shipmentOrders);
        } catch (AuthenticationException $exception) {
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                ErrorHandlerDecorator::AUTH_ERROR_MESSAGE,
                $logger
            );

            throw $exception;
        }
    }

    /**
     * Test authentication error (user level, wsi soap header, 200 OK).
     *
     * @test
     * @dataProvider loginFailedDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $responseXml
     *
     * @throws ServiceException
     */
    public function createShipmentsUserAuthenticationError(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseXml
    ) {
        $xml = new \SimpleXMLElement($responseXml);
        $xml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('bcs', 'http://dhl.de/webservices/businesscustomershipping/3.0');
        $statusCode = $xml->xpath('/soap:Envelope/soap:Body/bcs:CreateShipmentOrderResponse/Status/statusCode');
        $statusText = $xml->xpath('/soap:Envelope/soap:Body/bcs:CreateShipmentOrderResponse/Status/statusText');

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionCode((int) $statusCode[0]);
        $this->expectExceptionMessage((string) $statusText[0]);

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
        $service = $serviceFactory->createShipmentService($authStorage, $logger);

        try {
            $service->createShipments($shipmentOrders);
        } catch (AuthenticationException $exception) {
            CommunicationExpectation::assertErrorsLogged(
                $soapClient->__getLastRequest(),
                $soapClient->__getLastResponse(),
                $logger
            );

            throw $exception;
        }
    }
}
