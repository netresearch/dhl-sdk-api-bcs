<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe;

class ShipmentResponse
{
    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType\Status|null
     */
    private $status;

    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType\Item[]
     */
    private $items;

    /**
     * @return \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType\Status|null
     */
    public function getStatus(): ?\Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType\Status
    {
        return $this->status;
    }

    /**
     * @return \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType\Item[]
     */
    public function getItems(): array
    {
        if (empty($this->items)) {
            return [];
        }

        return $this->items;
    }
}
