<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType;

class CommunicationType
{
    /**
     * Phone number.
     *
     * @var string|null $phone
     */
    protected $phone = null;

    /**
     * Email address.
     *
     * @var string|null $email
     */
    protected $email = null;

    /**
     * First name and last name of contact person.
     *
     * @var string|null $contactPerson
     */
    protected $contactPerson = null;

    /**
     * @param string|null $phone
     * @return CommunicationType
     */
    public function setPhone(string $phone = null): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string|null $email
     * @return CommunicationType
     */
    public function setEmail(string $email = null): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string|null $contactPerson
     * @return CommunicationType
     */
    public function setContactPerson(string $contactPerson = null): self
    {
        $this->contactPerson = $contactPerson;
        return $this;
    }
}
