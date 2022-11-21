<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class ContactAddress extends Address implements \JsonSerializable
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

    public function setDispatchingInformation(?string $dispatchingInformation): void
    {
        $this->dispatchingInformation = $dispatchingInformation;
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
