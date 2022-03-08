<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment;

use Dhl\Sdk\Paket\Bcs\Api\Data\ValidationResultInterface;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ResponseType\ValidationState;
use Dhl\Sdk\Paket\Bcs\Service\ShipmentService\ValidationResult;

class ValidateShipmentResponseMapper
{
    /**
     * Map the webservice data structure to response objects suitable for third-party consumption.
     *
     * Note: With the SoapClient SOAP_SINGLE_ELEMENT_ARRAYS feature enabled, $validationStates is always an array.
     *
     * @param ValidateShipmentResponse $shipmentResponseType
     * @return ValidationResultInterface[]
     */
    public function map(ValidateShipmentResponse $shipmentResponseType): array
    {
        /** @var ValidationState[] $validationStates */
        $validationStates = $shipmentResponseType->getValidationState();

        $results = array_map(function (ValidationState $validationState) {
            $statusInformation = $validationState->getStatus();

            $messages = sprintf(
                '%s %s',
                $statusInformation->getStatusText(),
                implode(' ', array_unique($statusInformation->getStatusMessage()))
            );

            return new ValidationResult(
                $validationState->getSequenceNumber(),
                ($validationState->getStatus()->getStatusCode() === 0),
                $messages
            );
        }, $validationStates);

        return array_filter($results);
    }
}
