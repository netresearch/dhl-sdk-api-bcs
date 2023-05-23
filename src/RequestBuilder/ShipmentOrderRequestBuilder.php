<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\RequestBuilder;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;

class ShipmentOrderRequestBuilder implements ShipmentOrderRequestBuilderInterface
{
    /**
     * @var string
     */
    private $requestType;

    /**
     * The collected data used to build the request
     *
     * @var mixed[]
     */
    private $data = [];

    public function __construct(string $requestType = self::REQUEST_TYPE_SOAP)
    {
        $this->requestType = $requestType;
    }

    public function setSequenceNumber(string $sequenceNumber): ShipmentOrderRequestBuilderInterface
    {
        $this->data['sequenceNumber'] = $sequenceNumber;

        return $this;
    }

    public function setShipperAccount(
        string $billingNumber,
        string $returnBillingNumber = null
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['shipper']['billingNumber'] = $billingNumber;
        $this->data['shipper']['returnBillingNumber'] = $returnBillingNumber;

        return $this;
    }

    public function setShipperAddress(
        string $company,
        string $country,
        string $postalCode,
        string $city,
        string $streetName,
        string $streetNumber = '',
        string $name = null,
        string $nameAddition = null,
        string $email = null,
        string $phone = null,
        string $contactPerson = null,
        string $state = null,
        string $dispatchingInformation = null,
        array $addressAddition = []
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['shipper']['address']['company'] = $company;
        $this->data['shipper']['address']['country'] = $country;
        $this->data['shipper']['address']['postalCode'] = $postalCode;
        $this->data['shipper']['address']['city'] = $city;
        $this->data['shipper']['address']['streetName'] = $streetName;
        $this->data['shipper']['address']['streetNumber'] = $streetNumber;
        $this->data['shipper']['address']['name'] = $name;
        $this->data['shipper']['address']['nameAddition'] = $nameAddition;
        $this->data['shipper']['address']['email'] = $email;
        $this->data['shipper']['address']['phone'] = $phone;
        $this->data['shipper']['address']['contactPerson'] = $contactPerson;
        $this->data['shipper']['address']['state'] = $state;
        $this->data['shipper']['address']['dispatchingInformation'] = $dispatchingInformation;
        $this->data['shipper']['address']['addressAddition'] = $addressAddition;

        return $this;
    }

    public function setShipperBankData(
        string $accountOwner = null,
        string $bankName = null,
        string $iban = null,
        string $bic = null,
        string $accountReference = null,
        array $notes = []
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['shipper']['bankData']['owner'] = $accountOwner;
        $this->data['shipper']['bankData']['bankName'] = $bankName;
        $this->data['shipper']['bankData']['iban'] = $iban;
        $this->data['shipper']['bankData']['bic'] = $bic;
        $this->data['shipper']['bankData']['accountReference'] = $accountReference;
        $this->data['shipper']['bankData']['notes'] = $notes;

        return $this;
    }

    public function setReturnAddress(
        string $company,
        string $country,
        string $postalCode,
        string $city,
        string $streetName,
        string $streetNumber = '',
        string $name = null,
        string $nameAddition = null,
        string $email = null,
        string $phone = null,
        string $contactPerson = null,
        string $state = null,
        string $dispatchingInformation = null,
        array $addressAddition = []
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['return']['address']['company'] = $company;
        $this->data['return']['address']['country'] = $country;
        $this->data['return']['address']['postalCode'] = $postalCode;
        $this->data['return']['address']['city'] = $city;
        $this->data['return']['address']['streetName'] = $streetName;
        $this->data['return']['address']['streetNumber'] = $streetNumber;
        $this->data['return']['address']['name'] = $name;
        $this->data['return']['address']['nameAddition'] = $nameAddition;
        $this->data['return']['address']['email'] = $email;
        $this->data['return']['address']['phone'] = $phone;
        $this->data['return']['address']['contactPerson'] = $contactPerson;
        $this->data['return']['address']['state'] = $state;
        $this->data['return']['address']['dispatchingInformation'] = $dispatchingInformation;
        $this->data['return']['address']['addressAddition'] = $addressAddition;

        return $this;
    }

    public function setRecipientAddress(
        string $name,
        string $country,
        string $postalCode,
        string $city,
        string $streetName,
        string $streetNumber = '',
        string $company = null,
        string $nameAddition = null,
        string $email = null,
        string $phone = null,
        string $contactPerson = null,
        string $state = null,
        string $dispatchingInformation = null,
        array $addressAddition = []
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['recipient']['address']['name'] = $name;
        $this->data['recipient']['address']['country'] = $country;
        $this->data['recipient']['address']['postalCode'] = $postalCode;
        $this->data['recipient']['address']['city'] = $city;
        $this->data['recipient']['address']['streetName'] = $streetName;
        $this->data['recipient']['address']['streetNumber'] = $streetNumber;
        $this->data['recipient']['address']['company'] = $company;
        $this->data['recipient']['address']['nameAddition'] = $nameAddition;
        $this->data['recipient']['address']['email'] = $email;
        $this->data['recipient']['address']['phone'] = $phone;
        $this->data['recipient']['address']['contactPerson'] = $contactPerson;
        $this->data['recipient']['address']['state'] = $state;
        $this->data['recipient']['address']['dispatchingInformation'] = $dispatchingInformation;
        $this->data['recipient']['address']['addressAddition'] = $addressAddition;

        return $this;
    }

    public function setRecipientNotification(string $email): ShipmentOrderRequestBuilderInterface
    {
        $this->data['recipient']['notification'] = $email;

        return $this;
    }

    public function setShipmentDetails(
        string $productCode,
        \DateTimeInterface $shipmentDate,
        string $shipmentReference = null,
        string $returnReference = null,
        string $costCentre = null
    ): ShipmentOrderRequestBuilderInterface {
        $timezone = new \DateTimeZone('Europe/Berlin');

        if ($shipmentDate instanceof \DateTime) {
            $shipmentDate = \DateTimeImmutable::createFromMutable($shipmentDate);
            $shipmentDate = $shipmentDate->setTimezone($timezone);
        } elseif ($shipmentDate instanceof \DateTimeImmutable) {
            $shipmentDate = $shipmentDate->setTimezone($timezone);
        }

        $this->data['shipmentDetails']['product'] = $productCode;
        $this->data['shipmentDetails']['date'] = $shipmentDate->format('Y-m-d');
        $this->data['shipmentDetails']['shipmentReference'] = $shipmentReference;
        $this->data['shipmentDetails']['returnReference'] = $returnReference;
        $this->data['shipmentDetails']['costCentre'] = $costCentre;

        return $this;
    }

    public function setPackageDetails(float $weight): ShipmentOrderRequestBuilderInterface
    {
        $this->data['packageDetails']['weight'] = $weight;

        return $this;
    }

    public function setPackageDimensions(int $width, int $length, int $height): ShipmentOrderRequestBuilderInterface
    {
        $this->data['packageDetails']['dimensions']['width'] = $width;
        $this->data['packageDetails']['dimensions']['length'] = $length;
        $this->data['packageDetails']['dimensions']['height'] = $height;

        return $this;
    }

    public function setInsuredValue(float $insuredValue): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['insuredValue'] = $insuredValue;

        return $this;
    }

    public function setCodAmount(float $codAmount): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['cod']['codAmount'] = $codAmount;

        return $this;
    }

    public function setPackstation(
        string $recipientName,
        string $recipientPostNumber,
        string $packstationNumber,
        string $countryCode,
        string $postalCode,
        string $city,
        string $state = null,
        string $country = null
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['recipient']['address']['name'] = $recipientName;
        $this->data['recipient']['packstation']['postNumber'] = $recipientPostNumber;
        $this->data['recipient']['packstation']['number'] = $packstationNumber;
        $this->data['recipient']['packstation']['countryCode'] = $countryCode;
        $this->data['recipient']['packstation']['postalCode'] = $postalCode;
        $this->data['recipient']['packstation']['city'] = $city;
        $this->data['recipient']['packstation']['state'] = $state;
        $this->data['recipient']['packstation']['country'] = $country;

        return $this;
    }

    public function setPostfiliale(
        string $recipientName,
        string $postfilialNumber,
        string $countryCode,
        string $postalCode,
        string $city,
        string $postNumber = null,
        string $state = null,
        string $country = null
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['recipient']['address']['name'] = $recipientName;
        $this->data['recipient']['postfiliale']['number'] = $postfilialNumber;
        $this->data['recipient']['postfiliale']['countryCode'] = $countryCode;
        $this->data['recipient']['postfiliale']['postalCode'] = $postalCode;
        $this->data['recipient']['postfiliale']['city'] = $city;
        $this->data['recipient']['postfiliale']['postNumber'] = $postNumber;
        $this->data['recipient']['postfiliale']['state'] = $state;
        $this->data['recipient']['postfiliale']['country'] = $country;

        return $this;
    }

    public function setShipperReference(string $reference): ShipmentOrderRequestBuilderInterface
    {
        $this->data['shipper']['reference'] = $reference;

        return $this;
    }

    public function setDayOfDelivery(string $cetDate): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['dayOfDelivery'] = $cetDate;

        return $this;
    }

    public function setDeliveryTimeFrame(string $timeFrameType): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['deliveryTimeFrame'] = $timeFrameType;

        return $this;
    }

    public function setPreferredDay(string $cetDate): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['preferredDay'] = $cetDate;

        return $this;
    }

    public function setPreferredLocation(string $location): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['preferredLocation'] = $location;

        return $this;
    }

    public function setPreferredNeighbour(string $neighbour): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['preferredNeighbour'] = $neighbour;

        return $this;
    }

    public function setIndividualSenderRequirement(string $handlingDetails): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['individualSenderRequirement'] = $handlingDetails;

        return $this;
    }

    public function setPackagingReturn(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['packagingReturn'] = true;

        return $this;
    }

    public function setReturnImmediately(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['returnImmediately'] = true;

        return $this;
    }

    public function setNoticeOfNonDeliverability(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['noticeOfNonDeliverability'] = true;

        return $this;
    }

    public function setShipmentEndorsementType(string $endorsementType): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['endorsement'] = $endorsementType;

        return $this;
    }

    public function setVisualCheckOfAge(string $ageType): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['visualCheckOfAge'] = $ageType;

        return $this;
    }

    public function setNoNeighbourDelivery(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['noNeighbourDelivery'] = true;

        return $this;
    }

    public function setNamedPersonOnly(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['namedPersonOnly'] = true;

        return $this;
    }

    public function setReturnReceipt(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['returnReceipt'] = true;

        return $this;
    }

    public function setDeliveryType(string $deliveryType): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['deliveryType'] = $deliveryType;

        return $this;
    }

    public function setBulkyGoods(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['bulkyGoods'] = true;

        return $this;
    }

    public function setIdentCheck(
        string $lastName,
        string $firstName,
        string $dateOfBirth,
        string $minimumAge
    ): ShipmentOrderRequestBuilderInterface {
        $this->data['services']['identCheck']['surname'] = $lastName;
        $this->data['services']['identCheck']['givenName'] = $firstName;
        $this->data['services']['identCheck']['dateOfBirth'] = $dateOfBirth;
        $this->data['services']['identCheck']['minimumAge'] = $minimumAge;

        return $this;
    }

    public function setParcelOutletRouting(string $email = null): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['parcelOutletRouting']['active'] = true;
        $this->data['services']['parcelOutletRouting']['details'] = $email;

        return $this;
    }

    public function setDeliveryDutyPaid(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['pddp'] = true;

        return $this;
    }

    public function setCustomsDetails(
        string $exportType,
        string $placeOfCommital,
        float $additionalFee,
        string $exportTypeDescription = null,
        string $termsOfTrade = null,
        string $invoiceNumber = null,
        string $permitNumber = null,
        string $attestationNumber = null,
        bool $electronicExportNotification = null,
        string $sendersCustomsReference = null,
        string $addresseesCustomsReference = null
    ): ShipmentOrderRequestBuilderInterface {
        if (!isset($this->data['customsDetails']['items'])) {
            $this->data['customsDetails']['items'] = [];
        }

        $this->data['customsDetails']['exportType'] = $exportType;
        $this->data['customsDetails']['exportTypeDescription'] = $exportTypeDescription;
        $this->data['customsDetails']['placeOfCommital'] = $placeOfCommital;
        $this->data['customsDetails']['additionalFee'] = $additionalFee;
        $this->data['customsDetails']['termsOfTrade'] = $termsOfTrade;
        $this->data['customsDetails']['invoiceNumber'] = $invoiceNumber;
        $this->data['customsDetails']['permitNumber'] = $permitNumber;
        $this->data['customsDetails']['attestationNumber'] = $attestationNumber;
        $this->data['customsDetails']['electronicExportNotification'] = $electronicExportNotification;
        $this->data['customsDetails']['sendersCustomsReference'] = $sendersCustomsReference;
        $this->data['customsDetails']['addresseesCustomsReference'] = $addresseesCustomsReference;

        return $this;
    }

    public function addExportItem(
        int $qty,
        string $description,
        float $value,
        float $weight,
        string $hsCode,
        string $countryOfOrigin
    ): ShipmentOrderRequestBuilderInterface {
        if (!isset($this->data['customsDetails']['items'])) {
            $this->data['customsDetails']['items'] = [];
        }

        $this->data['customsDetails']['items'][] = [
            'qty' => $qty,
            'description' => $description,
            'weight' => $weight,
            'value' => $value,
            'hsCode' => $hsCode,
            'countryOfOrigin' => $countryOfOrigin,
        ];

        return $this;
    }

    public function create(): object
    {
        if ($this->requestType === self::REQUEST_TYPE_SOAP) {
            $requestBuilder = new SoapRequestBuilder($this->data);
            $shipmentOrder = $requestBuilder->create();
        } elseif ($this->requestType === self::REQUEST_TYPE_REST) {
            $requestBuilder = new RestRequestBuilder($this->data);
            $shipmentOrder = $requestBuilder->create();
        } else {
            throw new \RuntimeException('Cannot instantiate request builder for service type ' . $this->requestType);
        }

        $this->data = [];

        return $shipmentOrder;
    }
}
