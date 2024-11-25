<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service\ShipmentService;

use Dhl\Sdk\Paket\Bcs\Api\Data\OrderConfigurationInterface;

class OrderConfiguration implements OrderConfigurationInterface
{
    /**
     * @var bool|null
     */
    private $mustEncode;

    /**
     * @var bool|null
     */
    private $combinedPrinting;

    /**
     * @var string|null
     */
    private $docFormat;

    /**
     * @var string|null
     */
    private $printFormat;

    /**
     * @var string|null
     */
    private $printFormatReturn;

    /**
     * @var string|null
     */
    private $profile;

    /**
     * @var string|null
     */
    private $includeDocs;

    public function __construct(
        bool $mustEncode = null,
        bool $combinedPrinting = null,
        string $docFormat = null,
        string $printFormat = null,
        string $printFormatReturn = null,
        string $profile = null,
        string $includeDocs = null
    ) {
        $this->mustEncode = $mustEncode;
        $this->combinedPrinting = $combinedPrinting;
        $this->docFormat = $docFormat;
        $this->printFormat = $printFormat;
        $this->printFormatReturn = $printFormatReturn;
        $this->profile = $profile;
        $this->includeDocs = $includeDocs;
    }

    public function getIncludeDocs(): ?string
    {
        return $this->includeDocs;
    }

    public function mustEncode(): ?bool
    {
        return $this->mustEncode;
    }

    public function isCombinedPrinting(): ?bool
    {
        return $this->combinedPrinting;
    }

    public function getDocFormat(): ?string
    {
        return $this->docFormat;
    }

    public function getPrintFormat(): ?string
    {
        return $this->printFormat;
    }

    public function getPrintFormatReturn(): ?string
    {
        return $this->printFormatReturn;
    }

    public function getProfile(): string
    {
        return $this->profile ?: OrderConfigurationInterface::DEFAULT_PROFILE;
    }
}
