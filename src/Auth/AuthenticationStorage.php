<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Auth;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;

/**
 * AuthenticationStorage
 *
 * @package Dhl\Sdk\Paket\Bcs\Auth
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class AuthenticationStorage implements AuthenticationStorageInterface
{
    /**
     * @var string
     */
    private $applicationId;

    /**
     * @var string
     */
    private $applicationToken;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $signature;

    /**
     * AuthenticationStorage constructor.
     *
     * @param string $applicationId
     * @param string $applicationToken
     * @param string $user
     * @param string $signature
     */
    public function __construct(
        string $applicationId,
        string $applicationToken,
        string $user,
        string $signature
    ) {
        $this->applicationId = $applicationId;
        $this->applicationToken = $applicationToken;
        $this->user = $user;
        $this->signature = $signature;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * @return string
     */
    public function getApplicationToken(): string
    {
        return $this->applicationToken;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }
}
