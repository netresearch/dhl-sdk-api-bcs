<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

use PHPUnit\Framework\Assert;
use Psr\Log\Test\TestLogger;

class CommunicationExpectation
{
    /**
     * Mock client does not send headers, only check for request body being logged.
     *
     * @param string $requestXml
     * @param string $responseXml
     * @param TestLogger $logger
     */
    public static function assertCommunicationLogged(string $requestXml, string $responseXml, TestLogger $logger): void
    {
        Assert::assertTrue($logger->hasInfoThatContains($requestXml), 'Logged messages do not contain request');
        Assert::assertTrue($logger->hasInfoThatContains($responseXml), 'Logged messages do not contain response');
    }

    /**
     * Mock client does not send headers, only check for request body being logged.
     *
     * @param string $requestXml
     * @param string $responseXml
     * @param TestLogger $logger
     */
    public static function assertWarningsLogged(string $requestXml, string $responseXml, TestLogger $logger): void
    {
        Assert::assertTrue($logger->hasWarningThatContains($requestXml), 'Logged messages do not contain request');
        Assert::assertTrue($logger->hasWarningThatContains($responseXml), 'Logged messages do not contain response');
    }

    /**
     * Mock client does not send headers, only check for request body being logged.
     *
     * @param string $requestXml
     * @param string $responseXml
     * @param TestLogger $logger
     */
    public static function assertErrorsLogged(string $requestXml, string $responseXml, TestLogger $logger): void
    {
        Assert::assertTrue($logger->hasErrorThatContains($requestXml), 'Logged messages do not contain request');
        Assert::assertTrue($logger->hasErrorThatContains($responseXml), 'Logged messages do not contain response');
    }
}
