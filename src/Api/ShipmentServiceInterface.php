<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;

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
     * @param \object[] $shipmentOrders
     * @return ShipmentInterface[]
     * @throws AuthenticationException
     */
    public function createShipments(array $shipmentOrders): array;

    /**
     * This operation cancels earlier created shipments.
     *
     * @param string[] $shipmentNumbers
     * @return bool
     * @throws AuthenticationException
     */
    public function cancelShipments(array $shipmentNumbers): bool;
}
