<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ShipmentService
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ShipmentService
{
    /**
     * Day of Delivery for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit
     *
     * @var ServiceConfigurationDateOfDelivery $DayOfDelivery
     */
    protected $DayOfDelivery = null;

    /**
     * Timeframe of delivery for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit
     *
     * @var ServiceConfigurationDeliveryTimeFrame $DeliveryTimeframe
     */
    protected $DeliveryTimeframe = null;

    /**
     * Preferred Time of delivery for product: V01PAK: DHL PAKET V06PAK: DHL PAKET TAGGLEICH
     *
     * @var ServiceConfigurationDeliveryTimeFrame $PreferredTime
     */
    protected $PreferredTime = null;

    /**
     * Individual sender requirements for product: V06TG: Kurier Taggleich V06WZ: Kurier Wunschzeit.
     *
     * @var ServiceConfigurationISR $IndividualSenderRequirement
     */
    protected $IndividualSenderRequirement = null;

    /**
     * Service for package return.
     *
     * @var ServiceConfiguration $PackagingReturn
     */
    protected $PackagingReturn = null;

    /**
     * Service of immediatly shipment return in case of non sucessful delivery for product: V06PAK: DHL PAKET TAGGLEICH.
     *
     * @var ServiceConfiguration $ReturnImmediately
     */
    protected $ReturnImmediately = null;

    /**
     * Service Notice of non-deliverability.
     *
     * @var ServiceConfiguration $NoticeOfNonDeliverability
     */
    protected $NoticeOfNonDeliverability = null;

    /**
     * Shipment handling for product: V06TG: Kurier Taggleich; V06WZ: Kurier Wunschzeit.
     *
     * @var ServiceConfigurationShipmentHandling $ShipmentHandling
     */
    protected $ShipmentHandling = null;

    /**
     * Service "Endorsement".
     *
     * @var ServiceConfigurationEndorsement $Endorsement
     */
    protected $Endorsement = null;

    /**
     * Service visual age check.
     *
     * @var ServiceConfigurationVisualAgeCheck $VisualCheckOfAge
     */
    protected $VisualCheckOfAge = null;

    /**
     * Service preferred location.
     *
     * @var ServiceConfigurationDetails $PreferredLocation
     */
    protected $PreferredLocation = null;

    /**
     * Service preferred neighbour.
     *
     * @var ServiceConfigurationDetails $PreferredNeighbour
     */
    protected $PreferredNeighbour = null;

    /**
     * Service preferred day.
     *
     * @var ServiceConfigurationDetails $PreferredDay
     */
    protected $PreferredDay = null;

    /**
     * GoGreen.
     *
     * @var ServiceConfiguration $GoGreen
     */
    protected $GoGreen = null;

    /**
     * DHL Kurier Verderbliche Ware.
     *
     * @var ServiceConfiguration $Perishables
     */
    protected $Perishables = null;

    /**
     * Invoke service personal handover.
     *
     * @var ServiceConfiguration $Personally
     */
    protected $Personally = null;

    /**
     * Invoke service No Neighbour Delivery.
     *
     * @var ServiceConfiguration $NoNeighbourDelivery
     */
    protected $NoNeighbourDelivery = null;

    /**
     * Invoke service Named Person Only.
     *
     * @var ServiceConfiguration $NamedPersonOnly
     */
    protected $NamedPersonOnly = null;

    /**
     * Invoke service return receipt.
     *
     * @var ServiceConfiguration $ReturnReceipt
     */
    protected $ReturnReceipt = null;

    /**
     * Premium for fast and safe delivery of international shipments.
     *
     * @var ServiceConfiguration $Premium
     */
    protected $Premium = null;

    /**
     * Service Cash on delivery.
     *
     * @var ServiceConfigurationCashOnDelivery $CashOnDelivery
     */
    protected $CashOnDelivery = null;

    /**
     * Insure shipment with higher than standard amount.
     *
     * @var ServiceConfigurationAdditionalInsurance $AdditionalInsurance
     */
    protected $AdditionalInsurance = null;

    /**
     * Service to ship bulky goods.
     *
     * @var ServiceConfiguration $BulkyGoods
     */
    protected $BulkyGoods = null;

    /**
     * Service configuration for IdentCheck.
     *
     * @var ServiceConfigurationIC $IdentCheck
     */
    protected $IdentCheck = null;

    /**
     * Service configuration for ParcelOutletRouting. If email-address is not set, receiver email will be used.
     *
     * @var ServiceConfigurationDetailsOptional $ParcelOutletRouting
     */
    protected $ParcelOutletRouting = null;

    /**
     * @param ServiceConfigurationDateOfDelivery $dayOfDelivery
     * @return ShipmentService
     */
    public function setDayOfDelivery(ServiceConfigurationDateOfDelivery $dayOfDelivery): self
    {
        $this->DayOfDelivery = $dayOfDelivery;
        return $this;
    }

    /**
     * @param ServiceConfigurationDeliveryTimeFrame $deliveryTimeframe
     * @return ShipmentService
     */
    public function setDeliveryTimeframe(ServiceConfigurationDeliveryTimeFrame $deliveryTimeframe): self
    {
        $this->DeliveryTimeframe = $deliveryTimeframe;
        return $this;
    }

    /**
     * @param ServiceConfigurationDeliveryTimeFrame $preferredTime
     * @return ShipmentService
     */
    public function setPreferredTime(ServiceConfigurationDeliveryTimeFrame $preferredTime): self
    {
        $this->PreferredTime = $preferredTime;
        return $this;
    }

    /**
     * @param ServiceConfigurationISR $individualSenderRequirement
     * @return ShipmentService
     */
    public function setIndividualSenderRequirement(ServiceConfigurationISR $individualSenderRequirement): self
    {
        $this->IndividualSenderRequirement = $individualSenderRequirement;
        return $this;
    }

    /**
     * @param ServiceConfiguration $packagingReturn
     * @return ShipmentService
     */
    public function setPackagingReturn(ServiceConfiguration $packagingReturn): self
    {
        $this->PackagingReturn = $packagingReturn;
        return $this;
    }

    /**
     * @param ServiceConfiguration $returnImmediately
     * @return ShipmentService
     */
    public function setReturnImmediately(ServiceConfiguration $returnImmediately): self
    {
        $this->ReturnImmediately = $returnImmediately;
        return $this;
    }

    /**
     * @param ServiceConfiguration $noticeOfNonDeliverability
     * @return ShipmentService
     */
    public function setNoticeOfNonDeliverability(ServiceConfiguration $noticeOfNonDeliverability): self
    {
        $this->NoticeOfNonDeliverability = $noticeOfNonDeliverability;
        return $this;
    }

    /**
     * @param ServiceConfigurationShipmentHandling $shipmentHandling
     * @return ShipmentService
     */
    public function setShipmentHandling(ServiceConfigurationShipmentHandling $shipmentHandling): self
    {
        $this->ShipmentHandling = $shipmentHandling;
        return $this;
    }

    /**
     * @param ServiceConfigurationEndorsement $endorsement
     * @return ShipmentService
     */
    public function setEndorsement(ServiceConfigurationEndorsement $endorsement): self
    {
        $this->Endorsement = $endorsement;
        return $this;
    }

    /**
     * @param ServiceConfigurationVisualAgeCheck $visualCheckOfAge
     * @return ShipmentService
     */
    public function setVisualCheckOfAge(ServiceConfigurationVisualAgeCheck $visualCheckOfAge): self
    {
        $this->VisualCheckOfAge = $visualCheckOfAge;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetails $preferredLocation
     * @return ShipmentService
     */
    public function setPreferredLocation(ServiceConfigurationDetails $preferredLocation): self
    {
        $this->PreferredLocation = $preferredLocation;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetails $preferredNeighbour
     * @return ShipmentService
     */
    public function setPreferredNeighbour(ServiceConfigurationDetails $preferredNeighbour): self
    {
        $this->PreferredNeighbour = $preferredNeighbour;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetails $preferredDay
     * @return ShipmentService
     */
    public function setPreferredDay(ServiceConfigurationDetails $preferredDay): self
    {
        $this->PreferredDay = $preferredDay;
        return $this;
    }

    /**
     * @param ServiceConfiguration $goGreen
     * @return ShipmentService
     */
    public function setGoGreen(ServiceConfiguration $goGreen): self
    {
        $this->GoGreen = $goGreen;
        return $this;
    }

    /**
     * @param ServiceConfiguration $perishables
     * @return ShipmentService
     */
    public function setPerishables(ServiceConfiguration $perishables): self
    {
        $this->Perishables = $perishables;
        return $this;
    }

    /**
     * @param ServiceConfiguration $personally
     * @return ShipmentService
     */
    public function setPersonally(ServiceConfiguration $personally): self
    {
        $this->Personally = $personally;
        return $this;
    }

    /**
     * @param ServiceConfiguration $noNeighbourDelivery
     * @return ShipmentService
     */
    public function setNoNeighbourDelivery(ServiceConfiguration $noNeighbourDelivery): self
    {
        $this->NoNeighbourDelivery = $noNeighbourDelivery;
        return $this;
    }

    /**
     * @param ServiceConfiguration $namedPersonOnly
     * @return ShipmentService
     */
    public function setNamedPersonOnly(ServiceConfiguration $namedPersonOnly): self
    {
        $this->NamedPersonOnly = $namedPersonOnly;
        return $this;
    }

    /**
     * @param ServiceConfiguration $returnReceipt
     * @return ShipmentService
     */
    public function setReturnReceipt(ServiceConfiguration $returnReceipt): self
    {
        $this->ReturnReceipt = $returnReceipt;
        return $this;
    }

    /**
     * @param ServiceConfiguration $premium
     * @return ShipmentService
     */
    public function setPremium(ServiceConfiguration $premium): self
    {
        $this->Premium = $premium;
        return $this;
    }

    /**
     * @param ServiceConfigurationCashOnDelivery $cashOnDelivery
     * @return ShipmentService
     */
    public function setCashOnDelivery(ServiceConfigurationCashOnDelivery $cashOnDelivery): self
    {
        $this->CashOnDelivery = $cashOnDelivery;
        return $this;
    }

    /**
     * @param ServiceConfigurationAdditionalInsurance $additionalInsurance
     * @return ShipmentService
     */
    public function setAdditionalInsurance(ServiceConfigurationAdditionalInsurance $additionalInsurance): self
    {
        $this->AdditionalInsurance = $additionalInsurance;
        return $this;
    }

    /**
     * @param ServiceConfiguration $bulkyGoods
     * @return ShipmentService
     */
    public function setBulkyGoods(ServiceConfiguration $bulkyGoods): self
    {
        $this->BulkyGoods = $bulkyGoods;
        return $this;
    }

    /**
     * @param ServiceConfigurationIC $identCheck
     * @return ShipmentService
     */
    public function setIdentCheck(ServiceConfigurationIC $identCheck): self
    {
        $this->IdentCheck = $identCheck;
        return $this;
    }

    /**
     * @param ServiceConfigurationDetailsOptional $parcelOutletRouting
     * @return ShipmentService
     */
    public function setParcelOutletRouting(ServiceConfigurationDetailsOptional $parcelOutletRouting): self
    {
        $this->ParcelOutletRouting = $parcelOutletRouting;
        return $this;
    }
}
