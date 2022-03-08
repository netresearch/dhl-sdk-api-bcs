<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\RequestType;

class ServiceConfigurationCashOnDelivery
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    /**
     * Money amount to be collected. Mandatory if COD is chosen.
     *
     * @var float $codAmount
     */
    protected $codAmount;

    /**
     * Configuration whether the transmission fee to be added to the COD amount or not by DHL.
     *
     * @var int|null $addFee "0" or "1"
     */
    protected $addFee;

    public function __construct(bool $active, float $codAmount)
    {
        $this->active = (int) $active;
        $this->codAmount = $codAmount;
    }

    /**
     * @param bool|null $addFee
     *
     * @return ServiceConfigurationCashOnDelivery
     */
    public function setAddFee(bool $addFee = null): self
    {
        $this->addFee = (int) $addFee;
        return $this;
    }
}
