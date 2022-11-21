<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType;

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
     * @var ShipmentService|null $Service
     */
    protected $Service = null;

    /**
     * Mechanism to send notifications by email after successful manifesting of shipment.
     *
     * @var ShipmentNotificationType|null $Notification
     */
    protected $Notification = null;

    /**
     * If COD is booked as service, bank data must be provided by DHL customer (mandatory server logic).
     *
     * @var BankType|null $BankData
     */
    protected $BankData = null;

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
     * @param ShipmentService|null $service
     * @return ShipmentDetailsTypeType
     */
    public function setService(ShipmentService $service = null): self
    {
        $this->Service = $service;
        return $this;
    }

    /**
     * @param ShipmentNotificationType|null $notification
     * @return ShipmentDetailsTypeType
     */
    public function setNotification(ShipmentNotificationType $notification = null): self
    {
        $this->Notification = $notification;
        return $this;
    }

    /**
     * @param BankType|null $BankData
     * @return ShipmentDetailsTypeType
     */
    public function setBankData(BankType $BankData = null): self
    {
        $this->BankData = $BankData;
        return $this;
    }
}
