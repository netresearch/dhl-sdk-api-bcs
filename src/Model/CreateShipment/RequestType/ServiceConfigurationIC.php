<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationIC
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationIC
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var bool $active
     */
    protected $active;

    /**
     * Identity details.
     *
     * @var Ident $Ident
     */
    protected $Ident;

    /**
     * @param bool $active
     * @param Ident $ident
     */
    public function __construct(bool $active, Ident $ident)
    {
        $this->Ident = $ident;
        $this->active = $active;
    }
}
