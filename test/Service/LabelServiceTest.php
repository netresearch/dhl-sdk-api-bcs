<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Ecommerce\Test\Service;

/**
 * Class LabelServiceTest
 *
 * @package Dhl\Sdk\Ecommerce\Test
 * @author  Sebastian Ertner <sebastian.ertner@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class LabelServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test authentication error (application level, basic auth).
     *
     * @param LabelRequest $request
     * @param string $responseXml
     */
    public function createLabelAppAuthenticationError(LabelRequest $request, string $responseXml)
    {

    }

    /**
     * Test authentication error (user level, wsi soap header).
     *
     * @param LabelRequest $request
     * @param string $responseXml
     */
    public function createLabelUserAuthenticationError(LabelRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment success case (all labels available, no issues).
     *
     * @param LabelRequest $request
     * @param string $responseXml
     */
    public function createLabelSuccess(LabelRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment partial success case (some labels available).
     *
     * @param LabelRequest $request
     * @param string $responseXml
     */
    public function createLabelPartialSuccess(LabelRequest $request, string $responseXml)
    {

    }

    /**
     * Test shipment success case (all labels available, warnings exist).
     *
     * @param LabelRequest $request
     * @param string $responseXml
     */
    public function createLabelVerificationWarning(LabelRequest $request, string $responseXml)
    {

    }

    public function createLabelVerificationError(LabelRequest $request, string $responseXml)
    {

    }

    public function createLabelServerError(LabelRequest $request, string $responseXml)
    {

    }

    public function createLabelGeneralError(LabelRequest $request, string $responseXml)
    {

    }
}
