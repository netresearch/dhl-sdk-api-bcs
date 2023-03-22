<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseMapper;

use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType\Item;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ShipmentResponse;

class DeleteShipmentResponseMapper
{
    /**
     * Map the webservice data structure to response objects suitable for third-party consumption.
     *
     * @param ShipmentResponse $response
     * @return string[]
     */
    public function map(ShipmentResponse $response): array
    {
        return array_map(
            function (Item $responseItem) {
                return $responseItem->getShipmentNo();
            },
            array_filter(
                $response->getItems(),
                function (Item $responseItem) {
                    return ($responseItem->getStatus()->getStatusCode() === 200);
                }
            )
        );
    }
}
