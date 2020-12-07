<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType;

use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;

class DeletionState
{
    /**
     * Can contain any DHL shipment number.
     *
     * @var string $shipmentNumber
     */
    protected $shipmentNumber;

    /**
     * Success status of processing the deletion of particular shipment.
     *
     * @var StatusInformation $Status
     */
    protected $Status;

    /**
     * @return string
     */
    public function getShipmentNumber(): string
    {
        return $this->shipmentNumber;
    }

    /**
     * @return StatusInformation
     */
    public function getStatus(): StatusInformation
    {
        return $this->Status;
    }
}
