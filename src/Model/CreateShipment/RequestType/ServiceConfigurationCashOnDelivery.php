<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ServiceConfigurationCashOnDelivery
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ServiceConfigurationCashOnDelivery
{
    /**
     * Indicates, if the option is on/off.
     *
     * @var int $active "0" or "1"
     */
    protected $active;

    /**
     * Money amount to be collected. Mandatory if COD is chosen.
     *
     * @var float $codAmount
     */
    protected $codAmount;

    /**
     * Configuration whether the transmission fee to be added to the COD amount or not by DHL.
     *
     * @var int|null $addFee "0" or "1"
     */
    protected $addFee;

    /**
     * @param bool $active
     * @param float $codAmount
     */
    public function __construct(bool $active, float $codAmount)
    {
        $this->active = intval($active);
        $this->codAmount = $codAmount;
    }

    /**
     * @param bool|null $addFee
     */
    public function setAddFee(bool $addFee = null)
    {
        $this->addFee = intval($addFee);
    }
}
