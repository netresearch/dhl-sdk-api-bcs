<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Provider;

use Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage;

/**
 * Class AuthenticationStorageProvider
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class AuthenticationStorageProvider
{
    /**
     * Provide authentication with invalid app token.
     *
     * @return AuthenticationStorage
     */
    public static function appAuthFailure()
    {
        $authStorage = new AuthenticationStorage(
            'magento_1',
            'eeeeehh…',
            '2222222222_01',
            'pass',
            '2222222222'
        );

        return $authStorage;
    }

    /**
     * Provide authentication with invalid user signature.
     *
     * @return AuthenticationStorage
     */
    public static function userAuthFailure()
    {
        $authStorage = new AuthenticationStorage(
            'magento_1',
            '2de26b775e59279464d1c2f8546432e62413372421c672db36eaacfc2f',
            '2222222222_01',
            'no-pass',
            '2222222222'
        );

        return $authStorage;
    }

    /**
     * Provide authentication with valid credentials.
     *
     * @return AuthenticationStorage
     */
    public static function authSuccess()
    {
        $authStorage = new AuthenticationStorage(
            'magento_1',
            '2de26b775e59279464d1c2f8546432e62413372421c672db36eaacfc2f',
            '2222222222_01',
            'pass',
            '2222222222'
        );

        return $authStorage;
    }
}
