<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;

class POBox extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '33333333336201',
            'productCode' => 'V62WP',
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
            'recipientNameAddition' => 'XXO',
            'recipientCompany' => 'Organisation AG',
            'recipientEmail' => 'doe@example.org',

            'poBoxRecipientName' => 'Jane Doe',
            'poBoxNumber' => '123456',
            'poBoxPostalCode' => '53113',
            'poBoxCity' => 'Bonn',
            'poBoxCountryCode' => 'DEU',

            'packageWeight' => 0.9,
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
            $data['recipientCompany'],
            $data['recipientNameAddition'],
            $data['recipientEmail']
        );

        $builder->setPOBox(
            $data['poBoxRecipientName'],
            $data['poBoxNumber'],
            $data['poBoxCountryCode'],
            $data['poBoxPostalCode'],
            $data['poBoxCity']
        );

        $builder->setShipmentDetails(
            $data['productCode'],
            $data['shipDate']
        );
        $builder->setPackageDetails($data['packageWeight']);
    }
}
