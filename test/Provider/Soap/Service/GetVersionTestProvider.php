<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Service;

use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\Credentials\AuthenticationStorageProvider;

class GetVersionTestProvider
{
    public static function getVersionSuccess(): array
    {
        $wsdl = __DIR__ . '/../../_files/bcs-3.1.2/geschaeftskundenversand-api-3.1.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $getVersionResponseXml = \file_get_contents(__DIR__ . '/../../_files/getversion/getVersionSuccess.xml');

        return [
            'get version success' => [$wsdl, $authStorage, $getVersionResponseXml],
        ];
    }
}
