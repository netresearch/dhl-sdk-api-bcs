<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class POBox implements ConsigneeInterface, \JsonSerializable
{
    /**
     * Line 1 of name information
     *
     * @var string
     */
    private $name1;

    /**
     * Number of P.O. Box (Postfach). 6-digit numeric value, no whitespace.
     *
     * @var int
     */
    private $poBoxID;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * City where the facility is located
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
     * Email address of the consignee.
     *
     * @var string|null
     */
    private $email;

    public function __construct(string $name1, int $poBoxID, string $postalCode, string $city, string $country)
    {
        $this->name1 = $name1;
        $this->poBoxID = $poBoxID;
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
