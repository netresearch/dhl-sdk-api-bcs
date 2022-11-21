<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

abstract class Address implements \JsonSerializable
{
    /**
     * Line 1 of name information.
     *
     * @var string
     */
    private $name1;

    /**
     * @var string
     */
    private $addressStreet;

    /**
     * Mandatory for all countries but Ireland that use a postal code system.
     *
     * @var string
     */
    private $postalCode;

    /**
     * City
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
     * An optional, additional line of name information.
     *
     * @var string|null
     */
    private $name2;

    /**
     * An optional, additional line of name information.
     *
     * @var string|null
     */
    private $name3;

    /**
     * State, province or territory.
     *
     * For the USA please use the official regional ISO-Codes, e.g. US-AL.
     *
     * @var string|null
     */
    private $state;

    /**
     * House number, can alternatively be added to street name.
     *
     * @var string|null
     */
    private $addressHouse;

    /**
     * Additional information that is positioned either behind or below addressStreet on the label.
     *
     * If it is printed and where exactly depends on the country.
     *
     * @var string|null
     */
    private $additionalAddressInformation1;

    /**
     * Additional information that is positioned either behind or below addressStreet on the label.
     *
     * If it is printed and where exactly depends on the country.
     *
     * @var string|null
     */
    private $additionalAddressInformation2;

    /**
     * Optional contact name.
     *
     * @var string|null
     */
    private $contactName;

    /**
     * @var string|null
     */
    private $phone;

    /**
     * @var string|null
     */
    private $email;

    public function __construct(string $name1, string $addressStreet, string $postalCode, string $city, string $country)
    {
        $this->name1 = $name1;
        $this->addressStreet = $addressStreet;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }

    public function setName2(?string $name2): void
    {
        $this->name2 = $name2;
    }

    public function setName3(?string $name3): void
    {
        $this->name3 = $name3;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function setAddressHouse(?string $addressHouse): void
    {
        $this->addressHouse = $addressHouse;
    }

    public function setAdditionalAddressInformation1(?string $additionalAddressInformation1): void
    {
        $this->additionalAddressInformation1 = $additionalAddressInformation1;
    }

    public function setAdditionalAddressInformation2(?string $additionalAddressInformation2): void
    {
        $this->additionalAddressInformation2 = $additionalAddressInformation2;
    }

    public function setContactName(?string $contactName): void
    {
        $this->contactName = $contactName;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
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
