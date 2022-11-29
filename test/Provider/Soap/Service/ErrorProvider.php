<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Service;

use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Credentials\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\ShipmentOrder\ShipmentRequestProvider;

class ErrorProvider
{
    /**
     * Provide request and response for the test case
     * - shipment(s) sent to the API, no label(s) successfully booked, server error occurred (10/500/1000).
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function createServerError(): array
    {
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $response = __DIR__ . '/../../_files/createshipment/singleShipmentProcessingFailure.xml';

        $authStorage = AuthenticationStorageProvider::authSuccess();

        $labelRequest = ShipmentRequestProvider::createSingleShipmentSuccess();
        $labelResponse = \file_get_contents($response);

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
        $wsdl = __DIR__ . '/../../_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
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
}
