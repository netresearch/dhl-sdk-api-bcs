<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType;

class Services implements \JsonSerializable
{
    /**
     * Preferred neighbour.
     *
     * @var string|null
     */
    private $preferredNeighbour;

    /**
     * Preferred location.
     *
     * @var string|null
     */
    private $preferredLocation;

    /**
     * Preferred day of delivery in format YYYY-MM-DD.
     *
     * Shipper can request a preferred day of delivery. The preferred day
     * should be between 2 and 6 working days after handover to DHL.
     *
     * @var string|null
     */
    private $preferredDay;

    /**
     * Trigger checking the age of recipient.
     *
     * Allowed values:
     * - A16
     * - A18
     *
     * @var string|null
     */
    private $visualCheckOfAge;

    /**
     * Delivery can only be signed for by yourself personally.
     *
     * @var bool|null
     */
    private $namedPersonOnly;

    /**
     * Instructions and endorsement how to treat international undeliverable shipment.
     *
     * By default, shipments are returned if undeliverable. There are country specific
     * rules whether the shipment is returned immediately or after a grace period.
     *
     * Allowed values:
     * - RETURN
     * - ABANDON
     *
     * @var string|null
     */
    private $endorsement;

    /**
     * Delivery can only be signed for by yourself personally or by members of your household.
     *
     * @var bool|null
     */
    private $noNeighbourDelivery;

    /**
     * Special instructions for delivery.
     *
     * 2 character code, possible values agreed in contract.
     *
     * @var string|null
     */
    private $individualSenderRequirement;

    /**
     * Undeliverable domestic shipment can be forwarded and held at retail.
     *
     * Notification to email (fallback: consignee email) will be used.
     *
     * @var string|null
     */
    private $parcelOutletRouting;

    /**
     * Choice of premium vs economy parcel.
     *
     * Availability is country dependent and may be manipulated by DHL
     * if choice is not available. Please review the label.
     *
     * @var bool|null
     */
    private $premium;

    /**
     * Closest Drop-Point Delivery
     *
     * Delivery to the drop-point closest to the address of the recipient of the
     * shipment. For this kind of delivery either the phone number and/or the
     * e-mail address of the receiver is mandatory. For shipments using DHL Paket
     * International it is recommended that you choose one of the three delivery types:
     * Economy, Premium, CDP. Otherwise, the current default for the receiver country will be picked.
     *
     * @var bool|null
     */
    private $closestDropPoint;

    /**
     * Sperrgut.
     *
     * @var bool|null
     */
    private $bulkyGoods;

    /**
     * PDDP: Deutsche Post and sender handle import duties instead of consignee. Duties are paid by the shipper.
     *
     * @var bool|null
     */
    private $postalDeliveryDutyPaid;

    /**
     * Requires also DHL Retoure to be set
     *
     * @var bool|null
     */
    private $packagingReturn;

    /**
     * An email notification to the recipient that the shipment is closed (manifested).
     *
     * The notification can be sent to multiple recipient email addresses.
     * This service is about to be deprecated.
     *
     * @var \JsonSerializable|ShippingConfirmation|null
     */
    private $shippingConfirmation;

    /**
     * Requests return label (aka 'retoure') to be provided.
     *
     * Also requires returnAddress and return billing number. Neither weight
     * nor dimension need to be specified for the retoure (flat rate service).
     *
     * @var \JsonSerializable|DhlRetoure|null
     */
    private $dhlRetoure;

    /**
     * Cash on delivery (Nachnahme).
     *
     * Currency must be Euro. Either bank account information or
     * account reference (from customer profile) must be provided.
     * Transfernote1 + 2 are references transmitted during bank transfer.
     * Providing account information explicitly requires elevated privileges.
     *
     * @var \JsonSerializable|CashOnDelivery|null
     */
    private $cashOnDelivery;

    /**
     * Currency and numeric value.
     *
     * @var \JsonSerializable|MonetaryValue|null
     */
    private $additionalInsurance;

    /**
     * Check the identity of the recipient. name (Firstname, lastname), dob or age.
     *
     * This uses firstName and lastName as separate attributes
     * since for identity check an automatic split of a one-line name
     * is not considered reliable enough.
     *
     * @var \JsonSerializable|IdentCheck|null
     */
    private $identCheck;

    public function setPreferredNeighbour(?string $preferredNeighbour): void
    {
        $this->preferredNeighbour = $preferredNeighbour;
    }

    public function setPreferredLocation(?string $preferredLocation): void
    {
        $this->preferredLocation = $preferredLocation;
    }

    public function setPreferredDay(?string $preferredDay): void
    {
        $this->preferredDay = $preferredDay;
    }

    public function setVisualCheckOfAge(?string $visualCheckOfAge): void
    {
        $this->visualCheckOfAge = $visualCheckOfAge;
    }

    public function setNamedPersonOnly(?bool $namedPersonOnly): void
    {
        $this->namedPersonOnly = $namedPersonOnly;
    }

    public function setEndorsement(?string $endorsement): void
    {
        $this->endorsement = $endorsement;
    }

    public function setNoNeighbourDelivery(?bool $noNeighbourDelivery): void
    {
        $this->noNeighbourDelivery = $noNeighbourDelivery;
    }

    public function setIndividualSenderRequirement(?string $individualSenderRequirement): void
    {
        $this->individualSenderRequirement = $individualSenderRequirement;
    }

    public function setParcelOutletRouting(?string $parcelOutletRouting): void
    {
        $this->parcelOutletRouting = $parcelOutletRouting;
    }

    public function setPremium(?bool $premium): void
    {
        $this->premium = $premium;
    }

    public function setClosestDropPoint(?bool $closestDropPoint): void
    {
        $this->closestDropPoint = $closestDropPoint;
    }

    public function setBulkyGoods(?bool $bulkyGoods): void
    {
        $this->bulkyGoods = $bulkyGoods;
    }

    public function setPostalDeliveryDutyPaid(?bool $postalDeliveryDutyPaid): void
    {
        $this->postalDeliveryDutyPaid = $postalDeliveryDutyPaid;
    }

    public function setPackagingReturn(?bool $packagingReturn): void
    {
        $this->packagingReturn = $packagingReturn;
    }

    /**
     * @param \JsonSerializable|ShippingConfirmation|null $shippingConfirmation
     * @return void
     */
    public function setShippingConfirmation(?\JsonSerializable $shippingConfirmation): void
    {
        $this->shippingConfirmation = $shippingConfirmation;
    }

    /**
     * @param \JsonSerializable|DhlRetoure|null $dhlRetoure
     * @return void
     */
    public function setDhlRetoure(?\JsonSerializable $dhlRetoure): void
    {
        $this->dhlRetoure = $dhlRetoure;
    }

    /**
     * @param \JsonSerializable|CashOnDelivery|null $cashOnDelivery
     * @return void
     */
    public function setCashOnDelivery(?\JsonSerializable $cashOnDelivery): void
    {
        $this->cashOnDelivery = $cashOnDelivery;
    }

    /**
     * @param \JsonSerializable|MonetaryValue|null $additionalInsurance
     * @return void
     */
    public function setAdditionalInsurance(?\JsonSerializable $additionalInsurance): void
    {
        $this->additionalInsurance = $additionalInsurance;
    }

    /**
     * @param \JsonSerializable|IdentCheck|null $identCheck
     * @return void
     */
    public function setIdentCheck(?\JsonSerializable $identCheck): void
    {
        $this->identCheck = $identCheck;
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
