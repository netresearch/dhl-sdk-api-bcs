<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Auth;

use Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage;
use PHPUnit\Framework\TestCase;

class AuthenticationStorageTest extends TestCase
{
    /**
     * @test
     */
    public function propertiesAreAvailableThroughGetters()
    {
        $applicationId = 'appId';
        $applicationToken = 'appToken';
        $user = 'user';
        $signature = 'signature';

        $authStorage = new AuthenticationStorage(
            $applicationId,
            $applicationToken,
            $user,
            $signature
        );

        self::assertSame($applicationId, $authStorage->getApplicationId());
        self::assertSame($applicationToken, $authStorage->getApplicationToken());
        self::assertSame($user, $authStorage->getUser());
        self::assertSame($signature, $authStorage->getSignature());
    }
}
