<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType;

class NativeAddressType
{
    /**
     * Name of street.
     *
     * @var string $streetName
     */
    protected $streetName;

    /**
     * House number.
     *
     * @var string $streetNumber
     */
    protected $streetNumber;

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
     * Address add-on.
     *
     * @var string[] $addressAddition
     */
    protected $addressAddition = [];

    /**
     * Dispatching information.
     *
     * @var string|null $dispatchingInformation
     */
    protected $dispatchingInformation = null;

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

    public function __construct(string $streetName, string $streetNumber, string $zip, string $city)
    {
        $this->streetName = $streetName;
        $this->streetNumber = $streetNumber;
        $this->zip = $zip;
        $this->city = $city;
    }

    /**
     * @param string[] $addressAddition
     * @return NativeAddressType
     */
    public function setAddressAddition(array $addressAddition = []): self
    {
        $this->addressAddition = $addressAddition;
        return $this;
    }

    /**
     * @param string|null $dispatchingInformation
     * @return NativeAddressType
     */
    public function setDispatchingInformation(string $dispatchingInformation = null): self
    {
        $this->dispatchingInformation = $dispatchingInformation;
        return $this;
    }

    /**
     * @param string|null $province
     * @return NativeAddressType
     */
    public function setProvince(string $province = null): self
    {
        $this->province = $province;
        return $this;
    }

    /**
     * @param CountryType|null $Origin
     * @return NativeAddressType
     */
    public function setOrigin(CountryType $Origin = null): self
    {
        $this->Origin = $Origin;
        return $this;
    }
}
