<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\DeleteShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\StatusInformation;

/**
 * DeleteShipmentOrderResponse
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\DeleteShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class DeleteShipmentOrderResponse
{
    /**
     * The version of the webservice implementation for which the requesting client is developed.
     *
     * @var Version $Version
     */
    protected $Version;

    /**
     * Success status after processing the overall request.
     *
     * @var StatusInformation $Status
     */
    protected $Status;

    /**
     * For every ShipmentNumber requested, one DeletionState node is returned
     * that contains the status of the respective deletion operation.
     *
     * @var DeletionState $DeletionState
     */
    protected $DeletionState;

    /**
     * @return Version
     */
    public function getVersion(): Version
    {
        return $this->Version;
    }

    /**
     * @return StatusInformation
     */
    public function getStatus(): StatusInformation
    {
        return $this->Status;
    }

    /**
     * @return DeletionState
     */
    public function getDeletionState(): DeletionState
    {
        return $this->DeletionState;
    }
}
