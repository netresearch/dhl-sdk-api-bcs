<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class CustomsItem implements \JsonSerializable
{
    /**
     * @var string
     */
    private $itemDescription;

    /**
     * @var int
     */
    private $packagedQuantity;

    /**
     * Customs value amount of the unit/position.
     *
     * @var MonetaryValue
     */
    private $itemValue;

    /**
     * Weight of item or shipment.
     *
     * @var Weight
     */
    private $itemWeight;

    /**
     * A valid country code consisting of three characters according to ISO 3166-1 alpha-3.
     *
     * @var string|null
     */
    private $countryOfOrigin;

    /**
     * Harmonized System Code aka Customs tariff number.
     *
     * @var string|null
     */
    private $hsCode;

    public function __construct(
        string $itemDescription,
        int $packagedQuantity,
        MonetaryValue $itemValue,
        Weight $itemWeight
    ) {
        $this->itemDescription = $itemDescription;
        $this->packagedQuantity = $packagedQuantity;
        $this->itemValue = $itemValue;
        $this->itemWeight = $itemWeight;
    }

    public function setCountryOfOrigin(?string $countryOfOrigin): void
    {
        $this->countryOfOrigin = $countryOfOrigin;
    }

    public function setHsCode(?string $hsCode): void
    {
        $this->hsCode = $hsCode;
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
