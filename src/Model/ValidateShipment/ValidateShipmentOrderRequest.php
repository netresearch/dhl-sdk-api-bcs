<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractRequest;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\RequestType\ShipmentOrderType;

class ValidateShipmentOrderRequest extends AbstractRequest
{
    /**
     * ShipmentOrder is the highest parent element that contains all data with respect to one shipment order.
     *
     * @var \stdClass[]|ShipmentOrderType[] $ShipmentOrder
     */
    protected $ShipmentOrder;

    /**
     * @param Version $version
     * @param \stdClass[]|ShipmentOrderType[] $shipmentOrders
     */
    public function __construct(Version $version, array $shipmentOrders)
    {
        $this->ShipmentOrder = $shipmentOrders;

        parent::__construct($version);
    }
}
