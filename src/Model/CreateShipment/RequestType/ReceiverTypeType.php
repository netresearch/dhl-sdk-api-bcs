<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ReceiverTypeType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
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
     * @param ReceiverNativeAddressType $address Conditionally mandatory. If omitted, set PackStation or Postfiliale instead.
     */
    public function __construct(
        string $name1,
        ReceiverNativeAddressType $address = null
    ) {
        $this->name1 = $name1;
        $this->Address = $address;
    }

    /**
     * @param PackStationType $packstation
     * @return ReceiverTypeType
     */
    public function setPackstation(PackStationType $packstation): self
    {
        $this->Packstation = $packstation;
        return $this;
    }

    /**
     * @param PostfilialeType $postfiliale
     * @return ReceiverTypeType
     */
    public function setPostfiliale(PostfilialeType $postfiliale): self
    {
        $this->Postfiliale = $postfiliale;
        return $this;
    }

    /**
     * @param CommunicationType $communication
     * @return ReceiverTypeType
     */
    public function setCommunication(CommunicationType $communication): self
    {
        $this->Communication = $communication;
        return $this;
    }
}
