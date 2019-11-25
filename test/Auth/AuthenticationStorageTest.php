<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Auth;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\CommunicationExpectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\AuthenticationTestProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\Test\TestLogger;

/**
 * Class AuthenticationStorageTest
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class AuthenticationStorageTest extends \PHPUnit\Framework\TestCase
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
