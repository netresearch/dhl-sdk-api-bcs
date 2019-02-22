<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

use PHPUnit\Framework\Assert;
use Psr\Log\Test\TestLogger;

/**
 * Class CommunicationExpectation
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CommunicationExpectation
{
    /**
     * Mock client does not send headers, only check for request body being logged.
     *
     * @param string $requestXml
     * @param TestLogger $logger
     */
    public static function assertRequestLogged(string $requestXml, TestLogger $logger)
    {
        Assert::assertTrue($logger->hasInfoThatContains($requestXml), 'Logged messages do not contain request');
    }

    /**
     * Mock client does not send headers, only check for response body being logged.
     *
     * @param string $responseXml
     * @param TestLogger $logger
     */
    public static function assertResponseLogged(string $responseXml, TestLogger $logger)
    {
        Assert::assertTrue($logger->hasInfoThatContains($responseXml), 'Logged messages do not contain response');
    }

    /**
     * Mock client does not send headers, only check for request body being logged.
     *
     * @param string $requestXml
     * @param TestLogger $logger
     */
    public static function assertErrorRequestLogged(string $requestXml, TestLogger $logger)
    {
        Assert::assertTrue($logger->hasErrorThatContains($requestXml), 'Logged messages do not contain request');
    }

    /**
     * Mock client does not send headers, only check for response body being logged.
     *
     * @param string $responseXml
     * @param TestLogger $logger
     */
    public static function assertErrorResponseLogged(string $responseXml, TestLogger $logger)
    {
        Assert::assertTrue($logger->hasErrorThatContains($responseXml), 'Logged messages do not contain response');
    }
}
