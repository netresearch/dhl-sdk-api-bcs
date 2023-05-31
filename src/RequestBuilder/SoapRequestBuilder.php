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

class SoapRequestBuilder
{
    /**
     * The collected data used to build the request
     *
     * @var mixed[]
     */
    private $data;

    /**
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @throws RequestValidatorException
     */
    public function create(): ShipmentOrderType
    {
        $sequenceNumber = $this->data['sequenceNumber'] ?? '0';

        if (!isset($this->data['shipper']['reference']) && !isset($this->data['shipper']['address'])) {
            throw new RequestValidatorException(ShipmentOrderRequestBuilderInterface::MSG_MISSING_SHIPPER);
        }

        if (isset($this->data['shipper']['address'])) {
            $shipperCountry = new CountryType($this->data['shipper']['address']['countryCode']);

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
            throw new RequestValidatorException(ShipmentOrderRequestBuilderInterface::MSG_MISSING_RECIPIENT);
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
                throw new RequestValidatorException(ShipmentOrderRequestBuilderInterface::MSG_MISSING_CONTACT);
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
        } elseif (isset($this->data['recipient']['pobox'])) {
            $message = sprintf(
                ShipmentOrderRequestBuilderInterface::MSG_SERVICE_UNSUPPORTED,
                'PO Box Delivery'
            );
            throw new RequestValidatorException($message);
        } elseif (isset($this->data['recipient']['address'])) {
            $receiverCountry = new CountryType($this->data['recipient']['address']['countryCode']);
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
            if (isset($this->data['services']['pddp'])) {
                $message = sprintf(
                    ShipmentOrderRequestBuilderInterface::MSG_SERVICE_UNSUPPORTED,
                    'Postal Delivery Duty Paid'
                );
                throw new RequestValidatorException($message);
            }

            if (isset($this->data['services']['signedForByRecipient'])) {
                $message = sprintf(
                    ShipmentOrderRequestBuilderInterface::MSG_SERVICE_UNSUPPORTED,
                    'Signed for by recipient'
                );
                throw new RequestValidatorException($message);
            }

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

            if (isset($this->data['services']['deliveryType'])) {
                switch ($this->data['services']['deliveryType']) {
                    case ShipmentOrderRequestBuilderInterface::DELIVERY_TYPE_PREMIUM:
                        $config = new ServiceConfiguration(true);
                        $services->setPremium($config);
                        break;
                    case ShipmentOrderRequestBuilderInterface::DELIVERY_TYPE_ECONOMY:
                        $config = new ServiceConfiguration(false);
                        $services->setPremium($config);
                        break;
                    case ShipmentOrderRequestBuilderInterface::DELIVERY_TYPE_CDP:
                        $message = sprintf(
                            ShipmentOrderRequestBuilderInterface::MSG_SERVICE_UNSUPPORTED,
                            'Closest Droppoint'
                        );
                        throw new RequestValidatorException($message);
                }

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
            $returnCountry = new CountryType($this->data['return']['address']['countryCode']);

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
