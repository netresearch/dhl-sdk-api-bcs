<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\Common;

abstract class AbstractResponse
{
    /**
     * The version of the webservice implementation for which the requesting client is developed.
     *
     * @var Version $Version
     */
    protected $Version;

    /**
     * Success status after processing the overall request.
     *
     * @var StatusInformation|null $Status
     */
    protected $Status;

    /**
     * @return Version
     */
    public function getVersion(): Version
    {
        return $this->Version;
    }

    /**
     * @return StatusInformation|null
     */
    public function getStatus(): ?StatusInformation
    {
        return $this->Status;
    }
}
