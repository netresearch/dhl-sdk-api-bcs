<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationDeliveryTimeFrame
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationDeliveryTimeFrame
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    /**
     * Timeframe of delivery, if the option is used.
     *
     * @var string $type
     */
    protected $type;

    /**
     * @param bool $active
     * @param string $type
     */
    public function __construct(bool $active, string $type)
    {
        $this->active = intval($active);
        $this->type = $type;
    }
}
