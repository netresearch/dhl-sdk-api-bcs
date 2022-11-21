<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType;

class ReceiverTypeType
{
    /**
     * Name of receiver (first part).
     *
     * @var string $name1
     */
    protected $name1;

    /**
     * The address data of the receiver.
     *
     * @var ReceiverNativeAddressType|null $Address
     */
    protected $Address;

    /**
     * The address of the receiver is a german Packstation.
     *
     * @var PackStationType|null $Packstation
     */
    protected $Packstation = null;

    /**
     * The address of the receiver is a german Postfiliale.
     *
     * @var PostfilialeType|null $Postfiliale
     */
    protected $Postfiliale = null;

    /**
     * Information about communication.
     *
     * @var CommunicationType|null $Communication
     */
    protected $Communication = null;

    /**
     * @param string $name1
     * @param ReceiverNativeAddressType|null $address Conditionally mandatory.
     *        If omitted, set PackStation or Postfiliale instead.
     */
    public function __construct(
        string $name1,
        ReceiverNativeAddressType $address = null
    ) {
        $this->name1 = $name1;
        $this->Address = $address;
    }

    /**
     * @param ReceiverNativeAddressType|null $address
     * @return ReceiverTypeType
     */
    public function setAddress(ReceiverNativeAddressType $address = null): self
    {
        $this->Address = $address;
        return $this;
    }

    /**
     * @param PackStationType|null $packstation
     * @return ReceiverTypeType
     */
    public function setPackstation(PackStationType $packstation = null): self
    {
        $this->Packstation = $packstation;
        return $this;
    }

    /**
     * @param PostfilialeType|null $postfiliale
     * @return ReceiverTypeType
     */
    public function setPostfiliale(PostfilialeType $postfiliale = null): self
    {
        $this->Postfiliale = $postfiliale;
        return $this;
    }

    /**
     * @param CommunicationType|null $communication
     * @return ReceiverTypeType
     */
    public function setCommunication(CommunicationType $communication = null): self
    {
        $this->Communication = $communication;
        return $this;
    }
}
