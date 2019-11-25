<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ExportDocPosition
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ExportDocPosition
{
    /**
     * Description of the unit / position.
     *
     * @var string $description
     */
    protected $description;

    /**
     * Country's ISO-Code (ISO-2- Alpha) of the unit / position.
     *
     * @var string $countryCodeOrigin
     */
    protected $countryCodeOrigin;

    /**
     * Customs tariff number of the unit / position.
     *
     * @var string $customsTariffNumber
     */
    protected $customsTariffNumber;

    /**
     * Quantity of the unit / position.
     *
     * @var int $amount
     */
    protected $amount;

    /**
     * Net weight of the unit / position.
     *
     * @var float $netWeightInKG
     */
    protected $netWeightInKG;

    /**
     * Customs value amount of the unit / position.
     *
     * @var float $customsValue
     */
    protected $customsValue;

    /**
     * @param string $description
     * @param string $countryCodeOrigin
     * @param string $customsTariffNumber
     * @param int $amount
     * @param float $netWeightInKG
     * @param float $customsValue
     */
    public function __construct(
        string $description,
        string $countryCodeOrigin,
        string $customsTariffNumber,
        int $amount,
        float $netWeightInKG,
        float $customsValue
    ) {
        $this->description = $description;
        $this->countryCodeOrigin = $countryCodeOrigin;
        $this->customsTariffNumber = $customsTariffNumber;
        $this->amount = $amount;
        $this->netWeightInKG = $netWeightInKG;
        $this->customsValue = $customsValue;
    }
}
