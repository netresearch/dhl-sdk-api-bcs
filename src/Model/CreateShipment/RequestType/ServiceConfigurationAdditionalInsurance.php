<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

class ServiceConfigurationAdditionalInsurance
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    /**
     * The amount that should be insured.
     *
     * @var float $insuranceAmount
     */
    protected $insuranceAmount;

    public function __construct(bool $active, float $insuranceAmount)
    {
        $this->active = (int) $active;
        $this->insuranceAmount = $insuranceAmount;
    }
}
