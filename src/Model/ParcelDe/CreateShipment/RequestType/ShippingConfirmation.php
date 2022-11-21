<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class ShippingConfirmation implements \JsonSerializable
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string|null
     */
    private $templateRef;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function setTemplateRef(?string $templateRef): void
    {
        $this->templateRef = $templateRef;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return mixed[] Serializable object properties
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
