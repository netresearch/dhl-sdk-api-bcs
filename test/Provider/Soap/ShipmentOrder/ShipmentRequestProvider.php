<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\ShipmentOrder;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\Domestic;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\DomesticWithReturn;

class ShipmentRequestProvider
{
    private const REQUEST_TYPE = ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_SOAP;

    /**
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createSingleShipmentSuccess(): array
    {
        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();

        foreach ([new Domestic()] as $index => $requestData) {
            $replace = [
                'sequenceNumber' => (string) $index,
                'billingNumber' => '22222222220101',
                'shipperCountry' => 'DE',
                'recipientCountry' =>  'DE',
            ];
            $shipmentOrders[] = $requestData->createShipmentOrder($requestBuilder, self::REQUEST_TYPE, $replace);
        }

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

        $requestBuilder = new ShipmentOrderRequestBuilder();

        foreach ([new Domestic(), new DomesticWithReturn()] as $index => $requestData) {
            $replace = [
                'sequenceNumber' => (string) $index,
                'billingNumber' => '22222222220101',
                'returnBillingNumber' => '22222222220701',
                'shipperCountry' => 'DE',
                'recipientCountry' =>  'DE',
                'returnCountry' => 'DE',
            ];

            $shipmentOrders[] = $requestData->createShipmentOrder($requestBuilder, self::REQUEST_TYPE, $replace);
        }

        return $shipmentOrders;
    }

    /**
     * wrong address.
     *
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentPartialSuccess(): array
    {
        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();

        foreach ([new Domestic(), new DomesticWithReturn()] as $index => $requestData) {
            $replace = [
                'sequenceNumber' => (string) $index,
                'billingNumber' => '22222222220101',
                'returnBillingNumber' => '22222222220701',
                'shipperCountry' => 'DE',
                'recipientCountry' =>  'DE',
                'returnCountry' => 'DE',
            ];
            if ($index > 0) {
                // set recipient address with wrong zip code
                $replace['recipientPostalCode'] = '04229';
            }

            $shipmentOrders[] = $requestData->createShipmentOrder($requestBuilder, self::REQUEST_TYPE, $replace);
        }

        return $shipmentOrders;
    }

    /**
     * wrong address.
     *
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createSingleShipmentError(): array
    {
        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();

        foreach ([new Domestic()] as $index => $requestData) {
            // set recipient address with wrong zip code
            $replace = [
                'sequenceNumber' => (string) $index,
                'billingNumber' => '22222222220101',
                'shipperCountry' => 'DE',
                'recipientCountry' =>  'DE',
                'recipientPostalCode' => '04229',
            ];
            $shipmentOrders[] = $requestData->createShipmentOrder($requestBuilder, self::REQUEST_TYPE, $replace);
        }

        return $shipmentOrders;
    }

    /**
     * wrong address.
     *
     * @return ShipmentOrderType[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentError(): array
    {
        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();

        foreach ([new Domestic(), new DomesticWithReturn()] as $index => $requestData) {
            // set recipient address with wrong zip code
            $replace = [
                'sequenceNumber' => (string) $index,
                'billingNumber' => '22222222220101',
                'returnBillingNumber' => '22222222220701',
                'shipperCountry' => 'DE',
                'recipientCountry' =>  'DE',
                'returnCountry' => 'DE',
                'recipientPostalCode' => '04229'
            ];
            $shipmentOrders[] = $requestData->createShipmentOrder($requestBuilder, self::REQUEST_TYPE, $replace);
        }

        return $shipmentOrders;
    }
}
