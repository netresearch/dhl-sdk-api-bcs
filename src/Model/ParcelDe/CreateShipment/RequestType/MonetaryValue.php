<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class MonetaryValue implements \JsonSerializable
{
    /**
     * iso 4217 3 character currency code accepted. Recommended to use EUR where possible.
     *
     * @var string
     */
    private $currency;

    /**
     * Numeric value.
     *
     * @var float
     */
    private $value;

    public function __construct(string $currency, float $value)
    {
        $this->currency = $currency;
        $this->value = $value;
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
