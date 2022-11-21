<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class Consignee implements \JsonSerializable
{
    /**
     * Combines name, address, contact information.
     *
     * The recommended way is to use the mandatory attribute addressStreet
     * and submit the street name and house number together – alternatively
     * addressHouse + addressStreet can be used.
     * For many international addresses there is no house number, please do not set
     * a period or any other sign to indicate that the address does not have a house number.
     *
     * @var ContactAddress|null
     */
    private $contactAddress;

    /**
     * Only usable for German Packstation, international lockers cannot be addressed directly.
     *
     * If your customer wishes for international delivery to a drop-point, please use
     * DHL Parcel International (V53WPAK) with the delivery type "Closest Droppoint".
     *
     * @var Locker|null
     */
    private $locker;

    /**
     * Only usable for German post offices or retail outlets (Paketshops),
     * international postOffices or retail outlets cannot be addressed directly.
     *
     * If your customer wishes for international delivery to a droppoint,
     * please use DHL Parcel International (V53WPAK) with the delivery type "Closest Droppoint".
     *
     * @var PostOffice|null
     */
    private $postOffice;

    public function setContactAddress(?ContactAddress $contactAddress): void
    {
        $this->contactAddress = $contactAddress;
    }

    public function setLocker(?Locker $locker): void
    {
        $this->locker = $locker;
    }

    public function setPostOffice(?PostOffice $postOffice): void
    {
        $this->postOffice = $postOffice;
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
