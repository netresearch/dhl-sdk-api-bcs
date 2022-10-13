<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap;

use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;

class ShipmentServiceTestProvider
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
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $singleLabelResponse = \file_get_contents(__DIR__ . '/../_files/validateshipment/singleShipmentSuccess.xml');

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentSuccess();
        $multiLabelResponse = \file_get_contents(__DIR__ . '/../_files/validateshipment/multiShipmentSuccess.xml');

        return [
            'single label success' => [$wsdl, $authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label success' => [$wsdl, $authStorage, $multiLabelRequest, $multiLabelResponse],
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
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents(__DIR__ . '/../_files/validateshipment/multiShipmentPartialSuccess.xml');

        return [
            'multi label partial success' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
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
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createShipmentsValidationWarning();
        $labelResponse = \file_get_contents(__DIR__ . '/../_files/validateshipment/multiShipmentValidationWarning.xml');

        return [
            'multi label partial success' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
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
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentError();
        $singleLabelResponse = \file_get_contents(__DIR__ . '/../_files/validateshipment/singleShipmentError.xml');

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentError();
        $multiLabelResponse = \file_get_contents(__DIR__ . '/../_files/validateshipment/multiShipmentError.xml');

        return [
            'single label validation error' => [$wsdl, $authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label validation error' => [$wsdl, $authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all label(s) successfully booked.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsSuccess(): array
    {
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $singleLabelResponse = \file_get_contents(__DIR__ . '/../_files/createshipment/singleShipmentSuccess.xml');

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentSuccess();
        $multiLabelResponse = \file_get_contents(__DIR__ . '/../_files/createshipment/multiShipmentSuccess.xml');

        return [
            'single label success' => [$wsdl, $authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label success' => [$wsdl, $authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, some label(s) successfully booked.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsPartialSuccess(): array
    {
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents(__DIR__ . '/../_files/createshipment/multiShipmentPartialSuccess.xml');

        return [
            'multi label partial success' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all label(s) successfully booked, weak validation error occurred.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsValidationWarning(): array
    {
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createShipmentsValidationWarning();
        $labelResponse = \file_get_contents(__DIR__ . '/../_files/createshipment/multiShipmentValidationWarning.xml');

        return [
            'multi label partial success' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, no label(s) successfully booked, hard validation error occurred.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createShipmentsError(): array
    {
        $wsdl = __DIR__ . '/_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentError();
        $singleLabelResponse = \file_get_contents(__DIR__ . '/../_files/createshipment/singleShipmentError.xml');

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentError();
        $multiLabelResponse = \file_get_contents(__DIR__ . '/../_files/createshipment/multiShipmentError.xml');

        return [
            'single label validation error' => [$wsdl, $authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label validation error' => [$wsdl, $authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, no label(s) successfully booked, server error occurred (10/500/1000).
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createServerError(): array
    {
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $labelResponse = \file_get_contents(__DIR__ . '/../_files/createshipment/singleShipmentProcessingFailure.xml');

        return [
            'single label server error' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, soap fault thrown.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createServerFault(): array
    {
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();
        $labelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $soapFault = new \SoapFault(
            'soap:Server',
            'INVALID_CONFIGURATION',
            null,
            'System BCS3.3.0.0.0 in environment: SANDBOX is inactive'
        );

        return [
            'server error' => [$wsdl, $authStorage, $labelRequest, $soapFault],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, all shipment(s) successfully cancelled.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsSuccess(): array
    {
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['222201010035559339'];
        $singleShipmentResponse = \file_get_contents(__DIR__ . '/../_files/cancelshipment/singleShipmentSuccess.xml');

        $multiShipmentRequest = ['222201010035559346', '222201010035559353'];
        $multiShipmentResponse = \file_get_contents(__DIR__ . '/../_files/cancelshipment/multiShipmentSuccess.xml');

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
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $shipmentRequest = ['ABC1234567890', '222201010035559407'];
        $shipmentResponse = \file_get_contents(__DIR__ . '/../_files/cancelshipment/multiShipmentPartialSuccess.xml');

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
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['ABC1234567890'];
        $singleShipmentResponse = \file_get_contents(__DIR__ . '/../_files/cancelshipment/singleShipmentError.xml');

        $multiShipmentRequest = ['ABC9876543210', 'ABC1234567890'];
        $multiShipmentResponse = \file_get_contents(__DIR__ . '/../_files/cancelshipment/multiShipmentError.xml');

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
        $wsdl = __DIR__ . '/../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
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
