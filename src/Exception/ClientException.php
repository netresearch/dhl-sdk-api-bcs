<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Exception;

/**
 * Class ClientException
 *
 * @api
 * @package Dhl\Sdk\Paket\Bcs\Exception
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ClientException extends ServiceException
{
    /**
     * Create client exception.
     *
     * @param \Exception $exception
     * @return static
     */
    public static function create(\Exception $exception)
    {
        return new static($exception->getMessage(), $exception->getCode(), $exception);
    }
}
