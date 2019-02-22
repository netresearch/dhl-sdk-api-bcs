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
}
