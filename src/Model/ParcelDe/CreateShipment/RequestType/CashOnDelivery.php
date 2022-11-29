<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class CashOnDelivery implements \JsonSerializable
{
    /**
     * Currency and numeric value.
     *
     * @var \JsonSerializable|MonetaryValue
     */
    private $amount;

    /**
     * Bank account data used for CoD (Cash on Delivery).
     *
     * @var \JsonSerializable|BankAccount|null
     */
    private $bankAccount;

    /**
     * @var string|null
     */
    private $accountReference;

    /**
     * @var string|null
     */
    private $transferNote1;

    /**
     * @var string|null
     */
    private $transferNote2;

    /**
     * @param \JsonSerializable|MonetaryValue $amount
     */
    public function __construct(\JsonSerializable $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param \JsonSerializable|BankAccount|null $bankAccount
     * @return void
     */
    public function setBankAccount(?\JsonSerializable $bankAccount): void
    {
        $this->bankAccount = $bankAccount;
    }

    public function setAccountReference(?string $accountReference): void
    {
        $this->accountReference = $accountReference;
    }

    public function setTransferNote1(?string $transferNote1): void
    {
        $this->transferNote1 = $transferNote1;
    }

    public function setTransferNote2(?string $transferNote2): void
    {
        $this->transferNote2 = $transferNote2;
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
