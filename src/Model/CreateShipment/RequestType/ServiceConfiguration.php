<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfiguration
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ServiceConfiguration
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var bool $active
     */
    protected $active;

    /**
     * @param bool $active
     */
    public function __construct(bool $active)
    {
        $this->active = $active;
    }
}
