<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType;

class ValidationMessage
{
    /**
     * @var string|null
     */
    private $property;

    /**
     * @var string|null
     */
    private $validationMessage;

    /**
     * @var string|null
     */
    private $validationState;

    /**
     * @return string|null
     */
    public function getProperty(): ?string
    {
        return $this->property;
    }

    /**
     * @return string|null
     */
    public function getValidationMessage(): ?string
    {
        return $this->validationMessage;
    }

    /**
     * @return string|null
     */
    public function getValidationState(): ?string
    {
        return $this->validationState;
    }
}
