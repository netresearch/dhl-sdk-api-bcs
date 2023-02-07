<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseMapper;

use Dhl\Sdk\Paket\Bcs\Api\Data\ValidationResultInterface;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType\ValidationMessage;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ShipmentResponse;
use Dhl\Sdk\Paket\Bcs\Service\ShipmentService\ValidationResult;

class ValidateShipmentResponseMapper
{
    /**
     * Map the webservice data structure to response objects suitable for third-party consumption.
     *
     * @param ShipmentResponse $response
     * @return ValidationResultInterface[]
     */
    public function map(ShipmentResponse $response): array
    {
        $results = [];

        foreach ($response->getItems() as $index => $item) {
            if (!empty($item->getValidationMessages())) {
                $itemMessages = array_map(
                    function (ValidationMessage $itemMessage) {
                        return sprintf(
                            '%s (%s): %s',
                            $itemMessage->getValidationState(),
                            $itemMessage->getProperty(),
                            $itemMessage->getValidationMessage()
                        );
                    },
                    $item->getValidationMessages()
                );

                $message = implode("\n", $itemMessages);
            } else {
                $message = $item->getStatus()->getDetail() ?? $item->getStatus()->getTitle();
            }

            $results[] = new ValidationResult((string) $index, ($item->getStatus()->getStatus() === 200), $message);
        }

        return $results;
    }
}
