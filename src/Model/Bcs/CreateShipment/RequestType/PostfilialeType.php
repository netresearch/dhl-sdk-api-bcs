<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType;

class PostfilialeType
{
    /**
     * @var string
     */
    protected $postfilialNumber;

    /**
     * @var string
     */
    protected $zip;

    /**
     * @var string
     */
    protected $city;

    /**
     * Post Nummer of the receiver.
     *
     * If not set, receiver e-mail and/or mobile phone number needs to be set.
     *
     * @var string|null $postNumber
     */
    protected $postNumber = null;

    /**
     * @var CountryType|null
     */
    protected $Origin = null;

    public function __construct(string $postfilialNumber, string $zip, string $city)
    {
        $this->postfilialNumber = $postfilialNumber;
        $this->zip = $zip;
        $this->city = $city;
    }

    /**
     * @param string|null $postNumber
     * @return PostfilialeType
     */
    public function setPostNumber(string $postNumber = null): self
    {
        $this->postNumber = $postNumber;
        return $this;
    }

    /**
     * @param CountryType|null $Origin
     * @return PostfilialeType
     */
    public function setOrigin(CountryType $Origin = null): self
    {
        $this->Origin = $Origin;
        return $this;
    }
}
