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
    public const API_TYPE_SOAP = 'SOAP';
    public const API_TYPE_REST = 'REST';

    public const SOAP_URL_PRODUCTION = 'https://cig.dhl.de/services/production/soap';
    public const SOAP_URL_SANDBOX = 'https://cig.dhl.de/services/sandbox/soap';

    public const REST_URL_PRODUCTION = 'https://api-eu.dhl.com/parcel/de/shipping/v2';
    public const REST_URL_SANDBOX = 'https://api-sandbox.dhl.com/parcel/de/shipping/v2';

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
