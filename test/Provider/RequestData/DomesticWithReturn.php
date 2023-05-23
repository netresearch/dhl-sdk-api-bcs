<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;

class DomesticWithReturn extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '33333333330102',
            'returnBillingNumber' => '33333333330701',

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

            'returnCompany' => 'Returns Center',
            'returnCountryCode' => 'DEU',
            'returnPostalCode' => '22419',
            'returnCity' => 'Hamburg',
            'returnStreet' => 'Essener Straße',
            'returnStreetNumber' => '89',

            'productCode' => 'V01PAK',
            'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
            'packageWeight' => 2.4,
        ];
    }

    protected function setBuilderData(ShipmentOrderRequestBuilderInterface $builder, array $data): void
    {
        $builder->setSequenceNumber($data['sequenceNumber']);
        $builder->setShipperAccount($data['billingNumber'], $data['returnBillingNumber']);

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

        $builder->setReturnAddress(
            $data['returnCompany'],
            $data['returnCountryCode'],
            $data['returnPostalCode'],
            $data['returnCity'],
            $data['returnStreet'],
            $data['returnStreetNumber']
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
