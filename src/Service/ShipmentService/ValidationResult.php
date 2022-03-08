<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service\ShipmentService;

use Dhl\Sdk\Paket\Bcs\Api\Data\ValidationResultInterface;

class ValidationResult implements ValidationResultInterface
{
    /**
     * @var string
     */
    private $sequenceNumber;

    /**
     * @var bool
     */
    private $valid;

    /**
     * @var string
     */
    private $message;

    public function __construct(string $sequenceNumber, bool $valid, string $message)
    {
        $this->sequenceNumber = $sequenceNumber;
        $this->valid = $valid;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getSequenceNumber(): string
    {
        return $this->sequenceNumber;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
