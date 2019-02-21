<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider;

use Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;

/**
 * Class ShipmentServiceTestProvider
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentServiceTestProvider
{
    public static function appAuthFailure()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = new AuthenticationStorage(
            'magento_1',
            'eeeeehh…',
            '2222222222_01',
            'pass',
            '2222222222'
        );
        $shipmentOrders = ShipmentRequestProvider::createSingleLabelSuccess();

        return [
            'application auth error' => [$wsdl, $authStorage, $shipmentOrders],
        ];
    }

    public static function userAuthFailure()
    {
        $wsdl = __DIR__ . '/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = new AuthenticationStorage(
            'magento_1',
            '2de26b775e59279464d1c2f8546432e62413372421c672db36eaacfc2f',
            '2222222222_01',
            'no-pass',
            '2222222222'
        );
        $shipmentOrders = ShipmentRequestProvider::createSingleLabelSuccess();
        $responseXml = \file_get_contents(__DIR__ . '/_files/auth/passwordExpired.xml');

        return [
            'user auth error' => [$wsdl, $authStorage, $shipmentOrders, $responseXml],
        ];
    }
}
