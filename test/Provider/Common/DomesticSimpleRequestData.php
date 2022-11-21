<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Common;

class DomesticSimpleRequestData extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '22222222220101',
            'shipperCountry' => 'DE',
            'shipperPostalCode' => '04229',
            'shipperCity' => 'Leipzig',
            'shipperStreet' => 'Nonnenstraße',
            'shipperStreetNumber' => '11d',
            'shipperCompany' => 'Netresearch GmbH & Co.KG',
            'recipientCountry' => 'DE',
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
}
