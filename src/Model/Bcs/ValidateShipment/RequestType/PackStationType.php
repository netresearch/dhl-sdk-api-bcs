<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\RequestType;

class PackStationType
{
    /**
     * Post Number of the receiver.
     *
     * @var string $postNumber
     */
    protected $postNumber;

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

    public function __construct(string $postNumber, string $packstationNumber, string $zip, string $city)
    {
        $this->postNumber = $postNumber;
        $this->packstationNumber = $packstationNumber;
        $this->zip = $zip;
        $this->city = $city;
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
