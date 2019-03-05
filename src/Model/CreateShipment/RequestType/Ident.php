<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * Ident
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class Ident
{
    /**
     * Given name (first name) of the person for ident check.
     *
     * @var string $givenName
     */
    protected $FirstName = null;

    /**
     * Surname (family name) of the person for ident check.
     *
     * @var string $surname
     */
    protected $LastName = null;

    /**
     * Name of the street of registered address.
     *
     * @var string $Street
     */
    protected $Street = null;

    /**
     * House number of registered address.
     *
     * @var string $HouseNumber
     */
    protected $HouseNumber = null;

    /**
     * Postcode of registered address.
     *
     * @var string $Postcode
     */
    protected $Postcode = null;

    /**
     * City of registered address.
     *
     * @var string $City
     */
    protected $City = null;

    /**
     * Person's date of birth. Format must be yyyy-mm-dd.
     *
     * @var string $DateOfBirth
     */
    protected $DateOfBirth = null;

    /**
     * Person's nationality.
     *
     * @var string $Nationality
     */
    protected $Nationality = null;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $street
     * @param string $houseNumber
     * @param string $postcode
     * @param string $city
     * @param string $dateOfBirth
     * @param string $nationality
     */
    public function __construct(
        string $firstName,
        string $lastName,
        string $street,
        string $houseNumber,
        string $postcode,
        string $city,
        string $dateOfBirth,
        string $nationality
    ) {
        $this->FirstName = $firstName;
        $this->LastName = $lastName;
        $this->Street = $street;
        $this->HouseNumber = $houseNumber;
        $this->Postcode = $postcode;
        $this->City = $city;
        $this->DateOfBirth = $dateOfBirth;
        $this->Nationality = $nationality;
    }
}
