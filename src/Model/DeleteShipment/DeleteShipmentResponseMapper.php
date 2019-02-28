<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\DeleteShipment;

use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;

/**
 * Class DeleteShipmentResponseMapper
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\DeleteShipment
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class DeleteShipmentResponseMapper
{
    /**
     * @param DeleteShipmentOrderResponse $shipmentResponseType
     * @return string[]
     */
    public function map(DeleteShipmentOrderResponse $shipmentResponseType): array
    {
        /** @var DeletionState[] $deletionStates */
        $deletionStates = $shipmentResponseType->getDeletionState();

        $shipmentNumbers = array_map(function (DeletionState $deletionState) {
            if ($deletionState->getStatus()->getStatusCode() !== 0) {
                // error occurred that did not lead to an exception. no shipment was cancelled.
                return null;
            }

            return $deletionState->getShipmentNumber();
        }, $deletionStates);

        return array_filter($shipmentNumbers);
    }
}
