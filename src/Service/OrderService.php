<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\OrderConfigurationInterface;
use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Api\Data\ValidationResultInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceExceptionFactory;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Serializer\JsonSerializer;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class OrderService implements ShipmentServiceInterface
{
    private const OPERATION_ORDERS = 'orders/';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var JsonSerializer
     */
    private $serializer;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(
        ClientInterface $client,
        string $baseUrl,
        JsonSerializer $serializer,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
        $this->serializer = $serializer;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * Assert that all shipment orders are serializable.
     *
     * @param \stdClass[] $shipmentOrders
     * @return \JsonSerializable[]
     *
     * @throws \Exception
     */
    private function getShipmentOrders(array $shipmentOrders): array
    {
        foreach ($shipmentOrders as $shipmentOrder) {
            if (!$shipmentOrder instanceof \JsonSerializable) {
                throw new \InvalidArgumentException('Shipment orders must implement JsonSerializable');
            }
        }

        /** @var \JsonSerializable[] $shipmentOrders */
        return $shipmentOrders;
    }

    public function getVersion(): string
    {
        try {
            $httpRequest = $this->requestFactory->createRequest('GET', $this->baseUrl);

            $response = $this->client->sendRequest($httpRequest);
            $responseJson = (string) $response->getBody();

            $responseData = \json_decode($responseJson, true);

            return $responseData['backend']['version'] ?? '';
        } catch (\Throwable $exception) {
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }

    public function validateShipments(array $shipmentOrders, OrderConfigurationInterface $configuration = null): array
    {
        $requestParams['validate'] = 'true';
        if ($configuration instanceof OrderConfigurationInterface && $configuration->mustEncode()) {
            $requestParams['mustEncode'] = 'true';
        }
        $uri = sprintf('%s/%s?%s', $this->baseUrl, self::OPERATION_ORDERS, implode('&', $requestParams));

        try {
            $payload = $this->serializer->encode($this->getShipmentOrders($shipmentOrders));
            $stream = $this->streamFactory->createStream($payload);
        } catch (\Throwable $exception) {
            throw ServiceExceptionFactory::createServiceException($exception);
        }

        throw new \RuntimeException('Not yet implemented.');
    }

    public function createShipments(array $shipmentOrders, OrderConfigurationInterface $configuration = null): array
    {
        $uri = sprintf('%s/%s', $this->baseUrl, self::OPERATION_ORDERS);

        try {
            $payload = $this->serializer->encode($this->getShipmentOrders($shipmentOrders));
            $stream = $this->streamFactory->createStream($payload);
        } catch (\Throwable $exception) {
            throw ServiceExceptionFactory::createServiceException($exception);
        }

        throw new \RuntimeException('Not yet implemented.');
    }

    public function cancelShipments(array $shipmentNumbers): array
    {
        throw new \RuntimeException('Not yet implemented.');
    }
}
