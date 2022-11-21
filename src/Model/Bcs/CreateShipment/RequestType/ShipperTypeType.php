<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType;

class ShipperTypeType
{
    /**
     * @var NameType $Name
     */
    protected $Name;

    /**
     * @var NativeAddressType $Address
     */
    protected $Address;

    /**
     * @var CommunicationType|null $Communication
     */
    protected $Communication = null;

    public function __construct(NameType $name, NativeAddressType $address)
    {
        $this->Name = $name;
        $this->Address = $address;
    }

    /**
     * @param CommunicationType|null $Communication
     * @return ShipperTypeType
     */
    public function setCommunication(CommunicationType $Communication = null): self
    {
        $this->Communication = $Communication;
        return $this;
    }
}
