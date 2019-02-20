<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api;

use Dhl\Sdk\Paket\Bcs\Api\Data\LabelInterface;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Psr\Log\LoggerInterface;

/**
 * Interface LabelServiceInterface
 *
 * @package Dhl\Sdk\Paket\Bcs\Api
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface LabelServiceInterface
{
    /**
     * @param \stdClass $createShipmentRequest
     * @param LoggerInterface $logger
     * @param CreateShipmentResponseMapper $responseMapper
     * @return LabelInterface[]
     */
    public function createLabel(
        \stdClass $createShipmentRequest,
        LoggerInterface $logger,
        CreateShipmentResponseMapper $responseMapper
    ): array;

    /**
     * @param \stdClass $deleteShipmentRequest
     * @param LoggerInterface $logger
     * @param CreateShipmentResponseMapper $responseMapper
     * @return bool
     */
    public function deleteLabel(
        \stdClass $deleteShipmentRequest,
        LoggerInterface $logger,
        CreateShipmentResponseMapper $responseMapper
    ): bool;
}
