<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\RequestType;

class ShipmentOrderType
{
    /**
     * Free field to to tag multiple shipment orders individually by client. Essential for later mapping
     * of response data returned by webservice upon ValidateShipment operation. Allows client to assign
     * the shipment information of the response to the correct shipment order of the request.
     *
     * @var string $sequenceNumber
     */
    protected $sequenceNumber;

    /**
     * The core element of a ShipmentOrder. It contains all relevant information of the shipment.
     *
     * @var Shipment $Shipment
     */
    protected $Shipment;

    /**
     * If set to true (=1), the label will be only be printable, if the receiver address is valid.
     *
     * @var ServiceConfiguration|null $PrintOnlyIfCodeable
     */
    protected $PrintOnlyIfCodeable = null;

    public function __construct(string $sequenceNumber, Shipment $shipment)
    {
        $this->sequenceNumber = $sequenceNumber;
        $this->Shipment = $shipment;
    }

    /**
     * @param ServiceConfiguration|null $printOnlyIfCodeable
     * @return ShipmentOrderType
     */
    public function setPrintOnlyIfCodeable(ServiceConfiguration $printOnlyIfCodeable = null): self
    {
        $this->PrintOnlyIfCodeable = $printOnlyIfCodeable;
        return $this;
    }
}
