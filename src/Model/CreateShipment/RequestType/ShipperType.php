<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ShipperType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ShipperType extends ShipperTypeType
{
    /**
     * @param NameType $name
     * @param NativeAddressType $address
     */
    public function __construct(NameType $name, NativeAddressType $address)
    {
        parent::__construct($name, $address);
    }
}
