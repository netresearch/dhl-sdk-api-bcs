<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ShipmentItemType
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
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
     * @var int|null $lengthInCM
     */
    protected $lengthInCM = null;

    /**
     * The width of the piece in cm.
     *
     * @var int|null $widthInCM
     */
    protected $widthInCM = null;

    /**
     * The height of the piece in cm.
     *
     * @var int|null $heightInCM
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
     * @param int|null $lengthInCM
     * @return ShipmentItemType
     */
    public function setLengthInCM(int $lengthInCM = null): self
    {
        $this->lengthInCM = $lengthInCM;
        return $this;
    }

    /**
     * @param int|null $widthInCM
     * @return ShipmentItemType
     */
    public function setWidthInCM(int $widthInCM = null): self
    {
        $this->widthInCM = $widthInCM;
        return $this;
    }

    /**
     * @param int|null $heightInCM
     * @return ShipmentItemType
     */
    public function setHeightInCM(int $heightInCM = null): self
    {
        $this->heightInCM = $heightInCM;
        return $this;
    }
}
