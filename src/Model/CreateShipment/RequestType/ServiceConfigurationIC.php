<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationIC
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationIC
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
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
        $this->active = intval($active);
        $this->Ident = $ident;
    }
}
