<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api\Data;

/**
 * Interface LabelInterface
 *
 * @package Dhl\Sdk\Paket\Bcs\Api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface LabelInterface
{
    /**
     * @return string
     */
    public function getShipmentNumber(): string;

    /**
     * @return null|string
     */
    public function getLabelUrl();

    /**
     * @return null|string
     */
    public function getLabelData();
}
