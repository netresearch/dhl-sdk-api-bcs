<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment;

use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\AbstractRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\RequestType\ShipmentOrderType;

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
