<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api\Data;

/**
 * @api
 */
interface ValidationResultInterface
{
    /**
     * @return string
     */
    public function getSequenceNumber(): string;

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return string
     */
    public function getMessage(): string;
}
