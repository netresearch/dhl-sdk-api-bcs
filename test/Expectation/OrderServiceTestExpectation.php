<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

use Dhl\Sdk\Paket\Bcs\Api\Data\ValidationResultInterface;
use PHPUnit\Framework\Assert;

class OrderServiceTestExpectation
{
    private static function sortResult(array $result): array
    {
        return array_reduce(
            $result,
            function (array $carry, ValidationResultInterface $validationResult) {
                if ($validationResult->isValid()) {
                    $carry['valid'][] = $validationResult->getSequenceNumber();
                } else {
                    $carry['invalid'][] = $validationResult->getSequenceNumber();
                }
                return $carry;
            },
            ['valid' => [], 'invalid' => []]
        );
    }

    /**
     * @param string $requestJson
     * @param string $responseJson
     * @param ValidationResultInterface[] $result
     */
    public static function assertValidationResponse(string $requestJson, string $responseJson, array $result): void
    {
        $request = \json_decode($requestJson, true);
        $response = \json_decode($responseJson, true);

        $actual = self::sortResult($result);

        // assert that all sequence numbers of the request JSON are available in the SDK response
        $expected = array_keys($request['shipments']);
        Assert::assertEmpty(
            array_diff($expected, array_merge($actual['valid'], $actual['invalid'])),
            'Sequence numbers of the response do not match.'
        );

        // assert that all sequence numbers of the response JSON are available in the SDK response
        $expected = array_keys($response['items']);
        Assert::assertEmpty(
            array_diff($expected, array_merge($actual['valid'], $actual['invalid'])),
            'Sequence numbers of the response do not match.'
        );

        // assert that the response status was properly mapped to the response object.
        foreach ($response['items'] as $index => $item) {
            if ($item['sstatus']['status'] === 200) {
                Assert::assertTrue(in_array($index, $actual['valid']));
            } else {
                Assert::assertTrue(in_array($index, $actual['invalid']));
            }
        }
    }
}
