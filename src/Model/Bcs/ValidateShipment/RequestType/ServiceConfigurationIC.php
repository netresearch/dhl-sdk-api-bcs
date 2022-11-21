<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\RequestType;

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

    public function __construct(bool $active, Ident $ident)
    {
        $this->active = (int) $active;
        $this->Ident = $ident;
    }
}
