<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * PostfilialeType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class PostfilialeType
{
    /**
     * Number of the Postfiliale.
     *
     * @var string $postfilialNumber
     */
    protected $postfilialNumber;

    /**
     * Postnummer of the receiver.
     *
     * @var string $postNumber
     */
    protected $postNumber;

    /**
     * Type of zip code.
     *
     * @var string $zip
     */
    protected $zip;

    /**
     * City name.
     *
     * @var string $city
     */
    protected $city;

    /**
     * Country.
     *
     * @var CountryType|null $Origin
     */
    protected $Origin = null;

    /**
     * @param string $postfilialNumber
     * @param string $postNumber
     * @param string $zip
     * @param string $city
     */
    public function __construct(string $postfilialNumber, string $postNumber, string $zip, string $city)
    {
        $this->postfilialNumber = $postfilialNumber;
        $this->postNumber = $postNumber;
        $this->zip = $zip;
        $this->city = $city;
    }

    /**
     * @param CountryType|null $Origin
     * @return PostfilialeType
     */
    public function setOrigin($Origin = null): self
    {
        $this->Origin = $Origin;
        return $this;
    }
}
