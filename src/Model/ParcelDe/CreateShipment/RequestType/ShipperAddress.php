<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class ShipperAddress extends Address implements \JsonSerializable
{
    /**
     * An optional, additional line of address.
     *
     * It's only usable for a few countries, e.g. Belgium.
     * It is positioned below name3 on the label.
     *
     * @var string|null
     */
    private $dispatchingInformation;

    /**
     * Contains a reference to the Shipper data configured in GKP
     * (Geschäftskundenportal - Business Costumer Portal). Can be used
     * instead of a detailed shipper address. The shipper reference can be used
     * to print a company logo which is configured in GKP onto the label.
     *
     * @var string|null
     */
    private $shipperRef;

    public function setDispatchingInformation(?string $dispatchingInformation): void
    {
        $this->dispatchingInformation = $dispatchingInformation;
    }

    /**
     * @param string|null $shipperRef
     */
    public function setShipperRef(?string $shipperRef): void
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
