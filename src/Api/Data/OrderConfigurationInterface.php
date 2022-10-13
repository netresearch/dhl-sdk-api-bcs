<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Api\Data;

/**
 * Provide meta information for the shipment order.
 *
 * @api
 */
interface OrderConfigurationInterface
{
    public const DOC_FORMAT_ZPL2 = 'ZPL2';
    public const DOC_FORMAT_PDF = 'PDF';

    public const PRINT_FORMAT_A4 = 'A4';
    public const PRINT_FORMAT_910_300_600 = '910-300-600';
    public const PRINT_FORMAT_910_300_610 = '910-300-610';
    public const PRINT_FORMAT_910_300_700 = '910-300-700';
    public const PRINT_FORMAT_910_300_700_OZ = '910-300-700-oz';
    public const PRINT_FORMAT_910_300_710 = '910-300-710';
    public const PRINT_FORMAT_910_300_300 = '910-300-300';
    public const PRINT_FORMAT_910_300_300_OZ = '910-300-300-oz';
    public const PRINT_FORMAT_910_300_400 = '910-300-400';
    public const PRINT_FORMAT_910_300_410 = '910-300-410';
    public const PRINT_FORMAT_100X70 = '100x70mm';

    /**
     * Decide whether to print label and return label to one or multiple files.
     *
     * If enabled, label and return label for one shipment will be printed as
     * single PDF document with possibly multiple pages. Else, those two
     * labels come as separate documents. The option does not affect customs
     * documents and COD labels.
     *
     * @return bool|null
     */
    public function isCombinedPrinting(): ?bool;

    /**
     * Define the printable document format to be used for label and manifest documents.
     *
     * @return string|null
     */
    public function getDocFormat(): ?string;

    /**
     * Defines the print medium for the shipping label.
     *
     * The different option vary from standard paper sizes DIN A4 and DIN A5
     * to specific label print formats.
     *
     * @return string|null
     */
    public function getPrintFormat(): ?string;

    /**
     * Define the print medium for the return shipping label.
     *
     * This parameter is only usable, if you do not use combined printing.
     * The different option vary from standard paper sizes DIN A4 and DIN A5
     * to specific label print formats.
     *
     * @return string|null
     */
    public function getPrintFormatReturn(): ?string;

    /**
     * Limit the available billing numbers to given profile.
     *
     * @return string|null
     */
    public function getProfile(): ?string;
}
