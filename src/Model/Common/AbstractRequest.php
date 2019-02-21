<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Common;

/**
 * AbstractRequest
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\Common
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
abstract class AbstractRequest
{
    /**
     * The version of the webservice implementation for which the requesting client is developed.
     *
     * @var Version $Version
     */
    protected $Version;

    /**
     * AbstractRequest constructor.
     * @param Version $Version
     */
    public function __construct(Version $Version)
    {
        $this->Version = $Version;
    }
}
