<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\RequestType;

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

    public function __construct(bool $active, string $type)
    {
        $this->active = (int) $active;
        $this->type = $type;
    }
}
