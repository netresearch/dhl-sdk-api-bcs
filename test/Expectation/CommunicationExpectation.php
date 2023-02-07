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
     * Assert that messages are logged with info severity.
     *
     * - SOAP mock client does not send headers, only check for request body being logged.
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
     * Assert that messages are logged with error severity.
     *
     * - SOAP mock client does not send headers, only check for request body being logged.
     * - REST client never logs warning severity.
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
     * Assert that messages are logged with error severity.
     *
     * - SOAP mock client does not send headers, only check for request body being logged.
     * - REST client logs all requests with info severity.
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
        $isRequestLogged = $logger->hasErrorThatContains($requestBody) || $logger->hasInfoThatContains($requestBody);
        $isResponseLogged = $logger->hasErrorThatContains($responseBody);

        Assert::assertTrue($isRequestLogged, 'Logged messages do not contain request.');
        Assert::assertTrue($isResponseLogged, 'Logged messages do not contain response.');
    }
}
