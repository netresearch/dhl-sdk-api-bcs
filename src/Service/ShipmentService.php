<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractClient;
use Psr\Log\LoggerInterface;

/**
 * ShipmentService
 *
 * @package Dhl\Sdk\Paket\Bcs\Service
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
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
     * @param \object[]|ShipmentOrderType[] $shipmentOrders
     * @return ShipmentInterface[]
     * @throws AuthenticationException
     * @throws \Exception
     */
    public function createShipments(array $shipmentOrders): array
    {
        $version = new Version('3', '0');
        $createShipmentRequest = new CreateShipmentOrderRequest($version, $shipmentOrders);
        $createShipmentRequest->setLabelResponseType('B64');

        try {
            $shipmentResponse = $this->client->createShipmentOrder($createShipmentRequest);
            $result = $this->createShipmentResponseMapper->map($shipmentResponse);

            return $result;
        } catch (\SoapFault $fault) {
            // TODO: Throw proper exceptions.
            throw new \Exception($fault->getMessage(), $fault->getCode(), $fault);
        }
    }

    /**
     * Cancel earlier created shipments. Cancellation is only possible before the end-of-the-day manifest.
     *
     * todo(nr): return cancelled shipments, not bool?
     *
     * @param string[] $shipmentNumbers
     * @return bool
     * @throws AuthenticationException
     * @throws \Exception
     */
    public function cancelShipments(array $shipmentNumbers): bool
    {
        $version = new Version('3', '0');
        $deleteShipmentRequest = new DeleteShipmentOrderRequest($version, $shipmentNumbers);

        try {
            $shipmentResponse = $this->client->deleteShipmentOrder($deleteShipmentRequest);
            $result = $this->deleteShipmentResponseMapper->map($shipmentResponse);

            return $result;
        } catch (\SoapFault $fault) {
            // TODO: Throw proper exceptions.
            throw new \Exception($fault->getMessage(), $fault->getCode(), $fault);
        }
    }
}
