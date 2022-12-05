<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\ParcelDe\ResponseType;

class Label
{
    /**
     * @var string|null
     */
    private $b64;

    /**
     * @var string|null
     */
    private $zpl2;

    /**
     * @var string|null
     */
    private $url;

    /**
     * @var string|null
     */
    private $fileFormat;

    /**
     * @return string|null
     */
    public function getB64(): ?string
    {
        return $this->b64;
    }

    /**
     * @return string|null
     */
    public function getZpl2(): ?string
    {
        return $this->zpl2;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return string|null
     */
    public function getFileFormat(): ?string
    {
        return $this->fileFormat;
    }
}
