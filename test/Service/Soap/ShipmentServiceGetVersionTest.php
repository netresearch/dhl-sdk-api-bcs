<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Service\Soap;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\GetVersionTestProvider;
use Psr\Log\Test\TestLogger;

class ShipmentServiceGetVersionTest extends AbstractApiTest
{
    /**
     * @return mixed[]
     */
    public function successDataProvider(): array
    {
        return GetVersionTestProvider::getVersionSuccess();
    }

    /**
     * Test version success case.
     *
     * The only possible error case is an auth failure, which is covered by another test.
     *
     * @test
     * @dataProvider successDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param string $responseXml
     *
     * @throws ServiceException
     */
    public function getApiVersionSuccess(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        string $responseXml
    ): void {
        $logger = new TestLogger();

        $soapClient = $this->getMockClient($wsdl, $authStorage);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);

        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $result = $service->getVersion();
        self::assertTrue(preg_match('|\d\.\d\.\d|', $result) === 1);

        // assert successful communication gets logged.
        CommunicationExpectation::assertCommunicationLogged(
            $soapClient->__getLastRequest(),
            $soapClient->__getLastResponse(),
            $logger
        );
    }
}
