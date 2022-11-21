<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

use Dhl\Sdk\Paket\Bcs\Test\Expectation\Query\ArrayPath;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\Query\XPath;
use PHPUnit\Framework\Assert;

class RequestTypeExpectation
{
    private static function getDataByPath(string $path, array $data)
    {
        $keys = explode('/', $path);

        foreach ($keys as $key) {
            if ((array) $data === $data && isset($data[$key])) {
                $data = $data[$key];
            } else {
                return null;
            }
        }

        return $data;
    }

    public static function assertJsonContentsAvailable(array $requestData, string $requestBody): void
    {
        $requestData = array_values($requestData);
        $requestBody = json_decode($requestBody, true);
        foreach ($requestData as $index => $shipmentOrderData) {
            $shipmentOrder = $requestBody[$index];
            foreach ($shipmentOrderData as $key => $expectedValue) {
                $path = ArrayPath::get($key);
                if ($key === 'shipDate') {
                    $expectedValue = $expectedValue->format('Y-m-d');
                }
                Assert::assertEquals($expectedValue, self::getDataByPath($path, $shipmentOrder));
            }
        }
    }

    public static function assertXmlContentsAvailable(array $requestData, string $requestXml): void
    {
        $request = new \SimpleXMLElement($requestXml);
        $request->registerXPathNamespace('SOAP-ENV', 'http://schemas.xmlsoap.org/soap/envelope/');
        $request->registerXPathNamespace('ns1', 'http://dhl.de/webservice/cisbase');
        $request->registerXPathNamespace('ns2', 'http://dhl.de/webservices/businesscustomershipping/3.0');
        $request = $request->xpath('/SOAP-ENV:Envelope/SOAP-ENV:Body/ns2:CreateShipmentOrderRequest')[0];

        foreach ($requestData as $sequenceNumber => $shipmentOrderData) {
            $shipmentOrder = $request->xpath("./ShipmentOrder[./sequenceNumber = '$sequenceNumber']")[0];
            foreach ($shipmentOrderData as $key => $expectedValue) {
                $expectedValue = is_bool($expectedValue) ? intval($expectedValue) : $expectedValue;
                $path = XPath::get($key);
                if ($key === 'shipDate') {
                    $expectedValue = $expectedValue->format('Y-m-d');
                }
                Assert::assertEquals((string) $expectedValue, (string) $shipmentOrder->xpath($path)[0]);
            }
        }
    }

    public static function assertOrderConfigurationAvailable(array $requestData, string $requestXml): void
    {
        $request = new \SimpleXMLElement($requestXml);
        $request->registerXPathNamespace('SOAP-ENV', 'http://schemas.xmlsoap.org/soap/envelope/');
        $request->registerXPathNamespace('ns1', 'http://dhl.de/webservice/cisbase');
        $request->registerXPathNamespace('ns2', 'http://dhl.de/webservices/businesscustomershipping/3.0');
        $request = $request->xpath('/SOAP-ENV:Envelope/SOAP-ENV:Body/ns2:CreateShipmentOrderRequest')[0];

        foreach ($requestData as $key => $expectedValue) {
            $path = XPath::get($key);
            Assert::assertEquals((string) $expectedValue, (string) $request->xpath($path)[0]);
        }
    }
}
