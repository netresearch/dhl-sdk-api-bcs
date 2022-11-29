<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Service;

use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Credentials\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\ShipmentOrder\ShipmentRequestProvider;

class ValidateShipmentTestProvider
{
    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all shipments are valid.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function validateShipmentsSuccess(): array
    {
        $singleResponse = __DIR__ . '/../../_files/validateshipment/singleShipmentSuccess.json';
        $multiResponse = __DIR__ . '/../../_files/validateshipment/multiShipmentSuccess.json';

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
     * - shipment(s) sent to the API, some shipments are valid.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function validateShipmentsPartialSuccess(): array
    {
        $response = __DIR__ . '/../../_files/validateshipment/multiShipmentPartialSuccess.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents($response);

        return [
            'multi label partial success' => [$authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all shipments valid, weak validation error occurred.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function validateShipmentsWarning(): array
    {
        $response = __DIR__ . '/../../_files/validateshipment/multiShipmentValidationWarning.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents($response);

        return [
            'multi label partial success' => [$authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all shipments invalid, hard validation error occurred.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function validateShipmentsError(): array
    {
        $singleResponse = __DIR__ . '/../../_files/validateshipment/singleShipmentError.json';
        $multiResponse = __DIR__ . '/../../_files/validateshipment/multiShipmentError.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentError();
        $singleLabelResponse = \file_get_contents($singleResponse);

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentError();
        $multiLabelResponse = \file_get_contents($multiResponse);

        return [
            'single label validation error' => [$authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label validation error' => [$authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }
}
