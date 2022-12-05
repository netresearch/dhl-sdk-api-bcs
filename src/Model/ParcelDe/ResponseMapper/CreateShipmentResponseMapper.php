<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseMapper;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ShipmentResponse;

class CreateShipmentResponseMapper
{
    /**
     * Map the webservice data structure to response objects suitable for third-party consumption.
     *
     * @param ShipmentResponse $response
     * @return ShipmentInterface[]
     */
    public function map(ShipmentResponse $response): array
    {
        return [];
    }
}
