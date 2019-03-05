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
     * Surname (family name) of the person for ident check.
     *
     * @var string $surname
     */
    protected $surname;

    /**
     * Given name (first name) of the person for ident check.
     *
     * @var string $givenName
     */
    protected $givenName;

    /**
     * Date of birth (DOB) of the person for ident check. Format: yyyy-mm-dd.
     *
     * @var string $dateOfBirth
     */
    protected $dateOfBirth;

    /**
     * Minimum age of the person for ident check.
     *
     * @var string $minimumAge
     */
    protected $minimumAge;

    /**
     * @param string $surname
     * @param string $givenName
     * @param string $dateOfBirth
     * @param string $minimumAge
     */
    public function __construct(string $surname, string $givenName, string $dateOfBirth, string $minimumAge)
    {
        $this->surname = $surname;
        $this->givenName = $givenName;
        $this->dateOfBirth = $dateOfBirth;
        $this->minimumAge = $minimumAge;
    }
}
