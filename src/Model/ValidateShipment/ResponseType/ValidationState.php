<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ResponseType;

use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;

class ValidationState
{
    /**
     * Identifier for ShipmentOrder set by client application in ValidateShipment request.
     *
     * @var string $sequenceNumber
     */
    protected $sequenceNumber;

    /**
     * @var StatusInformation $Status
     */
    protected $Status;

    /**
     * @return string
     */
    public function getSequenceNumber(): string
    {
        return $this->sequenceNumber;
    }

    /**
     * @return StatusInformation
     */
    public function getStatus(): StatusInformation
    {
        return $this->Status;
    }
}
