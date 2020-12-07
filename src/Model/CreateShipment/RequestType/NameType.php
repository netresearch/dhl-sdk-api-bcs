<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

class NameType
{
    /**
     * Name of shipper (first part),
     *
     * @var string $name1
     */
    protected $name1;

    /**
     * Name of company (second part).
     *
     * @var string|null $name2
     */
    protected $name2 = null;

    /**
     * Name of company (third part).
     *
     * @var string|null $name3
     */
    protected $name3 = null;

    public function __construct(string $name1)
    {
        $this->name1 = $name1;
    }

    /**
     * @param string|null $name2
     * @return NameType
     */
    public function setName2(string $name2 = null): self
    {
        $this->name2 = $name2;
        return $this;
    }

    /**
     * @param string|null $name3
     * @return NameType
     */
    public function setName3(string $name3 = null): self
    {
        $this->name3 = $name3;
        return $this;
    }
}
