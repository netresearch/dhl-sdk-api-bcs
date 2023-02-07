<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Service;

use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Credentials\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\ShipmentOrder\ShipmentRequestProvider;

class CreateShipmentTestProvider
{
    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all shipments are valid.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsSuccess(): array
    {
        $singleResponse = __DIR__ . '/../../_files/createshipment/singleShipmentSuccess.json';
        $multiResponse = __DIR__ . '/../../_files/createshipment/multiShipmentSuccess.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $singleLabelResponse = \file_get_contents($singleResponse);

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentSuccess();
        $multiLabelResponse = \file_get_contents($multiResponse);

        return [
            'single label success' => [$authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label success' => [$authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipments sent to the API: valid + hard validation error.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsPartialSuccess(): array
    {
        $response = __DIR__ . '/../../_files/createshipment/multiShipmentPartialSuccess.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents($response);

        return [
            'multi label partial success' => [$authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all shipments have issues, weak validation error occurred.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsValidationWarning(): array
    {
        $singleResponse = __DIR__ . '/../../_files/createshipment/singleShipmentValidationWarning.json';
        $multiResponse = __DIR__ . '/../../_files/createshipment/multiShipmentValidationWarning.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentWarning();
        $singleLabelResponse = \file_get_contents($singleResponse);

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentWarning();
        $multiLabelResponse = \file_get_contents($multiResponse);

        return [
            'single label validation warning' => [$authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label validation warning' => [$authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all shipments have issues, hard validation error occurred.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsValidationError(): array
    {
        $singleResponse = __DIR__ . '/../../_files/createshipment/singleShipmentValidationError.json';
        $multiResponse = __DIR__ . '/../../_files/createshipment/multiShipmentValidationError.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentWarning();
        $singleLabelResponse = \file_get_contents($singleResponse);

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentWarning();
        $multiLabelResponse = \file_get_contents($multiResponse);

        return [
            'single label validation error' => [$authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label validation error' => [$authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all shipments invalid, syntax check failed.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsError(): array
    {
        $singleResponse = __DIR__ . '/../../_files/createshipment/singleShipmentSchemaError.json';
        $multiResponse = __DIR__ . '/../../_files/createshipment/multiShipmentSchemaError.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentError();
        $singleLabelResponse = \file_get_contents($singleResponse);

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentError();
        $multiLabelResponse = \file_get_contents($multiResponse);

        return [
            'single label schema error' => [$authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label schema error' => [$authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }
}
