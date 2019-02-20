<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Service;

/**
 * Class ShipmentServiceTest
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Sebastian Ertner <sebastian.ertner@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test authentication error (application level, basic auth).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createLabelAppAuthenticationError(ShipmentRequest $request, string $responseXml)
    {

    }

    /**
     * Test authentication error (user level, wsi soap header).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createLabelUserAuthenticationError(ShipmentRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment success case (all labels available, no issues).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createLabelSuccess(ShipmentRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment partial success case (some labels available).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createLabelPartialSuccess(ShipmentRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment success case (all labels available, warnings exist).
     *
     * @param ShipmentRequest $request
     * @param string $responseXml
     */
    public function createLabelVerificationWarning(ShipmentRequest $request, string $responseXml)
    {

    }

    public function createLabelVerificationError(ShipmentRequest $request, string $responseXml)
    {

    }

    public function createLabelServerError(ShipmentRequest $request, string $responseXml)
    {

    }

    public function createLabelGeneralError(ShipmentRequest $request, string $responseXml)
    {

    }
}
