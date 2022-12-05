<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class PostOffice implements ConsigneeInterface, \JsonSerializable
{
    /**
     * Consignee Name
     *
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $retailID;

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
     * To address a post office or retail outlet directly, either the post number
     * or e-mail address of the consignee is needed.
     *
     * @var string|null
     */
    private $postNumber;

    public function __construct(string $name, int $retailID, string $postalCode, string $city, string $country)
    {
        $this->name = $name;
        $this->retailID = $retailID;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * @param string|null $postNumber
     */
    public function setPostNumber(?string $postNumber): void
    {
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
