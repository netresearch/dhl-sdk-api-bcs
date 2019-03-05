<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

use PHPUnit\Framework\Assert;

/**
 * Class RequestTypeExpectation
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class RequestTypeExpectation
{
    /**
     * @param mixed[] $requestData
     * @param string $requestXml
     */
    public static function assertRequestContentsAvailable(array $requestData, string $requestXml)
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
                Assert::assertEquals((string) $expectedValue, (string) $shipmentOrder->xpath($path)[0]);
            }
        }
    }
}
