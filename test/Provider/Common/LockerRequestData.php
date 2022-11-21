<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Common;

class LockerRequestData extends AbstractRequestData
{
    public function get(): array
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow

        return [
            'sequenceNumber' => $this->getSequenceNumber(),
            'billingNumber' => '22222222220101',
            'productCode' => 'V53PAK',
            'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
            'shipperReference' => 'Shipper Reference #123',
            'packstationNumber' => '139',
            'packstationPostalCode' => '53113',
            'packstationCity' => 'Bonn',
            'packstationRecipientName' => 'Jane Doe',
            'packstationPostNumber' => '12345678',
            'packstationState' => 'NRW',
            'packstationCountryCode' => 'DE',
            'packstationCountry' => 'Deutschland',
            'packageWeight' => 4.5,
        ];
    }
}
