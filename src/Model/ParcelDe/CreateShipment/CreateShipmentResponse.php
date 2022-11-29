<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment;

class CreateShipmentResponse
{
    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Status|null
     */
    private $status;

    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Item[]
     */
    private $items;

    /**
     * @return \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Status|null
     */
    public function getStatus(): ?ResponseType\Status
    {
        return $this->status;
    }

    /**
     * @return \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Item[]
     */
    public function getItems(): array
    {
        if (empty($this->items)) {
            return [];
        }

        return $this->items;
    }
}
