<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * PostfilialeType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class PostfilialeType
{
    /**
     * @var string $PostfilialNumber
     */
    protected $PostfilialNumber;

    /**
     * @var string $PostNumber
     */
    protected $PostNumber;

    /**
     * @var string $Zip
     */
    protected $Zip;

    /**
     * @var string $City
     */
    protected $City;

    protected $Origin;

    /**
     * @param string $PostfilialNumber
     * @param string $PostNumber
     * @param Zip $Zip
     * @param City $City
     */
    public function __construct($PostfilialNumber, $PostNumber, $Zip, $City)
    {
        $this->PostfilialNumber = $PostfilialNumber;
        $this->PostNumber = $PostNumber;
        $this->Zip = $Zip;
        $this->City = $City;
    }

    /**
     * @return string
     */
    public function getPostfilialNumber()
    {
        return $this->PostfilialNumber;
    }

    /**
     * @param string $PostfilialNumber
     * @return \Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\PostfilialeType
     */
    public function setPostfilialNumber($PostfilialNumber)
    {
        $this->PostfilialNumber = $PostfilialNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostNumber()
    {
        return $this->PostNumber;
    }

    /**
     * @param string $PostNumber
     * @return \Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\PostfilialeType
     */
    public function setPostNumber($PostNumber)
    {
        $this->PostNumber = $PostNumber;
        return $this;
    }

    /**
     * @return Zip
     */
    public function getZip()
    {
        return $this->Zip;
    }

    /**
     * @param Zip $Zip
     * @return \Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\PostfilialeType
     */
    public function setZip($Zip)
    {
        $this->Zip = $Zip;
        return $this;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * @param City $City
     * @return \Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\PostfilialeType
     */
    public function setCity($City)
    {
        $this->City = $City;
        return $this;
    }

}
