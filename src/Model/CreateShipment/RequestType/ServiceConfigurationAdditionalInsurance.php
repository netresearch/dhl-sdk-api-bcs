<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationAdditionalInsurance
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationAdditionalInsurance
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var bool $active
     */
    protected $active;

    /**
     * @var float $insuranceAmount
     */
    protected $insuranceAmount;

    /**
     * @param bool $active
     * @param float $insuranceAmount
     */
    public function __construct(bool $active, float $insuranceAmount)
    {
        $this->active = $active;
        $this->insuranceAmount = $insuranceAmount;
    }
}
