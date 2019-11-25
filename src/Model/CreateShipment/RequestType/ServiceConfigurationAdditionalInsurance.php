<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationAdditionalInsurance
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
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

    /**
     * @param bool $active
     * @param float $insuranceAmount
     */
    public function __construct(bool $active, float $insuranceAmount)
    {
        $this->active = intval($active);
        $this->insuranceAmount = $insuranceAmount;
    }
}
