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
     * @var MonetaryValue
     */
    private $amount;

    /**
     * Bank account data used for CoD (Cash on Delivery).
     *
     * @var BankAccount|null
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

    public function __construct(MonetaryValue $amount)
    {
        $this->amount = $amount;
    }

    public function setBankAccount(?BankAccount $bankAccount): void
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
