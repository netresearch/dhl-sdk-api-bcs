<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;

/**
 * Interface ShipmentServiceInterface
 *
 * @api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface ShipmentServiceInterface
{
    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param \stdClass[] $shipmentOrders
     * @return ShipmentInterface[]
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createShipments(array $shipmentOrders): array;

    /**
     * This operation cancels earlier created shipments.
     *
     * @param string[] $shipmentNumbers
     * @return string[]
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function cancelShipments(array $shipmentNumbers): array;
}
