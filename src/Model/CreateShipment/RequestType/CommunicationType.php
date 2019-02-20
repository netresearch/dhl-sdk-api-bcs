<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * CommunicationType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class CommunicationType
{
    /**
     * @var string|null $phone
     */
    protected $phone = null;

    /**
     * @var string|null $email
     */
    protected $email = null;

    /**
     * @var string|null $contactPerson
     */
    protected $contactPerson = null;

    /**
     * @param string $phone
     * @return CommunicationType
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string $email
     * @return CommunicationType
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $contactPerson
     * @return CommunicationType
     */
    public function setContactPerson(string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;
        return $this;
    }
}
