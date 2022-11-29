<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\TestCase\Service\Http;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Http\HttpServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Service\GetVersionTestProvider;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Log\Test\TestLogger;

class GetVersionTest extends TestCase
{
    /**
     * @return string[][]
     */
    public function successDataProvider(): array
    {
        return GetVersionTestProvider::getVersionSuccess();
    }

    /**
     * Assert successful version call being processed properly.
     *
     * The only possible error cases are "401 Unauthorized" and "429 Too Many Requests",
     * which are not specific to the current endpoint and are therefore covered by another test.
     *
     * @test
     * @dataProvider successDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param string $responseBody
     * @return void
     *
     * @throws ServiceException
     */
    public function getApiVersionSuccess(AuthenticationStorageInterface $authStorage, string $responseBody): void
    {
        $httpClient = new Client();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        $getVersionResponse = $responseFactory
            ->createResponse(200, 'OK')
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($getVersionResponse);
        $logger = new TestLogger();

        $serviceFactory = new HttpServiceFactory($httpClient, 'dhl-sdk-api-bcs');
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $result = $service->getVersion();

        // assert that result is a version number
        self::assertTrue(preg_match('|\d\.\d\.\d|', $result) === 1);

        // assert that result is the version number from the response body
        $responseData = json_decode($responseBody, true);
        self::assertSame($result, $responseData['backend']['version']);
    }
}
