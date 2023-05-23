<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;

class PostOffice extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '33333333330101',
            'productCode' => 'V01PAK',
            'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),

            'shipperCountryCode' => 'DEU',
            'shipperPostalCode' => '04229',
            'shipperCity' => 'Leipzig',
            'shipperStreet' => 'Nonnenstraße',
            'shipperStreetNumber' => '11d',
            'shipperCompany' => 'Netresearch GmbH & Co.KG',

            'recipientName' => 'John Doe',
            'recipientCountryCode' => 'DEU',
            'recipientPostalCode' => '53113',
            'recipientCity' => 'Bonn',
            'recipientStreet' => 'Charles-de-Gaulle-Straße',
            'recipientStreetNumber' => '20',
            'recipientEmail' => 'doe@example.org',

            'postfilialRecipientName' => 'Jane Doe',
            'postfilialNumber' => '502',
            'postfilialPostNumber' => '', // recipient contact via email
            'postfilialPostalCode' => '53113',
            'postfilialCity' => 'Bonn',
            'postfilialCountry' => 'Deutschland',
            'postfilialCountryCode' => 'DEU',
            'postfilialState' => 'NRW',
            'packageWeight' => 1.2,
        ];
    }

    protected function setBuilderData(ShipmentOrderRequestBuilderInterface $builder, array $data): void
    {
        $builder->setSequenceNumber($data['sequenceNumber']);
        $builder->setShipperAccount($data['billingNumber']);

        $builder->setShipperAddress(
            $data['shipperCompany'],
            $data['shipperCountryCode'],
            $data['shipperPostalCode'],
            $data['shipperCity'],
            $data['shipperStreet'],
            $data['shipperStreetNumber']
        );

        $builder->setRecipientAddress(
            $data['recipientName'],
            $data['recipientCountryCode'],
            $data['recipientPostalCode'],
            $data['recipientCity'],
            $data['recipientStreet'],
            $data['recipientStreetNumber'],
            null,
            null,
            $data['recipientEmail']
        );

        $builder->setPostfiliale(
            $data['postfilialRecipientName'],
            $data['postfilialNumber'],
            $data['postfilialCountryCode'],
            $data['postfilialPostalCode'],
            $data['postfilialCity'],
            $data['postfilialPostNumber'],
            $data['postfilialState'],
            $data['postfilialCountry']
        );

        $builder->setShipmentDetails(
            $data['productCode'],
            $data['shipDate']
        );
        $builder->setPackageDetails($data['packageWeight']);
    }
}
