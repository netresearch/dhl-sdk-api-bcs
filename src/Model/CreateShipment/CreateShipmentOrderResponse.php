<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;

/**
 * CreateShipmentOrderResponse
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class CreateShipmentOrderResponse
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
     * The operation's success status for every single ShipmentOrder will be returned by one CreationState element.
     * It is identifiable via SequenceNumber.
     *
     * @var CreationState|null $CreationState
     */
    protected $CreationState = null;

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
     * @return CreationState|null
     */
    public function getCreationState()
    {
        return $this->CreationState;
    }
}
