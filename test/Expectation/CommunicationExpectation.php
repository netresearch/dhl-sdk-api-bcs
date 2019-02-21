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
     * Assert that logger contains records with HTTP status code and messages.
     *
     * @param \SoapClient $soapClient
     * @param TestLogger $logger
     */
    public static function assertRequestLogged(\SoapClient $soapClient, TestLogger $logger)
    {
        $headers = $soapClient->__getLastRequestHeaders();
        $body = $soapClient->__getLastRequest();
        $expected = "$headers\n$body";

        Assert::assertTrue($logger->hasInfoThatContains($expected), 'Logged messages do not contain request');
    }

    /**
     * @param \SoapClient $soapClient
     * @param TestLogger $logger
     */
    public static function assertResponseLogged(\SoapClient $soapClient, TestLogger $logger)
    {
        $statusRegex = '|^HTTP/\d\.\d\s\d{3}\s[\w\s]+$|m';
        $hasResponseStatus = $logger->hasInfoThatMatches($statusRegex);

        $headers = $soapClient->__getLastResponseHeaders();
        $body = $soapClient->__getLastResponse();
        $expected = "$headers\n$body";

        $hasResponse = $logger->hasInfoThatContains($expected);

        Assert::assertTrue($hasResponseStatus, 'Logged messages do not contain response status code.');
        Assert::assertTrue($hasResponse, 'Logged messages do not contain response');
    }

    /**
     * @param \SoapClient $soapClient
     * @param TestLogger $logger
     */
    public static function assertErrorRequestLogged(\SoapClient $soapClient, TestLogger $logger)
    {
        $headers = $soapClient->__getLastRequestHeaders();
        $body = $soapClient->__getLastRequest();
        $expected = "$headers\n$body";

        Assert::assertTrue($logger->hasErrorThatContains($expected), 'Logged messages do not contain request');
    }

    /**
     * @param \SoapClient $soapClient
     * @param TestLogger $logger
     */
    public static function assertErrorResponseLogged(\SoapClient $soapClient, TestLogger $logger)
    {
        $statusRegex = '|^HTTP/\d\.\d\s\d{3}\s[\w\s]+$|m';
        $hasResponseStatus = $logger->hasErrorThatMatches($statusRegex);

        $headers = $soapClient->__getLastResponseHeaders();
        $body = $soapClient->__getLastResponse();
        $expected = "$headers\n$body";

        $hasResponse = $logger->hasErrorThatContains($expected);

        Assert::assertTrue($hasResponseStatus, 'Logged messages do not contain response status code.');
        Assert::assertTrue($hasResponse, 'Logged messages do not contain response');
    }
}
