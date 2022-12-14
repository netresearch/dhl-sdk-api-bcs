<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Http\ShipmentOrder;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\AbstractRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\Domestic;
use Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData\DomesticWithReturn;

class ShipmentRequestProvider
{
    private const REQUEST_TYPE = ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_REST;

    /**
     * @return \JsonSerializable[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createSingleShipmentSuccess(): array
    {
        $requestBuilder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);

        return array_map(
            function (AbstractRequestData $requestData) use ($requestBuilder) {
                return $requestData->createShipmentOrder($requestBuilder);
            },
            [new Domestic()]
        );
    }

    /**
     * @return \JsonSerializable[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentSuccess(): array
    {
        $requestBuilder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);

        return array_map(
            function (AbstractRequestData $requestData) use ($requestBuilder) {
                return $requestData->createShipmentOrder($requestBuilder);
            },
            [new Domestic(), new DomesticWithReturn()]
        );
    }

    /**
     * one valid request, others invalid (multiple validation warnings).
     *
     * @return \JsonSerializable[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentPartialSuccess(): array
    {
        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);

        foreach ([new Domestic(), new DomesticWithReturn()] as $index => $requestData) {
            /** @var AbstractRequestData $requestData */
            // set shipper address with wrong street number, recipient address with wrong zip code
            $replace = ($index > 0) ? ['shipperStreetNumber' => '4711', 'recipientPostalCode' => '04229'] : [];
            $shipmentOrders[] = $requestData->createShipmentOrder($requestBuilder, $replace);
        }

        return $shipmentOrders;
    }

    /**
     * wrong address.
     *
     * @return \JsonSerializable[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createSingleShipmentError(): array
    {
        $requestBuilder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);

        return array_map(
            function (AbstractRequestData $requestData) use ($requestBuilder) {
                // set recipient address with wrong zip code
                $replace = ['recipientPostalCode' => '04229'];
                return $requestData->createShipmentOrder($requestBuilder, $replace);
            },
            [new Domestic()]
        );
    }

    /**
     * Syntactical error, no address validation involved.
     *
     * @return \JsonSerializable[]
     * @throws RequestValidatorException
     * @throws \Exception
     */
    public static function createMultiShipmentError(): array
    {
        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder(self::REQUEST_TYPE);

        foreach ([new Domestic(), new DomesticWithReturn()] as $requestData) {
            /** @var AbstractRequestData $requestData */
            // set ISO-2 country format
            $replace = ['shipperCountry' => 'DE', 'recipientCountry' => 'DE', 'returnCountry' => 'DE'];
            $shipmentOrders[] = $requestData->createShipmentOrder($requestBuilder, $replace);
        }

        return $shipmentOrders;
    }
}
