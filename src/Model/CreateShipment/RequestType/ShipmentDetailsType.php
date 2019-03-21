<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ShipmentDetailsType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentDetailsType
{
    /**
     * Determines the DHL Paket product to be ordered.
     *
     * @var string $product
     */
    protected $product;

    /**
     * DHL account number (14 digits).
     *
     * @var string $accountNumber
     */
    protected $accountNumber;

    /**
     * Date of shipment should be close to current date and must not be in the past. Iso format required: yyyy-mm-dd.
     *
     * @var string $shipmentDate
     */
    protected $shipmentDate;

    /**
     * A reference number that the client can assign for better association purposes. Appears on shipment label.
     *
     * @var string|null $customerReference
     */
    protected $customerReference = null;

    /**
     * Name of a cost center.
     *
     * @var string|null $costCentre
     */
    protected $costCentre = null;

    /**
     * DHL account number (14 digits).
     *
     * @var string|null $returnShipmentAccountNumber
     */
    protected $returnShipmentAccountNumber = null;

    /**
     * A reference number that the client can assign for better association purposes. Appears on return shipment label.
     *
     * @var string|null $returnShipmentReference
     */
    protected $returnShipmentReference = null;

    /**
     * @param string $product
     * @param string $accountNumber
     * @param string $shipmentDate
     */
    public function __construct(string $product, string $accountNumber, string $shipmentDate)
    {
        $this->product = $product;
        $this->accountNumber = $accountNumber;
        $this->shipmentDate = $shipmentDate;
    }

    /**
     * @param string|null $customerReference
     * @return ShipmentDetailsType
     */
    public function setCustomerReference(string $customerReference = null): self
    {
        $this->customerReference = $customerReference;
        return $this;
    }

    /**
     * @param string|null $costCentre
     * @return ShipmentDetailsType
     */
    public function setCostCentre(string $costCentre = null): self
    {
        $this->costCentre = $costCentre;
        return $this;
    }

    /**
     * @param string|null $returnShipmentAccountNumber
     * @return ShipmentDetailsType
     */
    public function setReturnShipmentAccountNumber(string $returnShipmentAccountNumber = null): self
    {
        $this->returnShipmentAccountNumber = $returnShipmentAccountNumber;
        return $this;
    }

    /**
     * @param string|null $returnShipmentReference
     * @return ShipmentDetailsType
     */
    public function setReturnShipmentReference(string $returnShipmentReference = null): self
    {
        $this->returnShipmentReference = $returnShipmentReference;
        return $this;
    }
}
