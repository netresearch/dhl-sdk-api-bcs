<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\DeleteShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;

/**
 * DeleteShipmentOrderResponse
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\DeleteShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
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
     * @return DeletionState
     */
    public function getDeletionState(): DeletionState
    {
        return $this->DeletionState;
    }
}
