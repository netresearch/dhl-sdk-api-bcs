<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Serializer;

use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;

/**
 * ClassMap
 *
 * @package Dhl\Sdk\Paket\Bcs\Serializer
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ClassMap
{
    /**
     * Map WSDL types to PHP classes.
     *
     * @return string[]
     */
    public static function get()
    {
        return [
            'DeleteShipmentOrderRequest' => DeleteShipmentOrderRequest::class,
            'DeleteShipmentOrderResponse' => DeleteShipmentOrderResponse::class,
            'DeletionState' => DeletionState::class,
            'Statusinformation' => StatusInformation::class,
            'Version' => Version::class,
        ];
    }
}
