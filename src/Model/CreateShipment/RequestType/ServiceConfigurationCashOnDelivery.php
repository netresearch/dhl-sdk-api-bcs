<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

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

    public function __construct(bool $active, float $codAmount)
    {
        $this->active = (int) $active;
        $this->codAmount = $codAmount;
    }
}
