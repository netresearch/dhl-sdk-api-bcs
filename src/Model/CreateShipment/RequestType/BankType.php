<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * BankType
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class BankType
{
    /**
     * Name of bank account owner.
     *
     * @var string|null $accountOwner
     */
    protected $accountOwner = null;

    /**
     * Name of bank.
     *
     * @var string|null $bankName
     */
    protected $bankName = null;

    /**
     * IBAN code of bank account.
     *
     * @var string|null $iban
     */
    protected $iban = null;

    /**
     * Reason for payment (line 1).
     *
     * @var string|null $note1
     */
    protected $note1 = null;

    /**
     * Reason for payment (line 2).
     *
     * @var string|null $note2
     */
    protected $note2 = null;

    /**
     * Bank-Information-Code (BankCCL) of bank account.
     *
     * @var string|null $bic
     */
    protected $bic = null;

    /**
     * Account reference to customer profile.
     *
     * @var string|null $accountreference
     */
    protected $accountreference = null;

    /**
     * @param string|null $accountOwner
     * @return BankType
     */
    public function setAccountOwner(string $accountOwner = null): self
    {
        $this->accountOwner = $accountOwner;
        return $this;
    }

    /**
     * @param string|null $bankName
     * @return BankType
     */
    public function setBankName(string $bankName = null): self
    {
        $this->bankName = $bankName;
        return $this;
    }

    /**
     * @param string|null $iban
     * @return BankType
     */
    public function setIban(string $iban = null): self
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @param string|null $note1
     * @return BankType
     */
    public function setNote1(string $note1 = null): self
    {
        $this->note1 = $note1;
        return $this;
    }

    /**
     * @param string|null $note2
     * @return BankType
     */
    public function setNote2(string $note2 = null): self
    {
        $this->note2 = $note2;
        return $this;
    }

    /**
     * @param string|null $bic
     * @return BankType
     */
    public function setBic(string $bic = null): self
    {
        $this->bic = $bic;
        return $this;
    }

    /**
     * @param string|null $accountReference
     * @return BankType
     */
    public function setAccountReference(string $accountReference = null): self
    {
        $this->accountreference = $accountReference;
        return $this;
    }
}
