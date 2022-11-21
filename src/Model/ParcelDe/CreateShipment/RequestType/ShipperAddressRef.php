<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class ShipperAddressRef implements ShipperInterface, \JsonSerializable
{
    /**
     * Contains a reference to the Shipper data configured in GKP
     * (Geschäftskundenportal - Business Costumer Portal). Can be used
     * instead of a detailed shipper address. The shipper reference can be used
     * to print a company logo which is configured in GKP onto the label.
     *
     * @var string
     */
    private $shipperRef;

    /**
     * @param string $shipperRef
     */
    public function __construct(string $shipperRef)
    {
        $this->shipperRef = $shipperRef;
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
