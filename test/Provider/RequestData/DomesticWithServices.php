<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;

class DomesticWithServices extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '33333333330101',
            'returnBillingNumber' => '33333333330701',
            'productCode' => 'V01PAK',
            'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
            'customerReference' => 'Customer Reference',
            'returnReference' => 'Return Shipment Reference',
            'costCentre' => 'Cost Centre XY',
            'shipperCompany' => 'Netresearch GmbH & Co.KG',
            'shipperCountryCode' => 'DEU',
            'shipperPostalCode' => '04229',
            'shipperCity' => 'Leipzig',
            'shipperStreet' => 'Nonnenstraße',
            'shipperStreetNumber' => '11d',
            'shipperName' => 'Foo Bar',
            'shipperNameAddition' => 'Sr.',
            'shipperEmail' => 'foo@example.com',
            'shipperPhone' => '+49 341 1234567890',
            'shipperContactPerson' => 'Fox Baz',
            'shipperState' => 'SN',
            'shipperDispatchingInformation' => 'dispatch soon',
            'shipperAddressAddition1' => 'add something',
            'shipperAddressAddition2' => 'add more',
            'shipperBankOwner' => 'Owen Banks',
            'shipperBankName' => 'Wall Institute',
            'shipperBankIban' => 'DEX123',
            'shipperBankBic' => 'DEX987XX',
            'shipperBankReference' => 'Bank Reference',
            'shipperBankNote1' => 'Bank Note 1',
            'shipperBankNote2' => 'Bank Note 2',

            'returnCompany' => 'Returns Center',
            'returnCountryCode' => 'DEU',
            'returnPostalCode' => '22419',
            'returnCity' => 'Hamburg',
            'returnStreet' => 'Essener Straße',
            'returnStreetNumber' => '89',
            'returnName' => 'Sandy Smith',
            'returnNameAddition' => 'SXO',
            'returnEmail' => 'returns@example.com',
            'returnPhone' => '+49 40 1234567890',
            'returnContactPerson' => 'Steven Smith',
            'returnState' => 'HH',
            'returnDispatchingInformation' => 'dispatch sooner',
            'returnAddressAddition1' => 'add something return',
            'returnAddressAddition2' => 'add more return',

            'recipientName' => 'Jane Doe',
            'recipientCountryCode' => 'DEU',
            'recipientPostalCode' => '53113',
            'recipientCity' => 'Bonn',
            'recipientStreet' => 'Sträßchensweg',
            'recipientStreetNumber' => '2',
            'recipientNameAddition' => 'XXO',
            'recipientCompany' => 'Organisation AG',
            'recipientEmail' => 'doe@example.org',
            'recipientPhone' => '+49 228 911110',
            'recipientContactPerson' => 'Yılmaz Yılmaz',
            'recipientState' => 'NW',
            'recipientDispatchingInformation' => 'dispatch tomorrow',
            'recipientAddressAddition1' => 'add something ship',
            'recipientAddressAddition2' => 'add more ship',

            'recipientNotification' => 'notify@example.org',

            'packageWeight' => 1.12,
            'packageValue' => 24.99,
            'codAmount' => 29.99,

            'packageLength' => 30,
            'packageWidth' => 20,
            'packageHeight' => 15,

            'preferredDay' => date('Y-m-d', time() + 60 * 60 * 24 * 4),
            'preferredLocation' => 'Mailbox',
            'preferredNeighbour' => 'Mr. Smith',
            'senderRequirement' => 'Do not kick.',
            'visualCheckOfAge' => 'A18',
            'noNeighbourDelivery' => true,
            'namedPersonOnly' => true,
            'returnReceipt' => true,
            'bulkyGoods' => true,
            'signedForByRecipient' => true,
//                'identLastName' => 'Smith',
//                'identFirstName' => 'Sam',
//                'identDob' => '1970-01-01',
//                'identMinAge' => '21',
            'parcelOutletRouting' => 'route@example.com',
        ];
    }

    protected function setBuilderData(ShipmentOrderRequestBuilderInterface $builder, array $data): void
    {
        $builder->setSequenceNumber($data['sequenceNumber']);
        $builder->setShipperAccount(
            $data['billingNumber'],
            $data['returnBillingNumber']
        );

        $builder->setShipperAddress(
            $data['shipperCompany'],
            $data['shipperCountryCode'],
            $data['shipperPostalCode'],
            $data['shipperCity'],
            $data['shipperStreet'],
            $data['shipperStreetNumber'],
            $data['shipperName'],
            $data['shipperNameAddition'],
            $data['shipperEmail'],
            $data['shipperPhone'],
            $data['shipperContactPerson'],
            $data['shipperState'],
            $data['shipperDispatchingInformation'],
            [
                $data['shipperAddressAddition1'],
                $data['shipperAddressAddition2'],
            ]
        );

        $builder->setShipperBankData(
            $data['shipperBankOwner'],
            $data['shipperBankName'],
            $data['shipperBankIban'],
            $data['shipperBankBic'],
            $data['shipperBankReference'],
            [
                $data['shipperBankNote1'],
                $data['shipperBankNote2'],
            ]
        );

        $builder->setReturnAddress(
            $data['returnCompany'],
            $data['returnCountryCode'],
            $data['returnPostalCode'],
            $data['returnCity'],
            $data['returnStreet'],
            $data['returnStreetNumber'],
            $data['returnName'],
            $data['returnNameAddition'],
            $data['returnEmail'],
            $data['returnPhone'],
            $data['returnContactPerson'],
            $data['returnState'],
            $data['returnDispatchingInformation'],
            [
                $data['returnAddressAddition1'],
                $data['returnAddressAddition2'],
            ]
        );

        $builder->setShipmentDetails(
            $data['productCode'],
            $data['shipDate'],
            $data['customerReference'],
            $data['returnReference'],
            $data['costCentre']
        );

        $builder->setPackageDetails($data['packageWeight']);
        $builder->setPackageDimensions(
            $data['packageWidth'],
            $data['packageLength'],
            $data['packageHeight']
        );

        $builder->setRecipientAddress(
            $data['recipientName'],
            $data['recipientCountryCode'],
            $data['recipientPostalCode'],
            $data['recipientCity'],
            $data['recipientStreet'],
            $data['recipientStreetNumber'],
            $data['recipientCompany'],
            $data['recipientNameAddition'],
            $data['recipientEmail'],
            $data['recipientPhone'],
            $data['recipientContactPerson'],
            $data['recipientState'],
            $data['recipientDispatchingInformation'],
            [
                $data['recipientAddressAddition1'],
                $data['recipientAddressAddition2'],
            ]
        );

        $builder->setRecipientNotification($data['recipientNotification']);
        $builder->setInsuredValue($data['packageValue']);
        $builder->setCodAmount($data['codAmount']);
        $builder->setPreferredDay($data['preferredDay']);
        $builder->setPreferredLocation($data['preferredLocation']);
        $builder->setPreferredNeighbour($data['preferredNeighbour']);
        $builder->setIndividualSenderRequirement($data['senderRequirement']);
        $builder->setVisualCheckOfAge($data['visualCheckOfAge']);
        if (!empty($data['noNeighbourDelivery'])) {
            $builder->setNoNeighbourDelivery();
        }
        if (!empty($data['namedPersonOnly'])) {
            $builder->setNamedPersonOnly();
        }
        if (!empty($data['returnReceipt'])) {
            $builder->setReturnReceipt();
        }
        if (!empty($data['bulkyGoods'])) {
            $builder->setBulkyGoods();
        }
        if (!empty($data['signedForByRecipient'])) {
            $builder->setSignedForByRecipient();
        }
//        $builder->setIdentCheck(
//            $data['identLastName'],
//            $data['identFirstName'],
//            $data['identDob'],
//            $data['identMinAge']
//        );
        $builder->setParcelOutletRouting($data['parcelOutletRouting']);
    }
}
