<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\Data\ShipmentInterface;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Service\ServiceFactory;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Provider\ShipmentServiceTestProvider;
use Psr\Log\Test\TestLogger;

/**
 * Class ShipmentServiceTest
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return mixed[]
     */
    public function unauthorizedDataProvider()
    {
        return ShipmentServiceTestProvider::authFailure();
    }

    /**
     * Test authentication error (application level, basic auth).
     *
     * @test
     * @dataProvider unauthorizedDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param ShipmentOrderType[] $shipmentOrders
     * @param string $wsdl
     * @param \SoapFault $fault
     */
    public function createShipmentsAppAuthenticationError(
        AuthenticationStorageInterface $authStorage,
        array $shipmentOrders,
        string $wsdl,
        \SoapFault $fault
    ) {
        $logger = new TestLogger();

        //todo(nr): use mock client that returns $responseXml
        $soapClient = new \SoapClient($wsdl);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger);

        $serviceFactory = new ServiceFactory();
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);
        $shipments = $service->createShipments($shipmentOrders);

        self::assertContainsOnlyInstancesOf(ShipmentInterface::class, $shipments);
        self::assertTrue($logger->hasInfoRecords() || $logger->hasErrorRecords());
    }

    /**
     * Test authentication error (user level, wsi soap header).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createShipmentsUserAuthenticationError(ShipmentRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment success case (all labels available, no issues).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createShipmentsSuccess(ShipmentRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment partial success case (some labels available).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createShipmentsPartialSuccess(ShipmentRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment success case (all labels available, warnings exist).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createShipmentsVerificationWarning(ShipmentRequest $request, string $responseXml)
    {

    }

    public function createShipmentsVerificationError(ShipmentRequest $request, string $responseXml)
    {

    }

    public function createShipmentsServerError(ShipmentRequest $request, string $responseXml)
    {

    }

    public function createShipmentsGeneralError(ShipmentRequest $request, string $responseXml)
    {

    }
}
