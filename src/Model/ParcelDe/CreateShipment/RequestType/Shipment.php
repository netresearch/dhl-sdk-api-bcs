<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\CreateShipment\RequestType;

class Shipment implements \JsonSerializable
{
    /**
     * Determines the DHL Paket product to be used.
     *
     * - V01PAK: DHL PAKET
     * - V53WPAK: DHL PAKET International
     * - V54EPAK: DHL Europaket
     * - V62WP: Warenpost
     * - V66WPI: Warenpost International
     *
     * @var string
     */
    private $product;

    /**
     * 14 digit long number that identifies the contract the shipment is booked on.
     *
     * Please note that in rare cases the last to characters can be letters.
     * Digit 11 and digit 12 must correspondent to the number of the product,
     * e.g. 333333333301tt can only be used for the product V01PAK (DHL Paket).
     *
     * @var string
     */
    private $billingNumber;

    /**
     * Date the shipment is transferred to DHL.
     *
     * The shipment date can be the current date or a date up to a few days in the future.
     * It must not be in the past. Iso format required: yyyy-mm-dd. On the shipment date
     * the shipment will be automatically closed at your end of day closing time.
     *
     * @var string
     */
    private $shipDate;

    /**
     * Shipper information, including contact information, address.
     *
     * Alternatively, a predefined shipper reference can be used.
     *
     * @var ShipperInterface
     */
    private $shipper;

    /**
     * Consignee address information.
     *
     * Either a doorstep address (contact address) including contact information
     * or a drop-point address. One of packstation (parcel locker), or post office
     * (postfiliale/retail shop). To use a German post office box (Postfach) please use contactAddress.
     *
     * @var ConsigneeInterface
     */
    private $consignee;

    /**
     * Details for the shipment, such as dimensions, content.
     *
     * @var Details
     */
    private $details;

    /**
     * A reference number that the user can assign for better association purposes.
     *
     * It appears on shipment labels. To use the reference number for tracking purposes,
     * it should be at least 8 characters long and unique.
     *
     * @var string|null
     */
    private $refNo;

    /**
     * Text field that appears on the shipment label. It cannot be used to search for the shipment.
     *
     * @var string|null
     */
    private $costCenter;

    /**
     * Is only to be indicated by DHL partners.
     *
     * @var string|null
     */
    private $creationSoftware;

    /**
     * Value added services. Please note that services are specific to products
     * and geographies and/or may require individual setup and billing numbers.
     * Please test and contact your account representative in case of questions.
     *
     * @var Services|null
     */
    private $services;

    /**
     * Information necessary for customs about the exported goods.
     *
     * ExportDocument can contain one or more positions as child element.
     * This data is also transferred as electronic declaration to customs.
     * The custom details are mandatory depending on whether the parcel will go
     * to a country outside the European Customs Union.
     * For DHL Parcel International (V53WPAK) CN23 will be returned as a
     * separate document, while for Warenpost International the customs information
     * will be printed onto the shipment label (CN22).
     *
     * @var Customs|null
     */
    private $customs;

    public function __construct(
        string $product,
        string $billingNumber,
        string $shipDate,
        ShipperInterface $shipper,
        ConsigneeInterface $consignee,
        Details $details
    ) {
        $this->product = $product;
        $this->billingNumber = $billingNumber;
        $this->shipDate = $shipDate;
        $this->shipper = $shipper;
        $this->consignee = $consignee;
        $this->details = $details;
    }

    public function setRefNo(?string $refNo): void
    {
        $this->refNo = $refNo;
    }

    public function setCostCenter(?string $costCenter): void
    {
        $this->costCenter = $costCenter;
    }

    public function setCreationSoftware(?string $creationSoftware): void
    {
        $this->creationSoftware = $creationSoftware;
    }

    public function setServices(?Services $services): void
    {
        $this->services = $services;
    }

    public function setCustoms(?Customs $customs): void
    {
        $this->customs = $customs;
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
