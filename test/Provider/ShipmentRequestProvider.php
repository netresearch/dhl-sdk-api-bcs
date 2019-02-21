<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider;

use Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;

/**
 * Class ShipmentRequestProvider
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentRequestProvider
{
    /**
     * @return ShipmentOrderType[]
     */
    public static function createSingleLabelSuccess()
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        $requestBuilder = new ShipmentOrderRequestBuilder();
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('DE', '04229', 'Leipzig', 'Nonnenstraße', '11d', 'Netresearch GmbH & Co.KG');
        $requestBuilder->setRecipientAddress('DE', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20', 'Happy Customer');
        $requestBuilder->setShipmentDetails('V01PAK', date('Y-m-d', $tsShip));
        $requestBuilder->setPackageDetails(2.4);
        $shipmentOrder = $requestBuilder->create();

        return [$shipmentOrder];
    }
}
