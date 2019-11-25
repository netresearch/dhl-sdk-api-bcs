<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * PackStationType
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class PackStationType
{
    /**
     * Number of the Packstation.
     *
     * @var string $packstationNumber
     */
    protected $packstationNumber;

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
     * Post Nummer of the receiver, if not set receiver e-mail and/or mobilephone number needs to be set.
     *
     * @var string|null $postNumber
     */
    protected $postNumber = null;

    /**
     * Province name.
     *
     * @var string|null $province
     */
    protected $province = null;

    /**
     * Country.
     *
     * @var CountryType|null $Origin
     */
    protected $Origin = null;

    /**
     * @param string $packstationNumber
     * @param string $zip
     * @param string $city
     */
    public function __construct(string $packstationNumber, string $zip, string $city)
    {
        $this->packstationNumber = $packstationNumber;
        $this->zip = $zip;
        $this->city = $city;
    }

    /**
     * @param string|null $postNumber
     * @return PackStationType
     */
    public function setPostNumber(string $postNumber = null): self
    {
        $this->postNumber = $postNumber;
        return $this;
    }

    /**
     * @param string|null $province
     * @return PackStationType
     */
    public function setProvince(string $province = null): self
    {
        $this->province = $province;
        return $this;
    }

    /**
     * @param CountryType|null $Origin
     * @return PackStationType
     */
    public function setOrigin(CountryType $Origin = null): self
    {
        $this->Origin = $Origin;
        return $this;
    }
}
