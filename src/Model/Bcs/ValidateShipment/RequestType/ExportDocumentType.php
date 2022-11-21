<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\RequestType;

class ExportDocumentType
{
    /**
     * Export type, only mandatory for international, non EU shipments. Possible values:
     * - OTHER
     * - PRESENT
     * - COMMERCIAL_SAMPLE
     * - COMMERCIAL_GOODS
     * - DOCUMENT
     * - RETURN_OF_GOODS
     *
     * @var string $exportType
     */
    protected $exportType;

    /**
     *  Place of committal is a location.
     *
     * @var string $placeOfCommital
     */
    protected $placeOfCommital;

    /**
     * Additional custom fees to be payed.
     *
     * @var float
     */
    protected $additionalFee;

    /**
     * Description mandatory if ExportType is OTHER.
     *
     * @var string|null $exportTypeDescription
     */
    protected $exportTypeDescription = null;

    /**
     * In case invoice has a number, client app can provide it in this field.
     *
     * @var string|null $invoiceNumber
     */
    protected $invoiceNumber = null;

    /**
     * Element provides terms of trades, incoterms codes. Possible values:
     * - DDP
     * - DXV
     * - DAP
     * - DDX
     * - CPT
     *
     * @var string|null $termsOfTrade
     */
    protected $termsOfTrade = null;

    /**
     * The permit number.
     *
     * @var string|null $permitNumber
     */
    protected $permitNumber = null;

    /**
     * The attestation number.
     *
     * @var string|null $attestationNumber
     */
    protected $attestationNumber = null;

    /**
     * The addressees customer reference.
     *
     * @var string|null
     */
    protected $addresseesCustomsReference = null;

    /**
     * The senders customer reference.
     *
     * @var string|null
     */
    protected $sendersCustomsReference = null;

    /**
     * Sets an electronic export notification.
     *
     * @var ServiceConfiguration|null $WithElectronicExportNtfctn
     */
    protected $WithElectronicExportNtfctn = null;

    /**
     * One or more child elements for every position to be defined within the Export Document.
     *
     * @var ExportDocPosition[] $ExportDocPosition
     */
    protected $ExportDocPosition = null;

    public function __construct(string $exportType, string $placeOfCommital, float $additionalFee)
    {
        $this->exportType = $exportType;
        $this->placeOfCommital = $placeOfCommital;
        $this->additionalFee = $additionalFee;
    }

    /**
     * @param string|null $exportTypeDescription
     * @return ExportDocumentType
     */
    public function setExportTypeDescription(string $exportTypeDescription = null): self
    {
        $this->exportTypeDescription = $exportTypeDescription;
        return $this;
    }

    /**
     * @param string|null $invoiceNumber
     * @return ExportDocumentType
     */
    public function setInvoiceNumber(string $invoiceNumber = null): self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    /**
     * @param string|null $termsOfTrade
     * @return ExportDocumentType
     */
    public function setTermsOfTrade(string $termsOfTrade = null): self
    {
        $this->termsOfTrade = $termsOfTrade;
        return $this;
    }

    /**
     * @param string|null $permitNumber
     * @return ExportDocumentType
     */
    public function setPermitNumber(string $permitNumber = null): self
    {
        $this->permitNumber = $permitNumber;
        return $this;
    }

    /**
     * @param string|null $attestationNumber
     * @return ExportDocumentType
     */
    public function setAttestationNumber(string $attestationNumber = null): self
    {
        $this->attestationNumber = $attestationNumber;
        return $this;
    }

    /**
     * @param string|null $addresseesCustomsReference
     * @return ExportDocumentType
     */
    public function setAddresseesCustomsReference(string $addresseesCustomsReference = null): self
    {
        $this->addresseesCustomsReference = $addresseesCustomsReference;
        return $this;
    }

    /**
     * @param string|null $sendersCustomsReference
     * @return ExportDocumentType
     */
    public function setSendersCustomsReference(string $sendersCustomsReference = null): self
    {
        $this->sendersCustomsReference = $sendersCustomsReference;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $withElectronicExportNtfctn
     * @return ExportDocumentType
     */
    public function setWithElectronicExportNtfctn(ServiceConfiguration $withElectronicExportNtfctn = null): self
    {
        $this->WithElectronicExportNtfctn = $withElectronicExportNtfctn;
        return $this;
    }

    /**
     * @param ExportDocPosition[] $exportDocPositions
     * @return ExportDocumentType
     */
    public function setExportDocPosition(array $exportDocPositions = []): self
    {
        $this->ExportDocPosition = $exportDocPositions;
        return $this;
    }
}
