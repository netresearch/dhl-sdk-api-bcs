<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\TestCase\Service\Http;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Http\HttpServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\OrderServiceTestExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Service\CancelShipmentTestProvider;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Log\Test\TestLogger;

class CancelShipmentTest extends TestCase
{
    /**
     * @return mixed[]
     */
    public function successDataProvider(): array
    {
        return CancelShipmentTestProvider::cancelShipmentsSuccess();
    }


    /**
     * @return mixed[]
     */
    public function partialSuccessDataProvider(): array
    {
        return CancelShipmentTestProvider::cancelShipmentsPartialSuccess();
    }

    /**
     * @return mixed[]
     */
    public function errorDataProvider(): array
    {
        return CancelShipmentTestProvider::cancelShipmentsError();
    }

    /**
     * Test shipment cancellation success case (all shipments cancelled, no issues).
     *
     * @test
     * @dataProvider successDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param string[] $shipmentNumbers
     * @param string $responseBody
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function cancelShipmentsSuccess(
        AuthenticationStorageInterface $authStorage,
        array $shipmentNumbers,
        string $responseBody
    ): void {
        $httpClient = new Client();
        $logger = new TestLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $shipmentResponse = $responseFactory
            ->createResponse(
                count($shipmentNumbers) > 1 ? 207 : 200,
                count($shipmentNumbers) > 1 ? 'Multi-status' : 'OK'
            )
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($shipmentResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $result = $service->cancelShipments($shipmentNumbers);

        OrderServiceTestExpectation::assertAllShipmentsCancelled(
            $httpClient->getLastRequest()->getUri()->getQuery(),
            $responseBody,
            $result
        );

        // assert successful communication gets logged.
        CommunicationExpectation::assertCommunicationLogged(
            $httpClient->getLastRequest()->getUri()->getQuery(),
            $responseBody,
            $logger
        );
    }

    /**
     * Test shipment cancellation partial success case (some shipments cancelled).
     *
     * @test
     * @dataProvider partialSuccessDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param string[] $shipmentNumbers
     * @param string $responseBody
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function cancelShipmentsPartialSuccess(
        AuthenticationStorageInterface $authStorage,
        array $shipmentNumbers,
        string $responseBody
    ): void {
        $httpClient = new Client();
        $logger = new TestLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $shipmentResponse = $responseFactory
            ->createResponse(207, 'Multi-status')
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($shipmentResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $result = $service->cancelShipments($shipmentNumbers);


        OrderServiceTestExpectation::assertSomeShipmentsCancelled(
            $httpClient->getLastRequest()->getUri()->getQuery(),
            $responseBody,
            $result
        );

        // todo(nr): assert cancellation errors are logged.
        // CommunicationExpectation::assertErrorsLogged(
        CommunicationExpectation::assertCommunicationLogged(
            $httpClient->getLastRequest()->getUri()->getQuery(),
            $responseBody,
            $logger
        );
    }

    /**
     * Test shipment cancellation failure case.
     *
     * @test
     * @dataProvider errorDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param string[] $shipmentNumbers
     * @param string $responseBody
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function cancelShipmentsError(
        AuthenticationStorageInterface $authStorage,
        array $shipmentNumbers,
        string $responseBody
    ): void {
        if (count($shipmentNumbers) > 1) {
            $this->markTestIncomplete('assert detailed service exception being thrown when all shipments fail');
        }

        // @todo(nr): assert detailed service exception being thrown
        $this->expectException(ServiceException::class);
        $this->expectExceptionCode(400);

        $httpClient = new Client();
        $logger = new TestLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $shipmentResponse = $responseFactory
            ->createResponse(
                count($shipmentNumbers) > 1 ? 207 : 400,
                count($shipmentNumbers) > 1 ? 'Multi-status' : 'Bad Request'
            )
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($shipmentResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        try {
            $service->cancelShipments($shipmentNumbers);
        } catch (DetailedServiceException $exception) {
            CommunicationExpectation::assertErrorsLogged(
                $httpClient->getLastRequest()->getUri()->getQuery(),
                $responseBody,
                $logger
            );

            throw $exception;
        }
    }
}
