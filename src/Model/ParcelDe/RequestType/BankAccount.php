<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class BankAccount implements \JsonSerializable
{
    /**
     * @var string
     */
    private $accountHolder;

    /**
     * @var string
     */
    private $iban;

    /**
     * @var string|null
     */
    private $bankName;

    /**
     * @var string|null
     */
    private $bic;

    public function __construct(string $accountHolder, string $iban)
    {
        $this->accountHolder = $accountHolder;
        $this->iban = $iban;
    }

    public function setBankName(?string $bankName): void
    {
        $this->bankName = $bankName;
    }

    public function setBic(?string $bic): void
    {
        $this->bic = $bic;
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
