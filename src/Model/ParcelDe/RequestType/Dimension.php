<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class Dimension implements \JsonSerializable
{
    /**
     * Unit of metric, applies to all dimensions contained.
     *
     * Allowed values:
     * - cm
     * - mm
     *
     * @var string
     */
    private $uom;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $width;

    public function __construct(string $uom, int $height, int $length, int $width)
    {
        $this->uom = $uom;
        $this->height = $height;
        $this->length = $length;
        $this->width = $width;
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
