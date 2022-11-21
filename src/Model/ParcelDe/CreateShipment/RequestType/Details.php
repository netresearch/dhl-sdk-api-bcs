<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class Details implements \JsonSerializable
{
    /**
     * Weight of item or shipment.
     *
     * @var Weight
     */
    private $weight;

    /**
     * Physical dimensions (aka 'Gurtmass') of the parcel.
     *
     * If you provide the dimension information, all attributes need to be provided.
     * You cannot provide just the height, for example. If you provide length,
     * width, and height in millimeters, they will be rounded to full cm.
     *
     * @var Dimension|null
     */
    private $dim;

    public function __construct(Weight $weight)
    {
        $this->weight = $weight;
    }

    public function setDim(?Dimension $dimension): void
    {
        $this->dim = $dimension;
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
