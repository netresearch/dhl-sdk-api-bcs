<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\DeleteShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;

/**
 * DeleteShipmentOrderResponse
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\DeleteShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class DeleteShipmentOrderResponse extends AbstractResponse
{
    /**
     * For every ShipmentNumber requested, one DeletionState node is returned
     * that contains the status of the respective deletion operation.
     *
     * @var DeletionState $DeletionState
     */
    protected $DeletionState;

    /**
     * @return DeletionState|null
     */
    public function getDeletionState()
    {
        return $this->DeletionState;
    }
}
