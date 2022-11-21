<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\DeleteShipment\ResponseType;

class Item
{
    /**
     * @var Status
     */
    private $sstatus;

    /**
     * @var string|null
     */
    private $shipmentNo;

    public function getStatus(): Status
    {
        return $this->sstatus;
    }

    public function getShipmentNo(): ?string
    {
        return $this->shipmentNo;
    }
}
