<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Common;

class PostOfficeRequestData extends AbstractRequestData
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
            'postfilialRecipientName' => 'Jane Doe',
            'postfilialNumber' => '502',
            'postfilialPostNumber' => '12345678',
            'postfilialPostalCode' => '53113',
            'postfilialCity' => 'Bonn',
            'postfilialCountry' => 'Deutschland',
            'postfilialCountryCode' => 'DE',
            'postfilialState' => 'NRW',
            'packageWeight' => 1.2,
        ];
    }
}
