<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\RequestBuilder;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;
use Dhl\Sdk\Paket\Bcs\Exception\RequestValidatorException;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\BankAccount;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\CashOnDelivery;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\ContactAddress;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\Customs;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\CustomsItem;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\Details;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\DhlRetoure;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\Dimension;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\IdentCheck;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\Locker;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\MonetaryValue;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\PostOffice;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\ReturnAddress;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\Services;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\Shipment;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\ShipperAddress;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\ShipperAddressRef;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\ShippingConfirmation;
use Dhl\Sdk\Paket\Bcs\Model\ParcelDe\RequestType\Weight;

class RestRequestBuilder
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
    public function create(): Shipment
    {
        if (!isset($this->data['shipper']['reference']) && !isset($this->data['shipper']['address'])) {
            throw new RequestValidatorException(ShipmentOrderRequestBuilderInterface::MSG_MISSING_SHIPPER);
        }

        if (isset($this->data['shipper']['address'])) {
            $addressData = $this->data['shipper']['address'];
            $shipper = new ShipperAddress(
                $addressData['company'],
                $addressData['streetName'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['country']
            );
            $shipper->setAddressHouse($addressData['streetNumber']);
            $shipper->setName2($addressData['name']);
            $shipper->setName3($addressData['nameAddition']);
            $shipper->setState($addressData['state']);
            $shipper->setAdditionalAddressInformation1($addressData['addressAddition'][0] ?? null);
            $shipper->setAdditionalAddressInformation2($addressData['addressAddition'][1] ?? null);
            $shipper->setContactName($addressData['contactPerson']);
            $shipper->setPhone($addressData['phone']);
            $shipper->setEmail($addressData['email']);
            $shipper->setDispatchingInformation($addressData['dispatchingInformation']);
        } else {
            $shipper = new ShipperAddressRef($this->data['shipper']['reference']);
        }

        if (isset($this->data['recipient']['packstation'])) {
            $consignee = new Locker(
                $this->data['recipient']['address']['name'],
                (int) $this->data['recipient']['packstation']['number'],
                $this->data['recipient']['packstation']['postalCode'],
                $this->data['recipient']['packstation']['city'],
                $this->data['recipient']['packstation']['countryCode'],
                $this->data['recipient']['packstation']['postNumber']
            );
        } elseif (isset($this->data['recipient']['postfiliale'])) {
            if (
                empty($this->data['recipient']['address']['email'])
                && empty($this->data['recipient']['postfiliale']['postNumber'])
            ) {
                throw new RequestValidatorException(ShipmentOrderRequestBuilderInterface::MSG_MISSING_CONTACT);
            }

            $consignee = new PostOffice(
                $this->data['recipient']['address']['name'],
                (int) $this->data['recipient']['postfiliale']['number'],
                $this->data['recipient']['postfiliale']['postalCode'],
                $this->data['recipient']['postfiliale']['city'],
                $this->data['recipient']['postfiliale']['countryCode']
            );
            $consignee->setPostNumber($this->data['recipient']['postfiliale']['postNumber']);
        } elseif (isset($this->data['recipient']['address'])) {
            $addressData = $this->data['recipient']['address'];
            $consignee = new ContactAddress(
                $addressData['name'],
                $addressData['streetName'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['country']
            );
            $consignee->setAddressHouse($addressData['streetNumber']);
            $consignee->setName2($addressData['company']);
            $consignee->setName3($addressData['nameAddition']);
            $consignee->setState($addressData['state']);
            $consignee->setAdditionalAddressInformation1($addressData['addressAddition'][0] ?? null);
            $consignee->setAdditionalAddressInformation2($addressData['addressAddition'][1] ?? null);
            $consignee->setContactName($addressData['contactPerson'] ?? null);
            $consignee->setPhone($addressData['phone'] ?? null);
            $consignee->setEmail($addressData['email'] ?? null);
            $consignee->setDispatchingInformation($addressData['dispatchingInformation']);
        } else {
            throw new RequestValidatorException(ShipmentOrderRequestBuilderInterface::MSG_MISSING_RECIPIENT);
        }

        $weight = new Weight('kg', $this->data['packageDetails']['weight']);
        $details = new Details($weight);
        if (isset($this->data['packageDetails']['dimensions'])) {
            $dim = new Dimension(
                'cm',
                $this->data['packageDetails']['dimensions']['height'],
                $this->data['packageDetails']['dimensions']['length'],
                $this->data['packageDetails']['dimensions']['width']
            );
            $details->setDim($dim);
        }

        $shipment = new Shipment(
            $this->data['shipmentDetails']['product'],
            $this->data['shipper']['billingNumber'],
            $this->data['shipmentDetails']['date'],
            $shipper,
            $consignee,
            $details
        );

        $shipment->setRefNo($this->data['shipmentDetails']['shipmentReference']);
        $shipment->setCostCenter($this->data['shipmentDetails']['costCentre']);
        $shipment->setCreationSoftware(''); // not supported yet

        if (
            isset($this->data['services'])
            || isset($this->data['return']['address'], $this->data['shipper']['returnBillingNumber'])
            || isset($this->data['recipient']['notification'])
        ) {
            $services = new Services();
            $services->setPreferredNeighbour($this->data['services']['preferredNeighbour'] ?? null);
            $services->setPreferredLocation($this->data['services']['preferredLocation'] ?? null);
            $services->setPreferredDay($this->data['services']['preferredDay'] ?? null);
            $services->setVisualCheckOfAge($this->data['services']['visualCheckOfAge'] ?? null);
            $services->setNamedPersonOnly($this->data['services']['namedPersonOnly'] ?? null);
            $services->setEndorsement($this->data['services']['endorsement'] ?? null);
            $services->setNoNeighbourDelivery($this->data['services']['noNeighbourDelivery'] ?? null);
            $services->setIndividualSenderRequirement($this->data['services']['individualSenderRequirement'] ?? null);
            $services->setParcelOutletRouting($this->data['services']['parcelOutletRouting']['details'] ?? null);
            $services->setPremium($this->data['services']['premium'] ?? null);
            $services->setBulkyGoods($this->data['services']['bulkyGoods'] ?? null);
            $services->setPostalDeliveryDutyPaid($this->data['services']['pddp'] ?? null);

            if (isset($this->data['recipient']['notification'])) {
                $shippingConfirmation = new ShippingConfirmation($this->data['recipient']['notification']);
                $services->setShippingConfirmation($shippingConfirmation);
            }

            if (isset($this->data['services']['cod']['codAmount'])) {
                $cod = new CashOnDelivery(new MonetaryValue('EUR', $this->data['services']['cod']['codAmount']));
                if (isset($this->data['shipper']['bankData'])) {
                    $bankAccount = new BankAccount(
                        $this->data['shipper']['bankData']['owner'],
                        $this->data['shipper']['bankData']['iban']
                    );
                    $bankAccount->setBankName($this->data['shipper']['bankData']['bankName'] ?? null);
                    $bankAccount->setBic($this->data['shipper']['bankData']['bic']);
                    $cod->setBankAccount($bankAccount);
                    $cod->setAccountReference($this->data['shipper']['bankData']['accountReference'] ?? null);
                    $cod->setTransferNote1($this->data['shipper']['bankData']['notes'][0] ?? null);
                    $cod->setTransferNote2($this->data['shipper']['bankData']['notes'][1] ?? null);
                }

                $services->setCashOnDelivery($cod);
            }

            if (isset($this->data['services']['insuredValue'])) {
                $services->setAdditionalInsurance(new MonetaryValue('EUR', $this->data['services']['insuredValue']));
            }

            if (isset($this->data['services']['identCheck'])) {
                $ident = new IdentCheck(
                    $this->data['services']['identCheck']['surname'],
                    $this->data['services']['identCheck']['givenName']
                );
                $ident->setDateOfBirth($this->data['services']['identCheck']['dateOfBirth'] ?? null);
                $ident->setMinimumAge($this->data['services']['identCheck']['minimumAge'] ?? null);
                $services->setIdentCheck($ident);
            }

            if (isset($this->data['return']['address'])) {
                $addressData = $this->data['return']['address'];
                $returnAddress = new ReturnAddress(
                    $addressData['company'],
                    $addressData['streetName'],
                    $addressData['postalCode'],
                    $addressData['city'],
                    $addressData['country']
                );
                $returnAddress->setName2($addressData['name']);
                $returnAddress->setName3($addressData['nameAddition']);
                $returnAddress->setState($addressData['state']);
                $returnAddress->setAddressHouse($addressData['streetNumber']);
                $returnAddress->setAdditionalAddressInformation1($addressData['addressAddition'][0] ?? null);
                $returnAddress->setAdditionalAddressInformation2($addressData['addressAddition'][1] ?? null);
                $returnAddress->setContactName($addressData['contactPerson']);
                $returnAddress->setPhone($addressData['phone']);
                $returnAddress->setEmail($addressData['email']);
                $returnAddress->setDispatchingInformation($addressData['dispatchingInformation']);

                $return = new DhlRetoure($this->data['shipper']['returnBillingNumber'], $returnAddress);
                $return->setRefNo($this->data['shipmentDetails']['returnReference'] ?? null);
                $services->setPackagingReturn(true);
                $services->setDhlRetoure($return);
            }

            $shipment->setServices($services);
        }

        if (isset($this->data['customsDetails'])) {
            $customsDetails = $this->data['customsDetails'];

            $exportItems = [];
            foreach ($customsDetails['items'] as $itemData) {
                $exportItem = new CustomsItem(
                    $itemData['description'],
                    $itemData['qty'],
                    new MonetaryValue('EUR', $itemData['value']),
                    new Weight('kg', $itemData['weight'])
                );
                $exportItem->setCountryOfOrigin($itemData['countryOfOrigin']);
                $exportItem->setHsCode($itemData['hsCode']);
                $exportItems[] = $exportItem;
            }

            $customs = new Customs($exportItems, $customsDetails['exportType']);
            $customs->setExportDescription($customsDetails['exportTypeDescription']);
            $customs->setPostalCharges(new MonetaryValue('EUR', $customsDetails['additionalFee']));
            $customs->setShippingConditions($customsDetails['termsOfTrade']);
            $customs->setInvoiceNo($customsDetails['invoiceNumber']);
            $customs->setPermitNo($customsDetails['permitNumber']);
            $customs->setAttestationNo($customsDetails['attestationNumber']);
            $customs->setOfficeOfOrigin($customsDetails['placeOfCommital']);
            $customs->setHasElectronicExportNotification($customsDetails['electronicExportNotification'] ?? null);

            $shipment->setCustoms($customs);
        }

        return $shipment;
    }
}
