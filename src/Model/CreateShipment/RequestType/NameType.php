<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * NameType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class NameType
{
    /**
     * @var string $name1
     */
    protected $name1;

    /**
     * @var string|null $name2
     */
    protected $name2 = null;

    /**
     * @var string|null $name3
     */
    protected $name3 = null;

    /**
     * @param string $name1
     */
    public function __construct(string $name1)
    {
        $this->name1 = $name1;
    }

    /**
     * @param string $name2
     * @return NameType
     */
    public function setName2(string $name2): self
    {
        $this->name2 = $name2;
        return $this;
    }

    /**
     * @param string $name3
     * @return NameType
     */
    public function setName3(string $name3): self
    {
        $this->name3 = $name3;
        return $this;
    }
}
