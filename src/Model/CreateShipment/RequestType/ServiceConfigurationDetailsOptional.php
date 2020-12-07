<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

class ServiceConfigurationDetailsOptional
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    /**
     * Details of the service (free text).
     *
     * @var string|null $details
     */
    protected $details = null;

    public function __construct(bool $active)
    {
        $this->active = (int) $active;
    }

    /**
     * @param string|null $details
     * @return ServiceConfigurationDetailsOptional
     */
    public function setDetails(string $details = null): self
    {
        $this->details = $details;
        return $this;
    }
}
