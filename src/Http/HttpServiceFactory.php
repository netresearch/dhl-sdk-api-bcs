<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Http;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceExceptionFactory;
use Dhl\Sdk\Paket\Bcs\Http\ClientPlugin\OrderErrorPlugin;
use Dhl\Sdk\Paket\Bcs\Serializer\JsonSerializer;
use Dhl\Sdk\Paket\Bcs\Service\OrderService;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\ContentLengthPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\Exception\NotFoundException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Authentication\BasicAuth;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;

class HttpServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $userAgent;

    public function __construct(ClientInterface $httpClient, string $userAgent)
    {
        $this->httpClient = $httpClient;
        $this->userAgent = $userAgent;
    }

    public function createShipmentService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): ShipmentServiceInterface {
        $userAuth = new BasicAuth($authStorage->getUser(), $authStorage->getSignature());
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'User-Agent' => $this->userAgent,
            'dhl-api-key' => $authStorage->getApplicationToken(),
        ];

        $client = new PluginClient(
            $this->httpClient,
            [
                new HeaderDefaultsPlugin($headers),
                new AuthenticationPlugin($userAuth),
                new ContentLengthPlugin(),
                new LoggerPlugin($logger, new FullHttpMessageFormatter(null)),
                new OrderErrorPlugin()
            ]
        );

        try {
            $requestFactory = Psr17FactoryDiscovery::findRequestFactory();
            $streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        } catch (NotFoundException $exception) {
            throw ServiceExceptionFactory::createServiceException($exception);
        }

        return new OrderService(
            $client,
            $sandboxMode ? self::REST_URL_SANDBOX : self::REST_URL_PRODUCTION,
            new JsonSerializer(),
            $requestFactory,
            $streamFactory
        );
    }
}
