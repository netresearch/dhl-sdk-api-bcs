<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Service;

use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Credentials\AuthenticationStorageProvider;

class CancelShipmentTestProvider
{
    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, all shipment(s) successfully cancelled.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsSuccess(): array
    {
        $singleResponse = __DIR__ . '/../../_files/cancelshipment/singleShipmentSuccess.json';
        $multiResponse = __DIR__ . '/../../_files/cancelshipment/multiShipmentSuccess.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['0034043333301010000010001'];
        $singleShipmentResponse = \file_get_contents($singleResponse);

        $multiShipmentRequest = ['0034043333301010000010002', '0034043333301010000010003'];
        $multiShipmentResponse = \file_get_contents($multiResponse);

        return [
            'single label success' => [$authStorage, $singleShipmentRequest, $singleShipmentResponse],
            'multi label success' => [$authStorage, $multiShipmentRequest, $multiShipmentResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, some shipment(s) successfully cancelled.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsPartialSuccess(): array
    {
        $response = __DIR__ . '/../../_files/cancelshipment/multiShipmentPartialSuccess.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $shipmentRequest = ['0034043333301010000010102', '0034043333301010000010004'];
        $shipmentResponse = \file_get_contents($response);

        return [
            'multi label partial success' => [$authStorage, $shipmentRequest, $shipmentResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, no shipment(s) successfully cancelled.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsError(): array
    {
        $singleResponse = __DIR__ . '/../../_files/cancelshipment/singleShipmentError.json';
        $multiResponse = __DIR__ . '/../../_files/cancelshipment/multiShipmentError.json';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['0034043333301010000010101'];
        $singleShipmentResponse = \file_get_contents($singleResponse);

        $multiShipmentRequest = ['0034043333301010000010103', '0034043333301010000010104'];
        $multiShipmentResponse = \file_get_contents($multiResponse);

        return [
            'single label validation error' => [$authStorage, $singleShipmentRequest, $singleShipmentResponse],
            'multi label validation error' => [$authStorage, $multiShipmentRequest, $multiShipmentResponse],
        ];
    }
}
