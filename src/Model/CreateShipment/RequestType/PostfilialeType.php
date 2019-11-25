<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * PostfilialeType
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class PostfilialeType
{
    /**
     * Number of the Postfiliale.
     *
     * @var string $PostfilialNumber
     */
    protected $PostfilialNumber = null;

    /**
     * Postnummer of the receiver.
     *
     * @var string $PostNumber
     */
    protected $PostNumber = null;

    /**
     * Zip code.
     *
     * @var string $Zip
     */
    protected $Zip = null;

    /**
     * City name.
     *
     * @var string $City
     */
    protected $City = null;

    /**
     * @param string $postfilialNumber
     * @param string $postNumber
     * @param string $zip
     * @param string $city
     */
    public function __construct($postfilialNumber, $postNumber, $zip, $city)
    {
        $this->PostfilialNumber = $postfilialNumber;
        $this->PostNumber = $postNumber;
        $this->Zip = $zip;
        $this->City = $city;
    }
}
