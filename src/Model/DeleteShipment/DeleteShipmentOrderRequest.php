<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\DeleteShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\Version;

/**
 * DeleteShipmentOrderRequest
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\DeleteShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class DeleteShipmentOrderRequest
{
    /**
     * The version of the webservice implementation for which the requesting client is developed.
     *
     * @var Version $Version
     */
    protected $Version;

    /**
     * Can contain any DHL shipment number.
     *
     * @var string $shipmentNumber
     */
    protected $shipmentNumber;

    /**
     * @param Version $Version
     * @param string $shipmentNumber
     */
    public function __construct(Version $Version, string $shipmentNumber)
    {
        $this->Version = $Version;
        $this->shipmentNumber = $shipmentNumber;
    }
}
