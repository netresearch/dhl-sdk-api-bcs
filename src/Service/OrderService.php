<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\OrderConfigurationInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceExceptionFactory;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ValidateShipment\ValidateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Serializer\JsonSerializer;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class OrderService implements ShipmentServiceInterface
{
    private const OPERATION_ORDERS = 'orders';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ValidateShipmentResponseMapper
     */
    private $validateShipmentResponseMapper;

    /**
     * @var CreateShipmentResponseMapper
     */
    private $createShipmentResponseMapper;

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
        ValidateShipmentResponseMapper $validateShipmentResponseMapper,
        CreateShipmentResponseMapper $createShipmentResponseMapper,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->client = $client;
        $this->baseUrl = $baseUrl;
        $this->serializer = $serializer;
        $this->validateShipmentResponseMapper = $validateShipmentResponseMapper;
        $this->createShipmentResponseMapper = $createShipmentResponseMapper;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * Assert that all shipment orders are serializable.
     *
     * @param \stdClass[] $shipmentOrders
     * @return CreateShipmentOrderRequest
     *
     * @throws \Exception
     */
    private function getShipmentOrderRequest(array $shipmentOrders): CreateShipmentOrderRequest
    {
        foreach ($shipmentOrders as $shipmentOrder) {
            if (!$shipmentOrder instanceof \JsonSerializable) {
                throw new \InvalidArgumentException('Shipment orders must implement JsonSerializable');
            }
        }

        /** @var \JsonSerializable[] $shipmentOrders */
        return new CreateShipmentOrderRequest($shipmentOrders);
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
        $requestParams[] = 'validate=true';
        if ($configuration instanceof OrderConfigurationInterface && $configuration->mustEncode()) {
            $requestParams[] = 'mustEncode=true';
        }

        $uri = sprintf('%s/%s?%s', $this->baseUrl, self::OPERATION_ORDERS, implode('&', $requestParams));

        try {
            $payload = $this->serializer->encode($this->getShipmentOrderRequest($shipmentOrders));
            $stream = $this->streamFactory->createStream($payload);

            $httpRequest = $this->requestFactory->createRequest('POST', $uri)->withBody($stream);

            $response = $this->client->sendRequest($httpRequest);
            $responseJson = (string) $response->getBody();
            $responseObject = $this->serializer->decode($responseJson);

            return $this->validateShipmentResponseMapper->map($responseObject);
        } catch (\Throwable $exception) {
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }

    public function createShipments(array $shipmentOrders, OrderConfigurationInterface $configuration = null): array
    {
        $requestParams = [];
        if ($configuration instanceof OrderConfigurationInterface && $configuration->mustEncode()) {
            $requestParams['mustEncode'] = 'true';
        }

        $uri = sprintf('%s/%s?%s', $this->baseUrl, self::OPERATION_ORDERS, implode('&', $requestParams));

        try {
            $payload = $this->serializer->encode($this->getShipmentOrderRequest($shipmentOrders));
            $stream = $this->streamFactory->createStream($payload);

            $httpRequest = $this->requestFactory->createRequest('POST', $uri)->withBody($stream);

            $response = $this->client->sendRequest($httpRequest);
            $responseJson = (string) $response->getBody();
            $responseObject = $this->serializer->decode($responseJson);

            return $this->createShipmentResponseMapper->map($responseObject);
        } catch (\Throwable $exception) {
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }

    public function cancelShipments(array $shipmentNumbers): array
    {
        throw new \RuntimeException('Not yet implemented.');
    }
}
