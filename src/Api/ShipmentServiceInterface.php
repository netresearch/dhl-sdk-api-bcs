<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedServiceException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;

/**
 * @api
 */
interface ShipmentServiceInterface
{
    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param \stdClass[] $shipmentOrders
     *
     * @return ShipmentInterface[]
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function createShipments(array $shipmentOrders): array;

    /**
     * DeleteShipmentOrder is the operation call used to cancel created shipments.
     *
     * Note that cancellation is only possible before the end-of-the-day manifest.
     *
     * @param string[] $shipmentNumbers
     *
     * @return string[]
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function cancelShipments(array $shipmentNumbers): array;
}
