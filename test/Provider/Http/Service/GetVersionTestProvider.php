<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Service;

use Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Credentials\AuthenticationStorageProvider;

class GetVersionTestProvider
{
    public static function getVersionSuccess(): array
    {
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $getVersionResponseJson = \file_get_contents(__DIR__ . '/../../_files/getversion/getVersionSuccess.json');

        return [
            'get version success' => [$authStorage, $getVersionResponseJson],
        ];
    }
}
