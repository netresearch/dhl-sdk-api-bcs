<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\RequestData;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;

class CrossBorderWithServices extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '33333333330101',
            'productCode' => 'V53PAK',
            'shipDate' => new \DateTime(date('c', $tsShip)),
            'shipperCompany' => 'Netresearch GmbH & Co.KG',
            'shipperCountry' => 'DEU',
            'shipperPostalCode' => '04229',
            'shipperCity' => 'Leipzig',
            'shipperStreet' => 'Nonnenstraße',
            'shipperStreetNumber' => '11d',
            'recipientCountry' => 'USA',
            'recipientPostalCode' => '89109',
            'recipientCity' => 'Las Vegas',
            'recipientStreet' => 'S Las Vegas Blvd',
            'recipientStreetNumber' => '3131',
            'recipientName' => 'Vince Viva',
            'packageWeight' => 2.4,

            'postalDeliveryDutyPaid' => true,
            'premium' => true,
            'closestDropPoint' => false,
            'bulkyGoods' => true,

            'exportType' => 'OTHER',
            'placeOfCommital' => 'Leipzig',
            'additionalFee' => 7.99,
            'exportTypeDescription' => 'Lekker Double Vla',
            'termsOfTrade' => 'DAP',
            'invoiceNumber' => '2121212121',
            'permitNumber' => 'p3rm1t n0.',
            'attestationNumber' => '4tt35t4t10n n0.',
            'electronicExportNotification' => false,
            'exportItem1Qty' => 2,
            'exportItem1Desc' => 'Export Desc 1',
            'exportItem1Weight' => 3.37,
            'exportItem1Value' => 29.99,
            'exportItem1HsCode' => '42031000',
            'exportItem1Origin' => 'CHN',
            'exportItem2Qty' => 1,
            'exportItem2Desc' => 'Export Desc 2',
            'exportItem2Weight' => 2.22,
            'exportItem2Value' => 35,
            'exportItem2HsCode' => '62099010',
            'exportItem2Origin' => 'USA',
        ];
    }

    protected function setBuilderData(ShipmentOrderRequestBuilderInterface $builder, array $data): void
    {
        $builder->setSequenceNumber($data['sequenceNumber']);
        $builder->setShipperAccount($data['billingNumber']);

        $builder->setShipperAddress(
            $data['shipperCompany'],
            $data['shipperCountry'],
            $data['shipperPostalCode'],
            $data['shipperCity'],
            $data['shipperStreet'],
            $data['shipperStreetNumber']
        );

        $builder->setRecipientAddress(
            $data['recipientName'],
            $data['recipientCountry'],
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

        if (!empty($data['postalDeliveryDutyPaid'])) {
            $builder->setDeliveryDutyPaid();
        }

        if (!empty($data['premium'])) {
            $builder->setDeliveryType(ShipmentOrderRequestBuilderInterface::DELIVERY_TYPE_PREMIUM);
        }

        if (!empty($data['closestDropPoint'])) {
            $builder->setDeliveryType(ShipmentOrderRequestBuilderInterface::DELIVERY_TYPE_CDP);
        }

        if (!empty($data['bulkyGoods'])) {
            $builder->setBulkyGoods();
        }

        $builder->setCustomsDetails(
            $data['exportType'],
            $data['placeOfCommital'],
            $data['additionalFee'],
            $data['exportTypeDescription'],
            $data['termsOfTrade'],
            $data['invoiceNumber'],
            $data['permitNumber'],
            $data['attestationNumber'],
            $data['electronicExportNotification']
        );

        $builder->addExportItem(
            $data['exportItem1Qty'],
            $data['exportItem1Desc'],
            $data['exportItem1Value'],
            $data['exportItem1Weight'],
            $data['exportItem1HsCode'],
            $data['exportItem1Origin']
        );

        $builder->addExportItem(
            $data['exportItem2Qty'],
            $data['exportItem2Desc'],
            $data['exportItem2Value'],
            $data['exportItem2Weight'],
            $data['exportItem2HsCode'],
            $data['exportItem2Origin']
        );
    }
}
