<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\RequestType;

class ShipmentNotificationType
{
    /**
     * Email address of the recipient. Mandatory if Notification is set.
     *
     * @var string $recipientEmailAddress
     */
    protected $recipientEmailAddress;

    public function __construct(string $recipientEmailAddress)
    {
        $this->recipientEmailAddress = $recipientEmailAddress;
    }
}
