<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Common;

class DomesticServicesRequestData extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '22222222220101',
            'returnBillingNumber' => '22222222220701',
            'productCode' => 'V01PAK',
            'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
            'customerReference' => 'Customer Reference',
            'returnReference' => 'Return Shipment Reference',
            'costCentre' => 'Cost Centre XY',
            'shipperCompany' => 'Netresearch GmbH & Co.KG',
            'shipperCountry' => 'DE',
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
            'shipperBankBic' => 'DEX987',
            'shipperBankReference' => 'Bank Reference',
            'shipperBankNote1' => 'Bank Note 1',
            'shipperBankNote2' => 'Bank Note 2',

            'returnCompany' => 'Returns Center',
            'returnCountry' => 'DE',
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
            'recipientCountry' => 'DE',
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
            'premium' => true,
            'bulkyGoods' => true,
//                'identLastName' => 'Smith',
//                'identFirstName' => 'Sam',
//                'identDob' => '1970-01-01',
//                'identMinAge' => '21',
            'parcelOutletRouting' => 'route@example.com',
        ];
    }
}
