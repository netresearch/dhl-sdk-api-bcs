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
     * @param string $requestBody
     * @param string $responseBody
     * @param TestLogger $logger
     */
    public static function assertCommunicationLogged(
        string $requestBody,
        string $responseBody,
        TestLogger $logger
    ): void {
        Assert::assertTrue($logger->hasInfoThatContains($requestBody), 'Info messages do not contain request.');
        Assert::assertTrue($logger->hasInfoThatContains($responseBody), 'Info messages do not contain response.');
    }

    /**
     * Mock client does not send headers, only check for request body being logged.
     *
     * @param string $requestBody
     * @param string $responseBody
     * @param TestLogger $logger
     */
    public static function assertWarningsLogged(
        string $requestBody,
        string $responseBody,
        TestLogger $logger
    ): void {
        Assert::assertTrue($logger->hasWarningThatContains($requestBody), 'Warning messages do not contain request.');
        Assert::assertTrue($logger->hasWarningThatContains($responseBody), 'Warning messages do not contain response.');
    }

    /**
     * Mock client does not send headers, only check for request body being logged.
     *
     * @fixme(nr): logger plugin formats response. 1:1 comparison is not possible.
     *
     * @param string $requestBody
     * @param string $responseBody
     * @param TestLogger $logger
     */
    public static function assertErrorsLogged(
        string $requestBody,
        string $responseBody,
        TestLogger $logger
    ): void {
        Assert::assertTrue($logger->hasErrorThatContains($requestBody), 'Error messages do not contain request.');
        Assert::assertTrue($logger->hasErrorThatContains($responseBody), 'Error messages do not contain response.');
    }
}
