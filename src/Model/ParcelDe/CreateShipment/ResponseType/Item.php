<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType;

class Item
{
    /**
     * @var Status
     */
    private $sstatus;

    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\ValidationMessage[]
     */
    private $validationMessages;

    /**
     * @var string|null
     */
    private $shipmentNo;

    /**
     * @var string|null
     */
    private $returnShipmentNo;

    /**
     * @var string|null
     */
    private $shipmentRefNo;

    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Label|null
     */
    private $label;

    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Label|null
     */
    private $returnLabel;

    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Label|null
     */
    private $customsDoc;

    /**
     * @var \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\Label|null
     */
    private $codLabel;

    public function getStatus(): Status
    {
        return $this->sstatus;
    }

    /**
     * @return \Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\ResponseType\ValidationMessage[]
     */
    public function getValidationMessages(): array
    {
        if (empty($this->validationMessages)) {
            return [];
        }

        return $this->validationMessages;
    }

    public function getShipmentNo(): ?string
    {
        return $this->shipmentNo;
    }

    public function getReturnShipmentNo(): ?string
    {
        return $this->returnShipmentNo;
    }

    public function getShipmentRefNo(): ?string
    {
        return $this->shipmentRefNo;
    }

    public function getLabel(): ?Label
    {
        return $this->label;
    }

    public function getReturnLabel(): ?Label
    {
        return $this->returnLabel;
    }

    public function getCustomsDoc(): ?Label
    {
        return $this->customsDoc;
    }

    public function getCodLabel(): ?Label
    {
        return $this->codLabel;
    }
}
