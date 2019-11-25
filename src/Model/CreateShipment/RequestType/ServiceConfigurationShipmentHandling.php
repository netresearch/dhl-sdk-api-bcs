<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationShipmentHandling
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationShipmentHandling
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    /**
     * Type of shipment handling. There are the following types are allowed:
     * - a: Remove content, return box
     * - b: Remove content, pick up and dispose cardboard packaging
     * - c: Handover parcel/box to customer – no disposal of cardboard/box
     * - d: Remove bag from of cooling unit and handover to customer
     * - e: Remove content, apply return label und seal box, return box
     *
     * @var string $type
     */
    protected $type;

    /**
     * @param bool $active
     * @param string $type
     */
    public function __construct(bool $active, string $type)
    {
        $this->active = intval($active);
        $this->type = $type;
    }
}
