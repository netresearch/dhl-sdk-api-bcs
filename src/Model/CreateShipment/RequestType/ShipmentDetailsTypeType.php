<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

/**
 * ShipmentDetailsTypeType
 *
 * @package Dhl\Sdk\Paket\Bcs\Model\CreateShipment
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ShipmentDetailsTypeType extends ShipmentDetailsType
{
    /**
     * For every parcel specified, contains weight in kg, length in cm, width in cm and height in cm.
     *
     * @var ShipmentItemType $ShipmentItem
     */
    protected $ShipmentItem;

    /**
     * Use one dedicated Service node for each service to be booked with the shipment product.
     *
     * @var ShipmentService $Service
     */
    protected $Service = null;

    /**
     * Mechanism to send notifications by email after successful manifesting of shipment.
     *
     * @var ShipmentNotificationType $Notification
     */
    protected $Notification = null;

    /**
     * If COD is booked as service, bank data must be provided by DHL customer (mandatory server logic).
     *
     * @var BankType $BankData
     */
    protected $BankData = null;

    /**
     * @param string $product
     * @param string $accountNumber
     * @param string $shipmentDate
     * @param ShipmentItemType $ShipmentItem
     */
    public function __construct(
        string $product,
        string $accountNumber,
        string $shipmentDate,
        ShipmentItemType $ShipmentItem
    ) {
        $this->ShipmentItem = $ShipmentItem;

        parent::__construct($product, $accountNumber, $shipmentDate);
    }

    /**
     * @param ShipmentService $service
     * @return ShipmentDetailsTypeType
     */
    public function setService(ShipmentService $service): self
    {
        $this->Service = $service;
        return $this;
    }

    /**
     * @param ShipmentNotificationType $notification
     * @return ShipmentDetailsTypeType
     */
    public function setNotification(ShipmentNotificationType $notification): self
    {
        $this->Notification = $notification;
        return $this;
    }

    /**
     * @param BankType $BankData
     * @return ShipmentDetailsTypeType
     */
    public function setBankData(BankType $BankData): self
    {
        $this->BankData = $BankData;
        return $this;
    }

}
