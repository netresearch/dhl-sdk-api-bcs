<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class Locker implements ConsigneeInterface, \JsonSerializable
{
    /**
     * Consignee Name
     *
     * @var string
     */
    private $name;

    /**
     * Packstationnummer.
     *
     * Three-digit number identifying the parcel locker in conjunction with city and postal code
     *
     * @var int
     */
    private $lockerID;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * City where the locker is located
     *
     * @var string
     */
    private $city;

    /**
     * A valid country code consisting of three characters according to ISO 3166-1 alpha-3.
     *
     * @var string
     */
    private $country;

    /**
     * Postnummer.
     *
     * The official account number a private DHL Customer gets upon registration.
     *
     * @var string
     */
    private $postNumber;

    public function __construct(
        string $name,
        int $lockerID,
        string $postalCode,
        string $city,
        string $country,
        string $postNumber
    ) {
        $this->name = $name;
        $this->lockerID = $lockerID;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
        $this->postNumber = $postNumber;
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
