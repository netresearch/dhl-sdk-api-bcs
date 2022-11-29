<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;

class CreateShipmentResponseMapper
{
    /**
     * Map the webservice data structure to response objects suitable for third-party consumption.
     *
     * @param CreateShipmentResponse $shipmentResponseType
     * @return ShipmentInterface[]
     */
    public function map(CreateShipmentResponse $shipmentResponseType): array
    {
        return [];
    }
}
