<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationDateOfDelivery
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationDateOfDelivery
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var bool $active
     */
    protected $active;

    /**
     * Day of Delivery, if the option is used: Date in format yyyy-mm-dd.
     *
     * @var string $details
     */
    protected $details;

    /**
     * @param bool $active
     * @param string $details
     */
    public function __construct(bool $active, string $details)
    {
        $this->active = $active;
        $this->details = $details;
    }
}
