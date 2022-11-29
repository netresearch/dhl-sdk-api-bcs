<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\TestCase\Service\Http;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Http\HttpServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\OrderServiceTestExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Service\ValidateShipmentTestProvider;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Log\Test\TestLogger;

class ValidateShipmentTest extends TestCase
{
    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function successDataProvider(): array
    {
        return ValidateShipmentTestProvider::validateShipmentsSuccess();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function partialSuccessDataProvider(): array
    {
        return ValidateShipmentTestProvider::validateShipmentsPartialSuccess();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function validationWarningDataProvider(): array
    {
        return ValidateShipmentTestProvider::validateShipmentsWarning();
    }

    /**
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public function validationErrorDataProvider(): array
    {
        return ValidateShipmentTestProvider::validateShipmentsError();
    }

    /**
     * Test shipment success case (all requests valid, no issues).
     *
     * @test
     * @dataProvider successDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param \JsonSerializable[] $shipmentOrders
     * @param string $responseBody
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function validateShipmentsSuccess(
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseBody
    ): void {
        $httpClient = new Client();
        $logger = new TestLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $labelResponse = $responseFactory
            ->createResponse(
                count($shipmentOrders) > 1 ? 207 : 200,
                count($shipmentOrders) > 1 ? 'Multi-status' : 'OK'
            )
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($labelResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $result = $service->validateShipments($shipmentOrders);

        $lastRequest = $httpClient->getLastRequest();
        $requestBody = (string) $lastRequest->getBody();

        OrderServiceTestExpectation::assertValidationResponse(
            $requestBody,
            $responseBody,
            $result
        );

        // assert successful communication gets logged.
        CommunicationExpectation::assertCommunicationLogged(
            $requestBody,
            $responseBody,
            $logger
        );
    }

    /**
     * Test shipment partial success case (some requests valid).
     *
     * @test
     * @dataProvider partialSuccessDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param \JsonSerializable[] $shipmentOrders
     * @param string $responseBody
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function validateShipmentsPartialSuccess(
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseBody
    ): void {
        $httpClient = new Client();
        $logger = new TestLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $labelResponse = $responseFactory
            ->createResponse(
                count($shipmentOrders) > 1 ? 207 : 200,
                count($shipmentOrders) > 1 ? 'Multi-status' : 'OK'
            )
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($labelResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $result = $service->validateShipments($shipmentOrders);

        $lastRequest = $httpClient->getLastRequest();
        $requestBody = (string) $lastRequest->getBody();

        OrderServiceTestExpectation::assertValidationResponse(
            $requestBody,
            $responseBody,
            $result
        );

        // todo(nr): assert weak validation errors are logged.
        // CommunicationExpectation::assertWarningsLogged(
        CommunicationExpectation::assertCommunicationLogged(
            $requestBody,
            $responseBody,
            $logger
        );
    }

    /**
     * Test shipment success case (all requests valid, weak warnings exist).
     *
     * @test
     * @dataProvider validationWarningDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param \JsonSerializable[] $shipmentOrders
     * @param string $responseBody
     *
     * @throws AuthenticationException
     * @throws ServiceException
     */
    public function validateShipmentsValidationWarning(
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseBody
    ): void {
        $httpClient = new Client();
        $logger = new TestLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $labelResponse = $responseFactory
            ->createResponse(
                count($shipmentOrders) > 1 ? 207 : 200,
                count($shipmentOrders) > 1 ? 'Multi-status' : 'OK'
            )
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($labelResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $result = $service->validateShipments($shipmentOrders);

        $lastRequest = $httpClient->getLastRequest();
        $requestBody = (string) $lastRequest->getBody();

        OrderServiceTestExpectation::assertValidationResponse(
            $requestBody,
            $responseBody,
            $result
        );

        // todo(nr): assert weak validation errors are logged.
        // CommunicationExpectation::assertWarningsLogged(
        CommunicationExpectation::assertCommunicationLogged(
            $requestBody,
            $responseBody,
            $logger
        );
    }

    /**
     * Test shipment validation failure case (all requests invalid, client exception thrown).
     *
     * @test
     * @dataProvider validationErrorDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param \JsonSerializable[] $shipmentOrders
     * @param string $responseBody
     *
     * @throws ServiceException
     */
    public function validateShipmentsValidationError(
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $responseBody
    ): void {
        // @todo(nr): assert detailed service exception being thrown
        $this->expectException(ServiceException::class);
        $this->expectExceptionCode(400);

        $httpClient = new Client();
        $logger = new TestLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $labelResponse = $responseFactory
            ->createResponse(400, 'Bad Request')
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($labelResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        try {
            $service->validateShipments($shipmentOrders);
        } catch (DetailedServiceException $exception) {
            $lastRequest = $httpClient->getLastRequest();
            $requestBody = (string) $lastRequest->getBody();

            // @todo(nr): assert validation errors are logged.
            CommunicationExpectation::assertErrorsLogged(
                $requestBody,
                $responseBody,
                $logger
            );

            throw $exception;
        }
    }
}
