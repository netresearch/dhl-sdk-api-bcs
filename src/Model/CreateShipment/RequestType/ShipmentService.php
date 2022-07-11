<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

class ShipmentService
{
    /**
     * Day of Delivery for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit
     *
     * @var ServiceConfigurationDateOfDelivery|null $DayOfDelivery
     */
    protected $DayOfDelivery = null;

    /**
     * Timeframe of delivery for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit
     *
     * @var ServiceConfigurationDeliveryTimeFrame|null $DeliveryTimeframe
     */
    protected $DeliveryTimeframe = null;

    /**
     * Individual sender requirements for product: V06TG: Kurier Taggleich V06WZ: Kurier Wunschzeit.
     *
     * @var ServiceConfigurationISR|null $IndividualSenderRequirement
     */
    protected $IndividualSenderRequirement = null;

    /**
     * Service for package return.
     *
     * @var ServiceConfiguration|null $PackagingReturn
     */
    protected $PackagingReturn = null;

    /**
     * Service of immediatly shipment return in case of non sucessful delivery for product: V06PAK: DHL PAKET TAGGLEICH.
     *
     * @var ServiceConfiguration|null $ReturnImmediately
     */
    protected $ReturnImmediately = null;

    /**
     * Service Notice of non-deliverability.
     *
     * @var ServiceConfiguration|null $NoticeOfNonDeliverability
     */
    protected $NoticeOfNonDeliverability = null;

    /**
     * Service "Endorsement".
     *
     * @var ServiceConfigurationEndorsement|null $Endorsement
     */
    protected $Endorsement = null;

    /**
     * Service visual age check.
     *
     * @var ServiceConfigurationVisualAgeCheck|null $VisualCheckOfAge
     */
    protected $VisualCheckOfAge = null;

    /**
     * Service preferred location.
     *
     * @var ServiceConfigurationDetails|null $PreferredLocation
     */
    protected $PreferredLocation = null;

    /**
     * Service preferred neighbour.
     *
     * @var ServiceConfigurationDetails|null $PreferredNeighbour
     */
    protected $PreferredNeighbour = null;

    /**
     * Service preferred day.
     *
     * @var ServiceConfigurationDetails|null $PreferredDay
     */
    protected $PreferredDay = null;

    /**
     * Invoke service No Neighbour Delivery.
     *
     * @var ServiceConfiguration|null $NoNeighbourDelivery
     */
    protected $NoNeighbourDelivery = null;

    /**
     * Invoke service Named Person Only.
     *
     * @var ServiceConfiguration|null $NamedPersonOnly
     */
    protected $NamedPersonOnly = null;

    /**
     * Invoke service return receipt.
     *
     * @var ServiceConfiguration|null $ReturnReceipt
     */
    protected $ReturnReceipt = null;

    /**
     * Premium for fast and safe delivery of international shipments.
     *
     * @var ServiceConfiguration|null $Premium
     */
    protected $Premium = null;

    /**
     * Service Cash on delivery.
     *
     * @var ServiceConfigurationCashOnDelivery|null $CashOnDelivery
     */
    protected $CashOnDelivery = null;

    /**
     * Insure shipment with higher than standard amount.
     *
     * @var ServiceConfigurationAdditionalInsurance|null $AdditionalInsurance
     */
    protected $AdditionalInsurance = null;

    /**
     * Service to ship bulky goods.
     *
     * @var ServiceConfiguration|null $BulkyGoods
     */
    protected $BulkyGoods = null;

    /**
     * Service configuration for IdentCheck.
     *
     * @var ServiceConfigurationIC|null $IdentCheck
     */
    protected $IdentCheck = null;

    /**
     * Service configuration for ParcelOutletRouting. If email-address is not set, receiver email will be used.
     *
     * @var ServiceConfigurationDetailsOptional|null $ParcelOutletRouting
     */
    protected $ParcelOutletRouting = null;

    /**
     * @param ServiceConfigurationDateOfDelivery|null $dayOfDelivery
     * @return ShipmentService
     */
    public function setDayOfDelivery(ServiceConfigurationDateOfDelivery $dayOfDelivery = null): self
    {
        $this->DayOfDelivery = $dayOfDelivery;
        return $this;
    }

    /**
     * @param ServiceConfigurationDeliveryTimeFrame|null $deliveryTimeframe
     * @return ShipmentService
     */
    public function setDeliveryTimeframe(ServiceConfigurationDeliveryTimeFrame $deliveryTimeframe = null): self
    {
        $this->DeliveryTimeframe = $deliveryTimeframe;
        return $this;
    }

    /**
     * @param ServiceConfigurationISR|null $individualSenderRequirement
     * @return ShipmentService
     */
    public function setIndividualSenderRequirement(ServiceConfigurationISR $individualSenderRequirement = null): self
    {
        $this->IndividualSenderRequirement = $individualSenderRequirement;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $packagingReturn
     * @return ShipmentService
     */
    public function setPackagingReturn(ServiceConfiguration $packagingReturn = null): self
    {
        $this->PackagingReturn = $packagingReturn;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $returnImmediately
     * @return ShipmentService
     */
    public function setReturnImmediately(ServiceConfiguration $returnImmediately = null): self
    {
        $this->ReturnImmediately = $returnImmediately;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $noticeOfNonDeliverability
     * @return ShipmentService
     */
    public function setNoticeOfNonDeliverability(ServiceConfiguration $noticeOfNonDeliverability = null): self
    {
        $this->NoticeOfNonDeliverability = $noticeOfNonDeliverability;
        return $this;
    }

    /**
     * @param ServiceConfigurationEndorsement|null $endorsement
     * @return ShipmentService
     */
    public function setEndorsement(ServiceConfigurationEndorsement $endorsement = null): self
    {
        $this->Endorsement = $endorsement;
        return $this;
    }

    /**
     * @param ServiceConfigurationVisualAgeCheck|null $visualCheckOfAge
     * @return ShipmentService
     */
    public function setVisualCheckOfAge(ServiceConfigurationVisualAgeCheck $visualCheckOfAge = null): self
    {
        $this->VisualCheckOfAge = $visualCheckOfAge;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetails|null $preferredLocation
     * @return ShipmentService
     */
    public function setPreferredLocation(ServiceConfigurationDetails $preferredLocation = null): self
    {
        $this->PreferredLocation = $preferredLocation;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetails|null $preferredNeighbour
     * @return ShipmentService
     */
    public function setPreferredNeighbour(ServiceConfigurationDetails $preferredNeighbour = null): self
    {
        $this->PreferredNeighbour = $preferredNeighbour;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetails|null $preferredDay
     * @return ShipmentService
     */
    public function setPreferredDay(ServiceConfigurationDetails $preferredDay = null): self
    {
        $this->PreferredDay = $preferredDay;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $noNeighbourDelivery
     * @return ShipmentService
     */
    public function setNoNeighbourDelivery(ServiceConfiguration $noNeighbourDelivery = null): self
    {
        $this->NoNeighbourDelivery = $noNeighbourDelivery;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $namedPersonOnly
     * @return ShipmentService
     */
    public function setNamedPersonOnly(ServiceConfiguration $namedPersonOnly = null): self
    {
        $this->NamedPersonOnly = $namedPersonOnly;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $returnReceipt
     * @return ShipmentService
     */
    public function setReturnReceipt(ServiceConfiguration $returnReceipt = null): self
    {
        $this->ReturnReceipt = $returnReceipt;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $premium
     * @return ShipmentService
     */
    public function setPremium(ServiceConfiguration $premium = null): self
    {
        $this->Premium = $premium;
        return $this;
    }

    /**
     * @param ServiceConfigurationCashOnDelivery|null $cashOnDelivery
     * @return ShipmentService
     */
    public function setCashOnDelivery(ServiceConfigurationCashOnDelivery $cashOnDelivery = null): self
    {
        $this->CashOnDelivery = $cashOnDelivery;
        return $this;
    }

    /**
     * @param ServiceConfigurationAdditionalInsurance|null $additionalInsurance
     * @return ShipmentService
     */
    public function setAdditionalInsurance(ServiceConfigurationAdditionalInsurance $additionalInsurance = null): self
    {
        $this->AdditionalInsurance = $additionalInsurance;
        return $this;
    }

    /**
     * @param ServiceConfiguration|null $bulkyGoods
     * @return ShipmentService
     */
    public function setBulkyGoods(ServiceConfiguration $bulkyGoods = null): self
    {
        $this->BulkyGoods = $bulkyGoods;
        return $this;
    }

    /**
     * @param ServiceConfigurationIC|null $identCheck
     * @return ShipmentService
     */
    public function setIdentCheck(ServiceConfigurationIC $identCheck = null): self
    {
        $this->IdentCheck = $identCheck;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetailsOptional|null $parcelOutletRouting
     * @return ShipmentService
     */
    public function setParcelOutletRouting(ServiceConfigurationDetailsOptional $parcelOutletRouting = null): self
    {
        $this->ParcelOutletRouting = $parcelOutletRouting;
        return $this;
    }
}
