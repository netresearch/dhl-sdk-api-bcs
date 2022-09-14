<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Psr\Log\LoggerInterface;

/**
 * @api
 */
interface ServiceFactoryInterface
{
    public const BASE_URL_PRODUCTION = 'https://cig.dhl.de/services/production/soap';
    public const BASE_URL_SANDBOX = 'https://cig.dhl.de/services/sandbox/soap';

    public const BETA_URL_PRODUCTION = 'https://api-eu.dhl.com/parcel/de/shipping/v2';
    public const BETA_URL_SANDBOX = 'https://api-sandbox.dhl.com/parcel/de/shipping/v2';

    /**
     * Create the service instance able to perform shipment create and delete operations.
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     *
     * @return ShipmentServiceInterface
     * @throws ServiceException
     */
    public function createShipmentService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): ShipmentServiceInterface;
}
