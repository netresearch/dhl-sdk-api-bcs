<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType;

class CountryType
{
    /**
     * Country's ISO-Code (ISO-2-Alpha).
     *
     * @var string $countryISOCode
     */
    protected $countryISOCode;

    /**
     * Name of country.
     *
     * @var string|null $country
     */
    protected $country = null;

    /**
     * Name of state.
     *
     * @var string|null $state
     */
    protected $state = null;

    public function __construct(string $countryISOCode)
    {
        $this->countryISOCode = $countryISOCode;
    }
    /**
     * @param string|null $country
     * @return CountryType
     */
    public function setCountry(string $country = null): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param string|null $state
     * @return CountryType
     */
    public function setState(string $state = null): self
    {
        $this->state = $state;
        return $this;
    }
}
