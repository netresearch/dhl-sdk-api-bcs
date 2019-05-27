<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractClient;

/**
 * ShipmentService
 *
 * @package Dhl\Sdk\Paket\Bcs\Service
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentService implements ShipmentServiceInterface
{
    /**
     * @var AbstractClient
     */
    private $client;

    /**
     * @var CreateShipmentResponseMapper
     */
    private $createShipmentResponseMapper;

    /**
     * @var DeleteShipmentResponseMapper
     */
    private $deleteShipmentResponseMapper;

    /**
     * ShipmentService constructor.
     *
     * @param AbstractClient $client
     * @param CreateShipmentResponseMapper $createShipmentResponseMapper
     * @param DeleteShipmentResponseMapper $deleteShipmentResponseMapper
     */
    public function __construct(
        AbstractClient $client,
        CreateShipmentResponseMapper $createShipmentResponseMapper,
        DeleteShipmentResponseMapper $deleteShipmentResponseMapper
    ) {
        $this->client = $client;
        $this->createShipmentResponseMapper = $createShipmentResponseMapper;
        $this->deleteShipmentResponseMapper = $deleteShipmentResponseMapper;
    }

    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param \stdClass[]|ShipmentOrderType[] $shipmentOrders
     * @return ShipmentInterface[]
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createShipments(array $shipmentOrders): array
    {
        $version = new Version('3', '0');
        $createShipmentRequest = new CreateShipmentOrderRequest($version, array_values($shipmentOrders));
        $createShipmentRequest->setLabelResponseType('B64');

        $shipmentResponse = $this->client->createShipmentOrder($createShipmentRequest);
        $result = $this->createShipmentResponseMapper->map($shipmentResponse);

        return $result;
    }

    /**
     * Cancel earlier created shipments. Cancellation is only possible before the end-of-the-day manifest.
     *
     * @param string[] $shipmentNumbers
     * @return string[]
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function cancelShipments(array $shipmentNumbers): array
    {
        $version = new Version('3', '0');
        $deleteShipmentRequest = new DeleteShipmentOrderRequest($version, $shipmentNumbers);

        $shipmentResponse = $this->client->deleteShipmentOrder($deleteShipmentRequest);
        $result = $this->deleteShipmentResponseMapper->map($shipmentResponse);

        return $result;
    }
}
