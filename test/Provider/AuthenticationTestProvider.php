<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider;

use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;

class AuthenticationTestProvider
{
    /**
     * Provide request and response for the test case
     * - invalid app credentials sent to the API, soap fault thrown.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function appAuthFailure(): array
    {
        $wsdl = __DIR__ . '/_files/bcs-3.1.2/geschaeftskundenversand-api-3.1.2.wsdl';
        $authStorage = AuthenticationStorageProvider::appAuthFailure();
        $shipmentOrders = ShipmentRequestProvider::createSingleShipmentSuccess();
        $soapFault = new \SoapFault('HTTP', 'Unauthorized');

        return [
            'application auth error' => [$wsdl, $authStorage, $shipmentOrders, $soapFault],
        ];
    }

    /**
     * Provide request and response for the test case
     * - invalid user credentials sent to the API, error returned.
     *
     * @return mixed[]
     * @throws RequestValidatorException
     */
    public static function userAuthFailure(): array
    {
        $wsdl = __DIR__ . '/_files/bcs-3.1.2/geschaeftskundenversand-api-3.1.2.wsdl';
        $authStorage = AuthenticationStorageProvider::userAuthFailure();
        $shipmentOrders = ShipmentRequestProvider::createSingleShipmentSuccess();
        $responseXml = \file_get_contents(__DIR__ . '/_files/auth/passwordExpired.xml');

        return [
            'user auth error' => [$wsdl, $authStorage, $shipmentOrders, $responseXml],
        ];
    }
}
