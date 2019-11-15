<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Exception;

/**
 * Class ServiceException
 *
 * Generic SDK exception, can be used to catch any SDK exception
 * in cases where the exact type does not matter. Exception messages
 * are suitable for logging.
 *
 * @api
 * @author Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class ServiceException extends \Exception
{
}
