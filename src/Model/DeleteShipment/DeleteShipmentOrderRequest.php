<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\DeleteShipment;

use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractRequest;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;

/**
 * DeleteShipmentOrderRequest
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\DeleteShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
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
