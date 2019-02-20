<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\ResponseType;

use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;

/**
 * LabelData
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
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
    public function getShipmentNumber()
    {
        return $this->shipmentNumber;
    }

    /**
     * @return string|null
     */
    public function getLabelUrl()
    {
        return $this->labelUrl;
    }

    /**
     * @return string|null
     */
    public function getLabelData()
    {
        return $this->labelData;
    }

    /**
     * @return string|null
     */
    public function getReturnLabelUrl()
    {
        return $this->returnLabelUrl;
    }

    /**
     * @return string|null
     */
    public function getReturnLabelData()
    {
        return $this->returnLabelData;
    }

    /**
     * @return string|null
     */
    public function getExportLabelUrl()
    {
        return $this->exportLabelUrl;
    }

    /**
     * @return string|null
     */
    public function getExportLabelData()
    {
        return $this->exportLabelData;
    }

    /**
     * @return string|null
     */
    public function getCodLabelUrl()
    {
        return $this->codLabelUrl;
    }

    /**
     * @return string|null
     */
    public function getCodLabelData()
    {
        return $this->codLabelData;
    }
}
