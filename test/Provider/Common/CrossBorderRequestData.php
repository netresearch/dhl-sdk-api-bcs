<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Common;

class CrossBorderRequestData extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '22222222220101',
            'productCode' => 'V53PAK',
            'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
            'shipperCompany' => 'Netresearch GmbH & Co.KG',
            'shipperCountry' => 'DE',
            'shipperPostalCode' => '04229',
            'shipperCity' => 'Leipzig',
            'shipperStreet' => 'Nonnenstraße',
            'shipperStreetNumber' => '11d',
            'recipientCountry' => 'US',
            'recipientPostalCode' => '89109',
            'recipientCity' => 'Las Vegas',
            'recipientStreet' => 'S Las Vegas Blvd',
            'recipientStreetNumber' => '3131',
            'recipientName' => 'Vince Viva',
            'packageWeight' => 2.4,

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
            'exportItem1Origin' => 'CN',
            'exportItem2Qty' => 1,
            'exportItem2Desc' => 'Export Desc 2',
            'exportItem2Weight' => 2.22,
            'exportItem2Value' => 35,
            'exportItem2HsCode' => '62099010',
            'exportItem2Origin' => 'US',
        ];
    }
}
