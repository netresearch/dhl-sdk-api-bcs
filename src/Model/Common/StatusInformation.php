<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Common;

/**
 * Success status after processing the overall request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
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
     * Note: in PHP 7.4 this will become "protected int $statusCode"
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
     * @var string[]|string|null $statusMessage
     */
    protected $statusMessage = null;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return intval($this->statusCode);
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
        if (empty($this->statusMessage)) {
            return [];
        }

        if (!\is_array($this->statusMessage)) {
            return [$this->statusMessage];
        }

        return $this->statusMessage;
    }
}
