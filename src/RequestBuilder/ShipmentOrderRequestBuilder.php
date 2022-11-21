<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\RequestBuilder;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\BankType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\CommunicationType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\CountryType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ExportDocPosition;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ExportDocumentType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\Ident;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\NameType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\NativeAddressType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\PackStationType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\PostfilialeType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ReceiverNativeAddressType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ReceiverType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfiguration;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationAdditionalInsurance;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationCashOnDelivery;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDateOfDelivery;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDeliveryTimeFrame;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDetails;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDetailsOptional;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationEndorsement;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationIC;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationISR;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationVisualAgeCheck;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\Shipment;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentDetailsTypeType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentItemType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentNotificationType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentService;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipperType;

class ShipmentOrderRequestBuilder implements ShipmentOrderRequestBuilderInterface
{
    /**
     * The collected data used to build the request
     *
     * @var mixed[]
     */
    private $data = [];

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
        string $streetNumber,
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
        string $streetNumber,
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
        string $streetNumber,
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

    public function setPremium(): ShipmentOrderRequestBuilderInterface
    {
        $this->data['services']['premium'] = true;

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

    public function create(): ShipmentOrderType
    {
        $sequenceNumber = $this->data['sequenceNumber'] ?? '0';

        if (!isset($this->data['shipper']['reference']) && !isset($this->data['shipper']['address'])) {
            throw new RequestValidatorException("No sender included with shipment order $sequenceNumber.");
        }

        if (isset($this->data['shipper']['address'])) {
            $shipperCountry = new CountryType($this->data['shipper']['address']['country']);

            $shipperName = new NameType($this->data['shipper']['address']['company']);
            $shipperName->setName2($this->data['shipper']['address']['name']);
            $shipperName->setName3($this->data['shipper']['address']['nameAddition']);

            $shipperCommunication = new CommunicationType();
            $shipperCommunication->setContactPerson($this->data['shipper']['address']['contactPerson']);
            $shipperCommunication->setEmail($this->data['shipper']['address']['email']);
            $shipperCommunication->setPhone($this->data['shipper']['address']['phone']);

            $shipperAddress = new NativeAddressType(
                $this->data['shipper']['address']['streetName'],
                $this->data['shipper']['address']['streetNumber'],
                $this->data['shipper']['address']['postalCode'],
                $this->data['shipper']['address']['city']
            );
            $shipperAddress->setAddressAddition($this->data['shipper']['address']['addressAddition']);
            $shipperAddress->setDispatchingInformation($this->data['shipper']['address']['dispatchingInformation']);
            $shipperAddress->setProvince($this->data['shipper']['address']['state']);
            $shipperAddress->setOrigin($shipperCountry);

            $shipper = new ShipperType($shipperName, $shipperAddress);
            $shipper->setCommunication($shipperCommunication);
            $shipperReference = null;
        } else {
            $shipper = null;
            $shipperReference = $this->data['shipper']['reference'];
        }

        if (!isset($this->data['recipient'])) {
            throw new RequestValidatorException("No recipient included with shipment order $sequenceNumber.");
        }

        $receiver = new ReceiverType($this->data['recipient']['address']['name']);

        if (isset($this->data['recipient']['packstation'])) {
            $packstationCountry = new CountryType($this->data['recipient']['packstation']['countryCode']);
            $packstationCountry->setCountry($this->data['recipient']['packstation']['country']);
            $packstationCountry->setState($this->data['recipient']['packstation']['state']);
            $packstation = new PackStationType(
                $this->data['recipient']['packstation']['postNumber'],
                $this->data['recipient']['packstation']['number'],
                $this->data['recipient']['packstation']['postalCode'],
                $this->data['recipient']['packstation']['city']
            );
            $packstation->setProvince($this->data['recipient']['packstation']['state']);
            $packstation->setOrigin($packstationCountry);
            $receiver->setPackstation($packstation);
        } elseif (isset($this->data['recipient']['postfiliale'])) {
            if (
                empty($this->data['recipient']['address']['email'])
                && empty($this->data['recipient']['postfiliale']['postNumber'])
            ) {
                $msg = 'Either recipient email or post number must be set for Postfiliale delivery.';
                throw new RequestValidatorException($msg);
            }

            $postfilialeCountry = new CountryType($this->data['recipient']['postfiliale']['countryCode']);
            $postfilialeCountry->setCountry($this->data['recipient']['postfiliale']['country']);
            $postfilialeCountry->setState($this->data['recipient']['postfiliale']['state']);
            $postfiliale = new PostfilialeType(
                $this->data['recipient']['postfiliale']['number'],
                $this->data['recipient']['postfiliale']['postalCode'],
                $this->data['recipient']['postfiliale']['city']
            );
            $postfiliale->setPostNumber($this->data['recipient']['postfiliale']['postNumber']);
            $postfiliale->setOrigin($postfilialeCountry);
            $receiver->setPostfiliale($postfiliale);
        } elseif (isset($this->data['recipient']['address'])) {
            $receiverCountry = new CountryType($this->data['recipient']['address']['country']);
            $receiverAddress = new ReceiverNativeAddressType(
                $this->data['recipient']['address']['streetName'],
                $this->data['recipient']['address']['streetNumber'],
                $this->data['recipient']['address']['postalCode'],
                $this->data['recipient']['address']['city']
            );
            $receiverAddress->setName2($this->data['recipient']['address']['company']);
            $receiverAddress->setName3($this->data['recipient']['address']['nameAddition']);
            $receiverAddress->setAddressAddition($this->data['recipient']['address']['addressAddition']);
            $receiverAddress->setDispatchingInformation($this->data['recipient']['address']['dispatchingInformation']);
            $receiverAddress->setProvince($this->data['recipient']['address']['state']);
            $receiverAddress->setOrigin($receiverCountry);
            $receiver->setAddress($receiverAddress);
        }

        $receiverCommunication = new CommunicationType();
        $receiverCommunication->setContactPerson($this->data['recipient']['address']['contactPerson'] ?? null);
        $receiverCommunication->setEmail($this->data['recipient']['address']['email'] ?? null);
        $receiverCommunication->setPhone($this->data['recipient']['address']['phone'] ?? null);
        $receiver->setCommunication($receiverCommunication);

        $shipmentItem = new ShipmentItemType($this->data['packageDetails']['weight']);
        if (isset($this->data['packageDetails']['dimensions'])) {
            $shipmentItem->setLengthInCM($this->data['packageDetails']['dimensions']['length']);
            $shipmentItem->setWidthInCM($this->data['packageDetails']['dimensions']['width']);
            $shipmentItem->setHeightInCM($this->data['packageDetails']['dimensions']['height']);
        }

        $shipmentDetails = new ShipmentDetailsTypeType(
            $this->data['shipmentDetails']['product'],
            $this->data['shipper']['billingNumber'],
            $this->data['shipmentDetails']['date'],
            $shipmentItem
        );
        $shipmentDetails->setCustomerReference($this->data['shipmentDetails']['shipmentReference']);
        $shipmentDetails->setReturnShipmentAccountNumber($this->data['shipper']['returnBillingNumber']);
        $shipmentDetails->setReturnShipmentReference($this->data['shipmentDetails']['returnReference']);
        $shipmentDetails->setCostCentre($this->data['shipmentDetails']['costCentre']);

        if (isset($this->data['services'])) {
            $services = new ShipmentService();
            if (isset($this->data['services']['dayOfDelivery'])) {
                $config = new ServiceConfigurationDateOfDelivery(true, $this->data['services']['dayOfDelivery']);
                $services->setDayOfDelivery($config);
            }

            if (isset($this->data['services']['deliveryTimeFrame'])) {
                $config = new ServiceConfigurationDeliveryTimeFrame(true, $this->data['services']['deliveryTimeFrame']);
                $services->setDeliveryTimeframe($config);
            }

            if (isset($this->data['services']['preferredDay'])) {
                $config = new ServiceConfigurationDetails(true, $this->data['services']['preferredDay']);
                $services->setPreferredDay($config);
            }

            if (isset($this->data['services']['preferredLocation'])) {
                $config = new ServiceConfigurationDetails(true, $this->data['services']['preferredLocation']);
                $services->setPreferredLocation($config);
            }

            if (isset($this->data['services']['preferredNeighbour'])) {
                $config = new ServiceConfigurationDetails(true, $this->data['services']['preferredNeighbour']);
                $services->setPreferredNeighbour($config);
            }

            if (isset($this->data['services']['individualSenderRequirement'])) {
                $config = new ServiceConfigurationISR(true, $this->data['services']['individualSenderRequirement']);
                $services->setIndividualSenderRequirement($config);
            }

            if (isset($this->data['services']['packagingReturn'])) {
                $config = new ServiceConfiguration(true);
                $services->setPackagingReturn($config);
            }

            if (isset($this->data['services']['returnImmediately'])) {
                $config = new ServiceConfiguration(true);
                $services->setReturnImmediately($config);
            }

            if (isset($this->data['services']['noticeOfNonDeliverability'])) {
                $config = new ServiceConfiguration(true);
                $services->setNoticeOfNonDeliverability($config);
            }

            if (isset($this->data['services']['endorsement'])) {
                $config = new ServiceConfigurationEndorsement(true, $this->data['services']['endorsement']);
                $services->setEndorsement($config);
            }

            if (isset($this->data['services']['visualCheckOfAge'])) {
                $config = new ServiceConfigurationVisualAgeCheck(true, $this->data['services']['visualCheckOfAge']);
                $services->setVisualCheckOfAge($config);
            }

            if (isset($this->data['services']['noNeighbourDelivery'])) {
                $config = new ServiceConfiguration(true);
                $services->setNoNeighbourDelivery($config);
            }

            if (isset($this->data['services']['namedPersonOnly'])) {
                $config = new ServiceConfiguration(true);
                $services->setNamedPersonOnly($config);
            }

            if (isset($this->data['services']['returnReceipt'])) {
                $config = new ServiceConfiguration(true);
                $services->setReturnReceipt($config);
            }

            if (isset($this->data['services']['premium'])) {
                $config = new ServiceConfiguration(true);
                $services->setPremium($config);
            }

            if (isset($this->data['services']['cod']['codAmount'])) {
                $config = new ServiceConfigurationCashOnDelivery(true, $this->data['services']['cod']['codAmount']);
                $services->setCashOnDelivery($config);
            }

            if (isset($this->data['services']['insuredValue'])) {
                $config = new ServiceConfigurationAdditionalInsurance(
                    true,
                    $this->data['services']['insuredValue']
                );
                $services->setAdditionalInsurance($config);
            }

            if (isset($this->data['services']['bulkyGoods'])) {
                $config = new ServiceConfiguration(true);
                $services->setBulkyGoods($config);
            }

            if (isset($this->data['services']['identCheck'])) {
                $ident = new Ident(
                    $this->data['services']['identCheck']['surname'],
                    $this->data['services']['identCheck']['givenName'],
                    $this->data['services']['identCheck']['dateOfBirth'],
                    $this->data['services']['identCheck']['minimumAge']
                );
                $config = new ServiceConfigurationIC(true, $ident);
                $services->setIdentCheck($config);
            }

            if (isset($this->data['services']['parcelOutletRouting'])) {
                $config = new ServiceConfigurationDetailsOptional(true);
                $config->setDetails($this->data['services']['parcelOutletRouting']['details']);
                $services->setParcelOutletRouting($config);
            }

            $shipmentDetails->setService($services);
        }

        if (isset($this->data['recipient']['notification'])) {
            $notification = new ShipmentNotificationType($this->data['recipient']['notification']);
            $shipmentDetails->setNotification($notification);
        }

        if (isset($this->data['shipper']['bankData'])) {
            $bankData = new BankType();
            $bankData->setAccountOwner($this->data['shipper']['bankData']['owner'] ?? null);
            $bankData->setBankName($this->data['shipper']['bankData']['bankName'] ?? null);
            $bankData->setIban($this->data['shipper']['bankData']['iban'] ?? null);
            $bankData->setBic($this->data['shipper']['bankData']['bic'] ?? null);
            $bankData->setAccountReference($this->data['shipper']['bankData']['accountReference'] ?? null);
            $bankData->setNote1($this->data['shipper']['bankData']['notes'][0] ?? null);
            $bankData->setNote2($this->data['shipper']['bankData']['notes'][1] ?? null);
            $shipmentDetails->setBankData($bankData);
        }

        $shipment = new Shipment($shipmentDetails, $receiver, $shipper);
        $shipment->setShipperReference($shipperReference);

        if (isset($this->data['return']['address'], $this->data['shipper']['returnBillingNumber'])) {
            // only add return receiver if account number was provided
            $returnCountry = new CountryType($this->data['return']['address']['country']);

            $returnName = new NameType($this->data['return']['address']['company']);
            $returnName->setName2($this->data['return']['address']['name']);
            $returnName->setName3($this->data['return']['address']['nameAddition']);

            $returnCommunication = new CommunicationType();
            $returnCommunication->setContactPerson($this->data['return']['address']['contactPerson']);
            $returnCommunication->setEmail($this->data['return']['address']['email']);
            $returnCommunication->setPhone($this->data['return']['address']['phone']);

            $returnAddress = new NativeAddressType(
                $this->data['return']['address']['streetName'],
                $this->data['return']['address']['streetNumber'],
                $this->data['return']['address']['postalCode'],
                $this->data['return']['address']['city']
            );
            $returnAddress->setAddressAddition($this->data['return']['address']['addressAddition']);
            $returnAddress->setDispatchingInformation($this->data['return']['address']['dispatchingInformation']);
            $returnAddress->setProvince($this->data['return']['address']['state']);
            $returnAddress->setOrigin($returnCountry);

            $returnReceiver = new ShipperType($returnName, $returnAddress);
            $returnReceiver->setCommunication($returnCommunication);

            $shipment->setReturnReceiver($returnReceiver);
        }

        if (isset($this->data['customsDetails'])) {
            $exportDocument = new ExportDocumentType(
                $this->data['customsDetails']['exportType'],
                $this->data['customsDetails']['placeOfCommital'],
                $this->data['customsDetails']['additionalFee']
            );
            $exportDocument->setExportTypeDescription($this->data['customsDetails']['exportTypeDescription']);
            $exportDocument->setTermsOfTrade($this->data['customsDetails']['termsOfTrade']);
            $exportDocument->setInvoiceNumber($this->data['customsDetails']['invoiceNumber']);
            $exportDocument->setPermitNumber($this->data['customsDetails']['permitNumber']);
            $exportDocument->setAttestationNumber($this->data['customsDetails']['attestationNumber']);
            $exportDocument->setAddresseesCustomsReference($this->data['customsDetails']['addresseesCustomsReference']);
            $exportDocument->setSendersCustomsReference($this->data['customsDetails']['sendersCustomsReference']);
            if (isset($this->data['customsDetails']['electronicExportNotification'])) {
                $notification = new ServiceConfiguration($this->data['customsDetails']['electronicExportNotification']);
                $exportDocument->setWithElectronicExportNtfctn($notification);
            }

            $exportItems = [];
            foreach ($this->data['customsDetails']['items'] as $itemData) {
                $exportItems[] = new ExportDocPosition(
                    $itemData['description'],
                    $itemData['countryOfOrigin'],
                    $itemData['hsCode'],
                    $itemData['qty'],
                    $itemData['weight'],
                    $itemData['value']
                );
            }
            $exportDocument->setExportDocPosition($exportItems);

            $shipment->setExportDocument($exportDocument);
        }

        $shipmentOrder = new ShipmentOrderType($sequenceNumber, $shipment);

        $this->data = [];

        return $shipmentOrder;
    }
}
