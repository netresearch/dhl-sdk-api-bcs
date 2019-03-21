<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\ResponseType\CreationState;

/**
 * CreateShipmentOrderResponse
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CreateShipmentOrderResponse extends AbstractResponse
{
    /**
     * The operation's success status for every single ShipmentOrder will be returned by one CreationState element.
     * It is identifiable via SequenceNumber.
     *
     * @var CreationState|null $CreationState
     */
    protected $CreationState = null;

    /**
     * @return CreationState|null
     */
    public function getCreationState()
    {
        return $this->CreationState;
    }
}
