<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment;

use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType\Shipment;

class CreateShipmentOrderRequest implements \JsonSerializable
{
    /**
     * Shipment array having details for each shipment.
     *
     * @var \JsonSerializable[]|Shipment[]
     */
    private $shipments;

    /**
     * @var string|null
     */
    private $profile;

    /**
     * @param \JsonSerializable[]|Shipment[] $shipments
     */
    public function __construct(array $shipments)
    {
        $this->shipments = $shipments;
    }

    public function setProfile(?string $profile): void
    {
        $this->profile = $profile;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return mixed[] Serializable object properties
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
