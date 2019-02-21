<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Common;

/**
 * Success status after processing the overall request.
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\Common
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class StatusInformation
{
    /**
     * Overall status of the entire request: A value of zero means, the request was processed without error.
     * A value greater than zero indicates that an error occurred. The detailed mapping and explanation
     * of returned status codes is contained in the list.
     *
     * @var int $statusCode
     */
    protected $statusCode;

    /**
     * Explanation of the statuscode and potential errors.
     *
     * @var string $statusText
     */
    protected $statusText;

    /**
     * Explanation of the statuscode and potential errors.
     *
     * @var string[] $statusMessage
     */
    protected $statusMessage = [];

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getStatusText(): string
    {
        return $this->statusText;
    }

    /**
     * @return string[]
     */
    public function getStatusMessage(): array
    {
        return $this->statusMessage;
    }
}
