<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\ResponseType;

use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\StatusInformation;

class LabelData
{
    /**
     * @var StatusInformation $Status
     */
    protected $Status;

    /**
     * @var string|null $shipmentNumber
     */
    protected $shipmentNumber = null;

    /**
     * @var string|null $labelUrl
     */
    protected $labelUrl = null;

    /**
     * @var string|null $labelData
     */
    protected $labelData = null;

    /**
     * @var string|null $returnLabelUrl
     */
    protected $returnLabelUrl = null;

    /**
     * @var string|null $returnLabelData
     */
    protected $returnLabelData = null;

    /**
     * @var string|null $exportLabelUrl
     */
    protected $exportLabelUrl = null;

    /**
     * @var string|null $exportLabelData
     */
    protected $exportLabelData = null;

    /**
     * @var string|null $codLabelUrl
     */
    protected $codLabelUrl = null;

    /**
     * @var string|null $codLabelData
     */
    protected $codLabelData = null;

    /**
     * @return StatusInformation
     */
    public function getStatus(): StatusInformation
    {
        return $this->Status;
    }

    /**
     * @return string|null
     */
    public function getShipmentNumber(): ?string
    {
        return $this->shipmentNumber;
    }

    /**
     * @return string|null
     */
    public function getLabelUrl(): ?string
    {
        return $this->labelUrl;
    }

    /**
     * @return string|null
     */
    public function getLabelData(): ?string
    {
        return $this->labelData;
    }

    /**
     * @return string|null
     */
    public function getReturnLabelUrl(): ?string
    {
        return $this->returnLabelUrl;
    }

    /**
     * @return string|null
     */
    public function getReturnLabelData(): ?string
    {
        return $this->returnLabelData;
    }

    /**
     * @return string|null
     */
    public function getExportLabelUrl(): ?string
    {
        return $this->exportLabelUrl;
    }

    /**
     * @return string|null
     */
    public function getExportLabelData(): ?string
    {
        return $this->exportLabelData;
    }

    /**
     * @return string|null
     */
    public function getCodLabelUrl(): ?string
    {
        return $this->codLabelUrl;
    }

    /**
     * @return string|null
     */
    public function getCodLabelData(): ?string
    {
        return $this->codLabelData;
    }
}
