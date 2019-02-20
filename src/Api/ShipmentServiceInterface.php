<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api;

use Dhl\Sdk\Paket\Bcs\Api\Data\LabelInterface;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Psr\Log\LoggerInterface;

/**
 * Interface ShipmentServiceInterface
 *
 * @package Dhl\Sdk\Paket\Bcs\Api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface ShipmentServiceInterface
{
    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param \stdClass[] $shipmentOrders
     * @param LoggerInterface $logger
     * @return LabelInterface[]
     */
    public function createShipments(array $shipmentOrders, LoggerInterface $logger): array;

    /**
     * This operation cancels earlier created shipments.
     *
     * Fixme(nr): Allow to pass in multiple shipment numbers
     *
     * @param \stdClass $deleteShipmentRequest
     * @param LoggerInterface $logger
     * @return bool
     */
    public function cancelShipments(\stdClass $deleteShipmentRequest, LoggerInterface $logger): bool;
}
