<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Service;

use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Credentials\AuthenticationStorageProvider;

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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $singleResponse = __DIR__ . '/../../_files/cancelshipment/singleShipmentSuccess.xml';
        $multiResponse = __DIR__ . '/../../_files/cancelshipment/multiShipmentSuccess.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['222201010035559339'];
        $singleShipmentResponse = \file_get_contents($singleResponse);

        $multiShipmentRequest = ['222201010035559346', '222201010035559353'];
        $multiShipmentResponse = \file_get_contents($multiResponse);

        return [
            'single label success' => [$wsdl, $authStorage, $singleShipmentRequest, $singleShipmentResponse],
            'multi label success' => [$wsdl, $authStorage, $multiShipmentRequest, $multiShipmentResponse],
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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $response = __DIR__ . '/../../_files/cancelshipment/multiShipmentPartialSuccess.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $shipmentRequest = ['ABC1234567890', '222201010035559407'];
        $shipmentResponse = \file_get_contents($response);

        return [
            'multi label partial success' => [$wsdl, $authStorage, $shipmentRequest, $shipmentResponse],
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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $singleResponse = __DIR__ . '/../../_files/cancelshipment/singleShipmentError.xml';
        $multiResponse = __DIR__ . '/../../_files/cancelshipment/multiShipmentError.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['ABC1234567890'];
        $singleShipmentResponse = \file_get_contents($singleResponse);

        $multiShipmentRequest = ['ABC9876543210', 'ABC1234567890'];
        $multiShipmentResponse = \file_get_contents($multiResponse);

        return [
            'single label error' => [$wsdl, $authStorage, $singleShipmentRequest, $singleShipmentResponse],
            'multi label error' => [$wsdl, $authStorage, $multiShipmentRequest, $multiShipmentResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, soap fault thrown.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsValidationError(): array
    {
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();
        $shipmentRequest = ['ABC1234'];

        $responseStatus = new \stdClass();
        $responseStatus->statusCode = 11;
        $responseStatus->statusMessage = 'Das verwendete XML ist ungültig.';
        $responseStatus->statusText = 'Not-Wellformed or invalid XML';

        $detail = new \stdClass();
        $detail->ResponseStatus = $responseStatus;

        $soapFault = new \SoapFault(
            'env:Client',
            'Invalid XML: cvc-minLength-valid.',
            null,
            $detail
        );

        return [
            'server error' => [$wsdl, $authStorage, $shipmentRequest, $soapFault],
        ];
    }
}
