<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ExportDocumentType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ExportDocumentType
{
    /**
     * Export type, only mandatory for international, non EU shipments. Possible values:
     * - OTHER
     * - PRESENT
     * - COMMERCIAL_SAMPLE
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

    /*
     * Additional custom fees to be payed.
     *
     * @var float $additionalFee
     */
    protected $additionalFee;

    /**
     * In case invoice has a number, client app can provide it in this field.
     *
     * @var string|null $invoiceNumber
     */
    protected $invoiceNumber = null;

    /**
     * Description mandatory if ExportType is OTHER.
     *
     * @var string|null $exportTypeDescription
     */
    protected $exportTypeDescription = null;

    /**
     * Element provides terms of trades, incoterms codes. Possible values:
     * - DDP
     * - DXV
     * - DDU
     * - DDX
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
     * Sets an electronic export notification.
     *
     * @var ServiceConfiguration $WithElectronicExportNtfctn
     */
    protected $WithElectronicExportNtfctn = null;

    /**
     * One or more child elements for every position to be defined within the Export Document.
     *
     * @var ExportDocPosition[] $ExportDocPosition
     */
    protected $ExportDocPosition = null;

    /**
     * @param string $exportType
     * @param string $placeOfCommital
     * @param float $additionalFee
     */
    public function __construct(string $exportType, string $placeOfCommital, float $additionalFee)
    {
        $this->exportType = $exportType;
        $this->placeOfCommital = $placeOfCommital;
        $this->additionalFee = $additionalFee;
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
     * @param string|null $exportType
     * @return ExportDocumentType
     */
    public function setExportType(string $exportType = null): self
    {
        $this->exportType = $exportType;
        return $this;
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
     * @param string|null $termsOfTrade
     * @return ExportDocumentType
     */
    public function setTermsOfTrade(string $termsOfTrade = null): self
    {
        $this->termsOfTrade = $termsOfTrade;
        return $this;
    }

    /**
     * @param string|null $placeOfCommital
     * @return ExportDocumentType
     */
    public function setPlaceOfCommital(string $placeOfCommital = null): self
    {
        $this->placeOfCommital = $placeOfCommital;
        return $this;
    }

    /**
     * @param float|null $additionalFee
     * @return ExportDocumentType
     */
    public function setAdditionalFee(float $additionalFee = null): self
    {
        $this->additionalFee = $additionalFee;
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
