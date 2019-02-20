<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationDetails
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationDetails
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
