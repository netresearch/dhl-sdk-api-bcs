<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ResponseType\ValidationState;

class ValidateShipmentResponse extends AbstractResponse
{
    /**
     * The operation's success status for every single ShipmentOrder will be returned by one ValidationState element.
     * It is identifiable via SequenceNumber.
     *
     * @var ValidationState[]|ValidationState|null $ValidationState
     */
    protected $ValidationState = null;

    /**
     * @return ValidationState[]
     */
    public function getValidationState(): array
    {
        if (empty($this->ValidationState)) {
            return [];
        }

        if (!\is_array($this->ValidationState)) {
            return [$this->ValidationState];
        }

        return $this->ValidationState;
    }
}
