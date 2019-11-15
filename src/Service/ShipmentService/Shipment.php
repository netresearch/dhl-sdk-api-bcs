<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service\ShipmentService;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;

/**
 * Class Shipment
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class Shipment implements ShipmentInterface
{
    /**
     * @var string
     */
    private $sequenceNumber;

    /**
     * @var string
     */
    private $shipmentNumber;

    /**
     * @var string
     */
    private $returnShipmentNumber;

    /**
     * @var string
     */
    private $shipmentLabel;

    /**
     * @var string
     */
    private $returnLabel;

    /**
     * @var string
     */
    private $exportLabel;

    /**
     * @var string
     */
    private $codLabel;

    /**
     * Shipment constructor.
     * @param string $sequenceNumber
     * @param string $shipmentNumber
     * @param string $returnShipmentNumber
     * @param string $shipmentLabel
     * @param string $returnLabel
     * @param string $exportLabel
     * @param string $codLabel
     */
    public function __construct(
        string $sequenceNumber,
        string $shipmentNumber,
        string $returnShipmentNumber,
        string $shipmentLabel,
        string $returnLabel,
        string $exportLabel,
        string $codLabel
    ) {
        $this->sequenceNumber = $sequenceNumber;
        $this->shipmentNumber = $shipmentNumber;
        $this->returnShipmentNumber = $returnShipmentNumber;
        $this->shipmentLabel = $shipmentLabel;
        $this->returnLabel = $returnLabel;
        $this->exportLabel = $exportLabel;
        $this->codLabel = $codLabel;
    }

    public function getSequenceNumber(): string
    {
        return $this->sequenceNumber;
    }

    public function getShipmentNumber(): string
    {
        return $this->shipmentNumber;
    }

    public function getReturnShipmentNumber(): string
    {
        return $this->returnShipmentNumber;
    }

    public function getShipmentLabel(): string
    {
        return $this->shipmentLabel;
    }

    public function getReturnLabel(): string
    {
        return $this->returnLabel;
    }

    public function getExportLabel(): string
    {
        return $this->exportLabel;
    }

    public function getCodLabel(): string
    {
        return $this->codLabel;
    }

    public function getLabels(): array
    {
        return [
            self::LABEL_TYPE_SHIPMENT => $this->getShipmentLabel(),
            self::LABEL_TYPE_RETURN => $this->getReturnLabel(),
            self::LABEL_TYPE_EXPORT => $this->getExportLabel(),
            self::LABEL_TYPE_COD => $this->getCodLabel(),
        ];
    }
}
