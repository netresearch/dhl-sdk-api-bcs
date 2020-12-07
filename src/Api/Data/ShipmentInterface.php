<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api\Data;

/**
 * @api
 */
interface ShipmentInterface
{
    public const LABEL_TYPE_SHIPMENT = 'label_shipment';
    public const LABEL_TYPE_RETURN = 'label_return';
    public const LABEL_TYPE_EXPORT = 'label_export';
    public const LABEL_TYPE_COD = 'label_cod';
    public const LABEL_TYPE_OTHER = 'label_other';

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
