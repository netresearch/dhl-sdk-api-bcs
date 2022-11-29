<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Service;

use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Credentials\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\ShipmentOrder\ShipmentRequestProvider;

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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $singleResponse = __DIR__ . '/../../_files/validateshipment/singleShipmentSuccess.xml';
        $multiResponse = __DIR__ . '/../../_files/validateshipment/multiShipmentSuccess.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $singleLabelResponse = \file_get_contents($singleResponse);

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentSuccess();
        $multiLabelResponse = \file_get_contents($multiResponse);

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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $response = __DIR__ . '/../../_files/validateshipment/multiShipmentPartialSuccess.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents($response);

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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $response = __DIR__ . '/../../_files/validateshipment/multiShipmentValidationWarning.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $labelResponse = \file_get_contents($response);

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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $singleResponse = __DIR__ . '/../../_files/validateshipment/singleShipmentError.xml';
        $multiResponse = __DIR__ . '/../../_files/validateshipment/multiShipmentError.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleLabelRequest = ShipmentRequestProvider::createSingleShipmentError();
        $singleLabelResponse = \file_get_contents($singleResponse);

        $multiLabelRequest = ShipmentRequestProvider::createMultiShipmentError();
        $multiLabelResponse = \file_get_contents($multiResponse);

        return [
            'single label validation error' => [$wsdl, $authStorage, $singleLabelRequest, $singleLabelResponse],
            'multi label validation error' => [$wsdl, $authStorage, $multiLabelRequest, $multiLabelResponse],
        ];
    }
}
