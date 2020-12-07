<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

class Shipment
{
    /**
     * Contains the information of the shipment product code, weight and size characteristics and services to be used.
     *
     * @var ShipmentDetailsTypeType $ShipmentDetails
     */
    protected $ShipmentDetails;

    /**
     * Contains relevant information about Receiver.
     *
     * @var ReceiverType $Receiver
     */
    protected $Receiver;

    /**
     * Contains relevant information about the Shipper.
     *
     * @var ShipperType|null $Shipper
     */
    protected $Shipper = null;

    /**
     * To be used if a return label address shall be generated.
     *
     * @var ShipperType|null $ReturnReceiver
     */
    protected $ReturnReceiver = null;

    /**
     * For international shipments, this section contains information about the exported goods relevant for customs.
     *
     * @var ExportDocumentType|null $ExportDocument
     */
    protected $ExportDocument = null;

    /**
     * Contains a reference to the Shipper data configured in GKP.
     *
     * @var string|null
     */
    protected $ShipperReference = null;

    /**
     * @param ShipmentDetailsTypeType $shipmentDetails
     * @param ReceiverType $receiver
     * @param ShipperType|null $shipper Conditionally mandatory. If omitted, set ShipperReference instead.
     */
    public function __construct(
        ShipmentDetailsTypeType $shipmentDetails,
        ReceiverType $receiver,
        ShipperType $shipper = null
    ) {
        $this->ShipmentDetails = $shipmentDetails;
        $this->Receiver = $receiver;
        $this->Shipper = $shipper;
    }

    /**
     * @param ShipperType|null $returnReceiver
     * @return Shipment
     */
    public function setReturnReceiver(ShipperType $returnReceiver = null): self
    {
        $this->ReturnReceiver = $returnReceiver;
        return $this;
    }

    /**
     * @param ExportDocumentType|null $exportDocument
     * @return Shipment
     */
    public function setExportDocument(ExportDocumentType $exportDocument = null): self
    {
        $this->ExportDocument = $exportDocument;
        return $this;
    }

    /**
     * @param string|null $shipperReference
     * @return Shipment
     */
    public function setShipperReference(string $shipperReference = null): self
    {
        $this->ShipperReference = $shipperReference;
        return $this;
    }
}
