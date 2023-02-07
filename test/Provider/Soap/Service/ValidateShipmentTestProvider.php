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
     * - shipment(s) sent to the API, all shipments valid, weak validation error occurred.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function validateShipmentsWarning(): array
    {
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';

        $singleFail = __DIR__ . '/../../_files/validateshipment/singleShipmentValidationFailure.xml';
        $multiFail = __DIR__ . '/../../_files/validateshipment/multiShipmentValidationFailure.xml';
        $partialFail = __DIR__ . '/../../_files/validateshipment/multiShipmentPartialSuccess.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $singleFailRequest = ShipmentRequestProvider::createSingleShipmentError();
        $singleFailResponse = \file_get_contents($singleFail);

        $multiFailRequest = ShipmentRequestProvider::createMultiShipmentError();
        $multiFailResponse = \file_get_contents($multiFail);

        $partialFailRequest = ShipmentRequestProvider::createMultiShipmentPartialSuccess();
        $partialFailResponse = \file_get_contents($partialFail);

        return [
            'single label weak warning' => [$wsdl, $authStorage, $singleFailRequest, $singleFailResponse],
            'multi label weak warning' => [$wsdl, $authStorage, $multiFailRequest, $multiFailResponse],
            'multi label partial success' => [$wsdl, $authStorage, $partialFailRequest, $partialFailResponse],
        ];
    }
}
