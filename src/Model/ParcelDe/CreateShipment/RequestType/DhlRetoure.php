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
     * @var \JsonSerializable|ReturnAddress
     */
    private $returnAddress;

    /**
     * @var string|null
     */
    private $refNo;

    /**
     * @param string $billingNumber
     * @param \JsonSerializable|ReturnAddress $returnAddress
     */
    public function __construct(string $billingNumber, \JsonSerializable $returnAddress)
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
