<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationISR
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationISR
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
     * @var string $details
     */
    protected $details;

    /**
     * @param bool $active
     * @param string $details
     */
    public function __construct(bool $active, string $details)
    {
        $this->active = intval($active);
        $this->details = $details;
    }
}
