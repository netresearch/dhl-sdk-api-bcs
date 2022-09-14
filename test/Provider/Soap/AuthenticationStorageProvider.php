<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Soap;

use Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage;

class AuthenticationStorageProvider
{
    /**
     * Provide authentication with invalid app token.
     *
     * @return AuthenticationStorage
     */
    public static function appAuthFailure(): AuthenticationStorage
    {
        $authStorage = new AuthenticationStorage(
            'magento_1',
            'eeeeehh…',
            '2222222222_01',
            'pass'
        );

        return $authStorage;
    }

    /**
     * Provide authentication with invalid user signature.
     *
     * @return AuthenticationStorage
     */
    public static function userAuthFailure(): AuthenticationStorage
    {
        $authStorage = new AuthenticationStorage(
            'magento_1',
            '2de26b775e59279464d1c2f8546432e62413372421c672db36eaacfc2f',
            '2222222222_01',
            'no-pass'
        );

        return $authStorage;
    }

    /**
     * Provide authentication with valid credentials.
     *
     * @return AuthenticationStorage
     */
    public static function authSuccess(): AuthenticationStorage
    {
        $authStorage = new AuthenticationStorage(
            'magento_1',
            '2de26b775e59279464d1c2f8546432e62413372421c672db36eaacfc2f',
            '2222222222_01',
            'pass'
        );

        return $authStorage;
    }
}
