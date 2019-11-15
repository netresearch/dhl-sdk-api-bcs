<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Exception;

/**
 * Class DetailedServiceException
 *
 * A special instance of the ServiceException which is able to
 * provide a meaningful error message, suitable for UI display.
 *
 * @api
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class DetailedServiceException extends ServiceException
{
}
