<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider\Http\Credentials;

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
            '',
            'eeeeehh…',
            '3333333333_01',
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
            '',
            '7eelE1paJtbWvAKw0ROgVNLZak6rvEoD',
            '3333333333_01',
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
            '',
            '7eelE1paJtbWvAKw0ROgVNLZak6rvEoD',
            '3333333333_01',
            'pass'
        );

        return $authStorage;
    }
}
