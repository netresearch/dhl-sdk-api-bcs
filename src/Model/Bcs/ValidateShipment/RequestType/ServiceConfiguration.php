<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\RequestType;

class ServiceConfiguration
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    public function __construct(bool $active)
    {
        $this->active = (int) $active;
    }
}
