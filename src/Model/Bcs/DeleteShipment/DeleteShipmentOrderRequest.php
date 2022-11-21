<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment;

use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\AbstractRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\Version;

class DeleteShipmentOrderRequest extends AbstractRequest
{
    /**
     * Can contain any DHL shipment number.
     *
     * @var string[] $shipmentNumber
     */
    protected $shipmentNumber;

    /**
     * @param Version $Version
     * @param string[] $shipmentNumbers
     */
    public function __construct(Version $Version, array $shipmentNumbers)
    {
        $this->shipmentNumber = $shipmentNumbers;

        parent::__construct($Version);
    }
}
