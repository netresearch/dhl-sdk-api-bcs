<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Common;

/**
 * The version of the webservice implementation for which the requesting client is developed.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class Version
{
    /**
     * The number of the major release. E.g. the '2' in version "2.1.".
     *
     * @var string $majorRelease
     */
    protected $majorRelease;

    /**
     * The number of the minor release. E.g. the '1' in version "2.1."
     *
     * @var string $minorRelease
     */
    protected $minorRelease;

    /**
     * Optional build id to be addressed.
     *
     * @var string|null $build
     */
    protected $build = null;

    /**
     * @param string $majorRelease
     * @param string $minorRelease
     */
    public function __construct(string $majorRelease, string $minorRelease)
    {
        $this->majorRelease = $majorRelease;
        $this->minorRelease = $minorRelease;
    }

    /**
     * @return string
     */
    public function getMajorRelease(): string
    {
        return $this->majorRelease;
    }

    /**
     * @return string
     */
    public function getMinorRelease(): string
    {
        return $this->minorRelease;
    }

    /**
     * @return string|null
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @param string $build
     * @return Version
     */
    public function setBuild(string $build): self
    {
        $this->build = $build;
        return $this;
    }
}
