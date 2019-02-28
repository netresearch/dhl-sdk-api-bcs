<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider;

/**
 * Class ShipmentServiceTestProvider
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentServiceTestProvider
{
    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all label(s) successfully booked.
     *
     * @return mixed[]
     */
    public static function createShipmentsSuccess()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $singleLabelResponseXml = \file_get_contents(__DIR__ . '/_files/createshipment/singleShipmentSuccess.xml');

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentSuccess();
        $multiLabelResponseXml = \file_get_contents(__DIR__ . '/_files/createshipment/multiShipmentSuccess.xml');

        return [
            'single label success' => [$wsdl, $authStorage, $singleLabelRequest, $singleLabelResponseXml],
            'multi label success' => [$wsdl, $authStorage, $multiLabelRequest, $multiLabelResponseXml],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, some label(s) successfully booked.
     *
     * @return mixed[]
     */
    public static function createShipmentsPartialSuccess()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents(__DIR__ . '/_files/createshipment/multiShipmentPartialSuccess.xml');

        return [
            'multi label partial success' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, all label(s) successfully booked, weak validation error occurred.
     *
     * @return mixed[]
     */
    public static function createShipmentsValidationWarning()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createShipmentsValidationWarning();
        $labelResponse = \file_get_contents(__DIR__ . '/_files/createshipment/multiShipmentValidationWarning.xml');

        return [
            'multi label partial success' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, no label(s) successfully booked, hard validation error occurred.
     *
     * @return mixed[]
     */
    public static function createShipmentsError()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentError();
        $singleLabelResponseXml = \file_get_contents(__DIR__ . '/_files/createshipment/singleShipmentError.xml');

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentError();
        $multiLabelResponseXml = \file_get_contents(__DIR__ . '/_files/createshipment/multiShipmentError.xml');

        return [
            'single label validation error' => [$wsdl, $authStorage, $singleLabelRequest, $singleLabelResponseXml],
            'multi label validation error' => [$wsdl, $authStorage, $multiLabelRequest, $multiLabelResponseXml],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, no label(s) successfully booked, server error occurred (500/1000).
     *
     * @return mixed[]
     */
    public static function createServerError()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        //todo(nr): record error response
        $labelResponse = '';

        return [
            'multi label partial success' => [$wsdl, $authStorage, $labelRequest, $labelResponse],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, soap fault thrown.
     *
     * @return mixed[]
     */
    public static function createServerFault()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
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
    public static function cancelShipmentsSuccess()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['222201010035559339'];
        $singleShipmentResponseXml = \file_get_contents(__DIR__ . '/_files/cancelshipment/singleShipmentSuccess.xml');

        $multiShipmentRequest = ['222201010035559346', '222201010035559353'];
        $multiShipmentResponseXml = \file_get_contents(__DIR__ . '/_files/cancelshipment/multiShipmentSuccess.xml');

        return [
            'single label success' => [$wsdl, $authStorage, $singleShipmentRequest, $singleShipmentResponseXml],
            'multi label success' => [$wsdl, $authStorage, $multiShipmentRequest, $multiShipmentResponseXml],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, some shipment(s) successfully cancelled.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsPartialSuccess()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $shipmentRequest = ['ABC1234567890', '222201010035559407'];
        $shipmentResponseXml = \file_get_contents(__DIR__ . '/_files/cancelshipment/multiShipmentPartialSuccess.xml');

        return [
            'multi label partial success' => [$wsdl, $authStorage, $shipmentRequest, $shipmentResponseXml],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, no shipment(s) successfully cancelled.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsError()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleShipmentRequest = ['ABC1234567890'];
        $singleShipmentResponseXml = \file_get_contents(__DIR__ . '/_files/cancelshipment/singleShipmentError.xml');

        $multiShipmentRequest = ['ABC9876543210', 'ABC1234567890'];
        $multiShipmentResponseXml = \file_get_contents(__DIR__ . '/_files/cancelshipment/multiShipmentError.xml');

        return [
            'single label error' => [$wsdl, $authStorage, $singleShipmentRequest, $singleShipmentResponseXml],
            'multi label error' => [$wsdl, $authStorage, $multiShipmentRequest, $multiShipmentResponseXml],
        ];
    }

    /**
     * Provide request and response for the test case
     * - shipment number(s) sent to the API, soap fault thrown.
     *
     * @return mixed[]
     */
    public static function cancelShipmentsValidationError()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
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
