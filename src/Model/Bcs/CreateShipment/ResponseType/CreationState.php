<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\ResponseType;

class CreationState
{
    /**
     * Identifier for ShipmentOrder set by client application in CreateShipment request.
     *
     * @var string $sequenceNumber
     */
    protected $sequenceNumber;

    /**
     * Can contain any DHL shipment number.
     *
     * @var string|null $shipmentNumber
     */
    protected $shipmentNumber = null;

    /**
     * Can contain any DHL shipment number.
     *
     * @var string|null $returnShipmentNumber
     */
    protected $returnShipmentNumber = null;

    /**
     * For successful operations, a shipment number is created and returned. Depending on the invoked product.
     *
     * @var LabelData $LabelData
     */
    protected $LabelData;

    /**
     * @return string
     */
    public function getSequenceNumber(): string
    {
        return $this->sequenceNumber;
    }

    /**
     * @return string|null
     */
    public function getShipmentNumber()
    {
        return $this->shipmentNumber;
    }

    /**
     * @return string|null
     */
    public function getReturnShipmentNumber(): ?string
    {
        return $this->returnShipmentNumber;
    }

    /**
     * @return LabelData
     */
    public function getLabelData(): LabelData
    {
        return $this->LabelData;
    }
}
