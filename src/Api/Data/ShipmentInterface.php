<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api\Data;

/**
 * Interface ShipmentInterface
 *
 * @api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface ShipmentInterface
{
    const LABEL_TYPE_SHIPMENT = 'label_shipment';
    const LABEL_TYPE_RETURN = 'label_return';
    const LABEL_TYPE_EXPORT = 'label_export';
    const LABEL_TYPE_COD = 'label_cod';
    const LABEL_TYPE_OTHER = 'label_other';

    /**
     * @return string
     */
    public function getSequenceNumber(): string;

    /**
     * @return string
     */
    public function getShipmentNumber(): string;

    /**
     * @return string
     */
    public function getReturnShipmentNumber(): string;

    /**
     * @return string
     */
    public function getShipmentLabel(): string;

    /**
     * @return string
     */
    public function getReturnLabel(): string;

    /**
     * @return string
     */
    public function getExportLabel(): string;

    /**
     * @return string
     */
    public function getCodLabel(): string;

    /**
     * @return string[]
     */
    public function getLabels(): array;
}
