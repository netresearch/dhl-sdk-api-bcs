<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap;

use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;

class ShipmentRequestProvider
{
    /**
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createSingleShipmentSuccess(): array
    {
        $shipmentOrders = [];
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        $requestBuilder = new ShipmentOrderRequestBuilder();
        $requestBuilder->setShipperAccount('22222222220101', '22222222220701');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('John Doe', 'DE', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20');
        $requestBuilder->setReturnAddress('', 'DE', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20', 'John Doe');
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(2.4);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        return $shipmentOrders;
    }

    /**
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentSuccess(): array
    {
        $shipmentOrders = [];
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        $requestBuilder = new ShipmentOrderRequestBuilder();

        $requestBuilder->setSequenceNumber('0');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('John Doe', 'DE', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20');
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(2.4);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        $requestBuilder->setSequenceNumber('1');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('Jane Doe', 'DE', '53113', 'Bonn', 'Sträßchensweg', '2');
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(1.125);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        return $shipmentOrders;
    }

    /**
     * wrong address and "print only if codeable" is active.
     *
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentPartialSuccess(): array
    {
        $shipmentOrders = [];
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        $requestBuilder = new ShipmentOrderRequestBuilder();

        $requestBuilder->setSequenceNumber('0');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('John Doe', 'DE', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20');
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(2.4);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        $requestBuilder->setSequenceNumber('1');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('Jane Doe', 'DE', '04229', 'Bonn', 'Sträßchensweg', '2'); // wrong zip code
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(1.125);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        return $shipmentOrders;
    }

    /**
     * wrong address but "print only if codeable" is not active.
     *
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createShipmentsValidationWarning(): array
    {
        $shipmentOrders = [];
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        $requestBuilder = new ShipmentOrderRequestBuilder();

        $requestBuilder->setSequenceNumber('0');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('John Doe', 'DE', '53113', 'Bonn', 'Charles-de-Gaulle-Straße', '20');
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(2.4);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        $requestBuilder->setSequenceNumber('1');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('Jane Doe', 'DE', '04229', 'Bonn', 'Sträßchensweg', '2'); // wrong zip code
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(1.125);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        return $shipmentOrders;
    }

    /**
     * wrong address and "print only if codeable" is active.
     *
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createSingleShipmentError(): array
    {
        $shipmentOrders = [];
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        $requestBuilder = new ShipmentOrderRequestBuilder();

        $requestBuilder->setSequenceNumber('0');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('Jane Doe', 'DE', '04229', 'Bonn', 'Sträßchensweg', '2'); // wrong zip code
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(1.125);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        return $shipmentOrders;
    }

    /**
     * wrong address and "print only if codeable" is active.
     *
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentError(): array
    {
        $shipmentOrders = [];
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        $requestBuilder = new ShipmentOrderRequestBuilder();

        $requestBuilder->setSequenceNumber('0');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress(
            'Netresearch GmbH & Co.KG',
            'DE',
            '04229',
            'Leipzig',
            'Nonnenstraße',
            '11d'
        );
        $requestBuilder->setRecipientAddress(
            'John Doe',
            'DE',
            '04229',
            'Bonn',
            'Charles-de-Gaulle-Straße',
            '20'
        ); // wrong zip code
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(2.4);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        $requestBuilder->setSequenceNumber('1');
        $requestBuilder->setShipperAccount('22222222220101');
        $requestBuilder->setShipperAddress('Netresearch GmbH & Co.KG', 'DE', '04229', 'Leipzig', 'Nonnenstraße', '11d');
        $requestBuilder->setRecipientAddress('Jane Doe', 'DE', '04229', 'Bonn', 'Sträßchensweg', '2'); // wrong zip code
        $requestBuilder->setShipmentDetails('V01PAK', new \DateTime(date('Y-m-d', $tsShip)));
        $requestBuilder->setPackageDetails(1.125);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        return $shipmentOrders;
    }
}
