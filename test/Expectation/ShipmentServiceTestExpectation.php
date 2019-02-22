<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use PHPUnit\Framework\Assert;

/**
 * Class ShipmentServiceTestExpectation
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentServiceTestExpectation
{
    /**
     * @param string $requestXml
     * @param string $responseXml
     * @param ShipmentInterface[] $result
     */
    public static function assertAllShipmentsBooked(string $requestXml, string $responseXml, array $result)
    {
        $request = new \SimpleXMLElement($requestXml);

        $request->registerXPathNamespace('SOAP-ENV', 'http://schemas.xmlsoap.org/soap/envelope/');
        $request->registerXPathNamespace('ns2', 'http://dhl.de/webservices/businesscustomershipping/3.0');
        $request = $request->xpath('/SOAP-ENV:Envelope/SOAP-ENV:Body/ns2:CreateShipmentOrderRequest')[0];

        $response = new \SimpleXMLElement($responseXml);
        $response->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
        $response->registerXPathNamespace('bcs', 'http://dhl.de/webservices/businesscustomershipping/3.0');
        $response = $response->xpath('/soap:Envelope/soap:Body/bcs:CreateShipmentOrderResponse')[0];

        // assert that all sequence numbers of the request are available in the response
        $expected = $request->xpath('./ShipmentOrder/sequenceNumber');
        $actual = array_map(function (ShipmentInterface $shipment) {
            return $shipment->getSequenceNumber();
        }, $result);
        Assert::assertEmpty(array_diff($expected, $actual), 'Sequence numbers of the response do not match.');

        // assert that all labels are included in the response
        foreach ($result as $shipment) {
            $sn = $shipment->getSequenceNumber();
            $labelData = $response->xpath("./CreationState[sequenceNumber=$sn]/LabelData")[0];
            $expected = $labelData->xpath("./*[substring(name(), string-length(name()) - 3) = 'Data']");
            $actual = array_filter($shipment->getLabels());
            Assert::assertEmpty(array_diff($expected, $actual), "Returned labels are not mapped to result for $sn.");
        }
    }
}
