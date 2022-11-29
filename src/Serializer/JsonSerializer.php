<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Serializer;

use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\CreateShipmentResponse;

/**
 * JsonSerializer
 *
 * Serializer for outgoing request types and incoming responses.
 */
class JsonSerializer
{
    /**
     * @var string[]
     */
    private $classMap;

    /**
     * JsonSerializer constructor.
     *
     * @param string[] $classMap
     */
    public function __construct(array $classMap = [])
    {
        $this->classMap = $classMap;
    }

    /**
     * @param \JsonSerializable $request
     * @return string
     */
    public function encode(\JsonSerializable $request): string
    {
        // remove empty entries from serialized data (after all objects were converted to array)
        $payload = (string) \json_encode($request);
        $payload = (array) \json_decode($payload, true);
        $payload = $this->filterRecursive($payload);

        return (string) \json_encode($payload);
    }

    /**
     * Recursively filter null and empty strings from the given (nested) array
     *
     * @param mixed[] $element
     * @return mixed[]
     */
    private function filterRecursive(array $element): array
    {
        // Filter null and empty strings
        $filterFunction = static function ($entry): bool {
            return ($entry !== null) && ($entry !== '') && ($entry !== []);
        };

        foreach ($element as &$value) {
            if (\is_array($value)) {
                $value = $this->filterRecursive($value);
            }
        }

        return array_filter($element, $filterFunction);
    }

    /**
     * @param string $jsonResponse
     * @return CreateShipmentResponse
     * @throws \JsonMapper_Exception
     */
    public function decode(string $jsonResponse): CreateShipmentResponse
    {
        $jsonMapper = new \JsonMapper();
        $jsonMapper->bIgnoreVisibility = true;
        $jsonMapper->classMap = $this->classMap;

        $response = \json_decode($jsonResponse, false);

        /** @var CreateShipmentResponse $mappedResponse */
        $mappedResponse = $jsonMapper->map($response, new CreateShipmentResponse());

        return $mappedResponse;
    }
}
