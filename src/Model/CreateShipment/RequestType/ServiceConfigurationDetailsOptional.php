<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationDetailsOptional
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationDetailsOptional
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var bool $active
     */
    protected $active;

    /**
     * Details of the service (free text).
     *
     * @var string|null $details
     */
    protected $details = null;

    /**
     * @param bool $active
     */
    public function __construct(bool $active)
    {
        $this->active = $active;
    }

    /**
     * @param string $details
     * @return ServiceConfigurationDetailsOptional
     */
    public function setDetails(string $details): self
    {
        $this->details = $details;
        return $this;
    }
}
