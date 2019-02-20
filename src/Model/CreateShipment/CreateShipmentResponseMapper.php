<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment;

use Dhl\Sdk\Paket\Bcs\Api\Data\LabelInterface;

/**
 * Class CreateShipmentResponseMapper
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateLabel
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CreateShipmentResponseMapper
{
    /**
     * @param CreateShipmentOrderResponse $shipmentResponseType
     * @return LabelInterface[]
     */
    public function map(CreateShipmentOrderResponse $shipmentResponseType): array
    {
        // TODO: Implement map() method.
        return [];
    }
}
