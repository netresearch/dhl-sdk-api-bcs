<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

class ServiceConfigurationEndorsement
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    /**
     * Service endorsement is used to specify handling if recipient not met. Possible values:
     * - SOZU
     * - ZWZU
     * - IMMEDIATE
     * - AFTER_DEADLINE
     * - ABANDONMENT
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
