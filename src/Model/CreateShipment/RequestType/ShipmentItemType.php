<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ShipmentItemType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ShipmentItemType
{
    /**
     * The weight of the piece in kg.
     *
     * @var float $weightInKG
     */
    protected $weightInKG;

    /**
     * The length of the piece in cm.
     *
     * @var int $lengthInCM
     */
    protected $lengthInCM = null;

    /**
     * The width of the piece in cm.
     *
     * @var int $widthInCM
     */
    protected $widthInCM = null;

    /**
     * The height of the piece in cm.
     *
     * @var int $heightInCM
     */
    protected $heightInCM = null;

    /**
     * @param float $weightInKG
     */
    public function __construct(float $weightInKG)
    {
        $this->weightInKG = $weightInKG;
    }

    /**
     * @param int $lengthInCM
     * @return ShipmentItemType
     */
    public function setLengthInCM(int $lengthInCM): self
    {
        $this->lengthInCM = $lengthInCM;
        return $this;
    }

    /**
     * @param int $widthInCM
     * @return ShipmentItemType
     */
    public function setWidthInCM(int $widthInCM): self
    {
        $this->widthInCM = $widthInCM;
        return $this;
    }

    /**
     * @param int $heightInCM
     * @return ShipmentItemType
     */
    public function setHeightInCM(int $heightInCM): self
    {
        $this->heightInCM = $heightInCM;
        return $this;
    }
}
