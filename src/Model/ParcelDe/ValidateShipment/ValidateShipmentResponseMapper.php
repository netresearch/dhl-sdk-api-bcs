<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ValidateShipment;

use Dhl\Sdk\Paket\Bcs\Api\Data\ValidationResultInterface;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\CreateShipmentResponse;
use Dhl\Sdk\Paket\Bcs\Service\ShipmentService\ValidationResult;

class ValidateShipmentResponseMapper
{
    /**
     * Map the webservice data structure to response objects suitable for third-party consumption.
     *
     * @param CreateShipmentResponse $response
     * @return ValidationResultInterface[]
     */
    public function map(CreateShipmentResponse $response): array
    {
        $results = [];

        foreach ($response->getItems() as $index => $item) {
            $results[] = new ValidationResult(
                (string) $index,
                $item->getStatus()->getStatus() === 200,
                $item->getStatus()->getDetail() ?? $item->getStatus()->getTitle()
            );
        }

        return $results;
    }
}
