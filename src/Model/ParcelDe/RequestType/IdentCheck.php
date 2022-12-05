<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class IdentCheck implements \JsonSerializable
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * Date of birth (DOB) of the person for ident check.
     *
     * If the option is used: Date in format yyyy-mm-dd
     * This attribute is only optional, if a minimum age is set.
     *
     * @var string|null
     */
    private $dateOfBirth;

    /**
     * Checks if recipient will have reached specified age by shipping date.
     *
     * Allowed values:
     * - A16
     * - A18
     *
     * @var string|null
     */
    private $minimumAge;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function setDateOfBirth(?string $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setMinimumAge(?string $minimumAge): void
    {
        $this->minimumAge = $minimumAge;
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
