<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class Weight implements \JsonSerializable
{
    /**
     * Metric unit for weight.
     *
     * Allowed values:
     * - g
     * - kg
     *
     * @var string
     */
    private $uom;

    /**
     * Numeric value.
     *
     * @var float
     */
    private $value;

    public function __construct(string $uom, float $value)
    {
        $this->uom = $uom;
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
