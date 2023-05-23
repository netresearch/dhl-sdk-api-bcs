<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;

class Domestic extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '33333333330101',
            'shipperCountryCode' => 'DEU',
            'shipperPostalCode' => '04229',
            'shipperCity' => 'Leipzig',
            'shipperStreet' => 'Nonnenstraße',
            'shipperStreetNumber' => '11d',
            'shipperCompany' => 'Netresearch GmbH & Co.KG',
            'recipientCountryCode' => 'DEU',
            'recipientPostalCode' => '53113',
            'recipientCity' => 'Bonn',
            'recipientStreet' => 'Charles-de-Gaulle-Straße',
            'recipientStreetNumber' => '20',
            'recipientName' => 'John Doe',
            'productCode' => 'V01PAK',
            'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
            'packageWeight' => 2.4,
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
            $data['recipientStreetNumber']
        );

        $builder->setShipmentDetails(
            $data['productCode'],
            $data['shipDate']
        );

        $builder->setPackageDetails(
            $data['packageWeight']
        );
    }
}
