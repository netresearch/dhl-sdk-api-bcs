<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class DhlRetoure implements \JsonSerializable
{
    /**
     * @var string
     */
    private $billingNumber;

    /**
     * @var ReturnAddress
     */
    private $returnAddress;

    /**
     * @var string|null
     */
    private $refNo;

    public function __construct(string $billingNumber, ReturnAddress $returnAddress)
    {
        $this->billingNumber = $billingNumber;
        $this->returnAddress = $returnAddress;
    }

    public function setRefNo(?string $refNo): void
    {
        $this->refNo = $refNo;
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
