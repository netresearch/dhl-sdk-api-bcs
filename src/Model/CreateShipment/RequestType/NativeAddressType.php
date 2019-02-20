<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * NativeAddressType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class NativeAddressType
{
    /**
     * @var string $streetName
     */
    protected $streetName;

    /**
     * @var string $streetNumber
     */
    protected $streetNumber;

    /**
     * @var string $zip
     */
    protected $zip;

    /**
     * @var string $city
     */
    protected $city;

    /**
     * @var string[] $addressAddition
     */
    protected $addressAddition = [];

    /**
     * @var string|null $dispatchingInformation
     */
    protected $dispatchingInformation = null;

    /**
     * @var string|null $province
     */
    protected $province = null;

    /**
     * @var CountryType|null $Origin
     */
    protected $Origin = null;

    /**
     * @param string $streetName
     * @param string $streetNumber
     * @param string $zip
     * @param string $city
     */
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
    public function setAddressAddition(array $addressAddition): self
    {
        $this->addressAddition = $addressAddition;
        return $this;
    }

    /**
     * @param string $dispatchingInformation
     * @return NativeAddressType
     */
    public function setDispatchingInformation(string $dispatchingInformation): self
    {
        $this->dispatchingInformation = $dispatchingInformation;
        return $this;
    }

    /**
     * @param string $province
     * @return NativeAddressType
     */
    public function setProvince(string $province): self
    {
        $this->province = $province;
        return $this;
    }

    /**
     * @param CountryType $Origin
     * @return NativeAddressType
     */
    public function setOrigin(CountryType $Origin): self
    {
        $this->Origin = $Origin;
        return $this;
    }

}
