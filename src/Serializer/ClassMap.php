<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Serializer;

use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\BankType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\CommunicationType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\CountryType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ExportDocPosition;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ExportDocumentType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\Ident;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\NameType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\NativeAddressType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\PackStationType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\PostfilialeType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ReceiverNativeAddressType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ReceiverType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ReceiverTypeType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfiguration;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationAdditionalInsurance;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationCashOnDelivery;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationDateOfDelivery;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationDeliveryTimeFrame;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationDetails;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationDetailsOptional;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationEndorsement;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationIC;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationISR;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationShipmentHandling;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ServiceConfigurationVisualAgeCheck;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\Shipment;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentDetailsType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentDetailsTypeType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentItemType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentNotificationType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentService;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipperType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipperTypeType;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\ResponseType\CreationState;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\ResponseType\LabelData;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;

/**
 * ClassMap
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ClassMap
{
    /**
     * Map WSDL types to PHP classes.
     *
     * @return string[]
     */
    public static function get()
    {
        return [
            // shared types
            'Statusinformation' => StatusInformation::class,
            'Version' => Version::class,

            // DELETE SHIPMENT - request types
            'DeleteShipmentOrderRequest' => DeleteShipmentOrderRequest::class,
            // DELETE SHIPMENT - response types
            'DeleteShipmentOrderResponse' => DeleteShipmentOrderResponse::class,
            'DeletionState' => DeletionState::class,

            // CREATE SHIPMENT - request types
            'CreateShipmentOrderRequest' => CreateShipmentOrderRequest::class,
            'ShipmentOrderType' => ShipmentOrderType::class,
            'Shipment' => Shipment::class,
            'ShipmentDetailsTypeType' => ShipmentDetailsTypeType::class,
            'ShipmentDetailsType' => ShipmentDetailsType::class,
            'ShipmentItemType' => ShipmentItemType::class,
            'ShipmentService' => ShipmentService::class,
            'ServiceconfigurationDateOfDelivery' => ServiceConfigurationDateOfDelivery::class,
            'ServiceconfigurationDeliveryTimeframe' => ServiceConfigurationDeliveryTimeFrame::class,
            'ServiceconfigurationISR' => ServiceConfigurationISR::class,
            'Serviceconfiguration' => ServiceConfiguration::class,
            'ServiceconfigurationShipmentHandling' => ServiceConfigurationShipmentHandling::class,
            'ServiceconfigurationEndorsement' => ServiceConfigurationEndorsement::class,
            'ServiceconfigurationVisualAgeCheck' => ServiceConfigurationVisualAgeCheck::class,
            'ServiceconfigurationDetails' => ServiceConfigurationDetails::class,
            'ServiceconfigurationCashOnDelivery' => ServiceConfigurationCashOnDelivery::class,
            'ServiceconfigurationAdditionalInsurance' => ServiceConfigurationAdditionalInsurance::class,
            'ServiceconfigurationIC' => ServiceConfigurationIC::class,
            'Ident' => Ident::class,
            'ServiceconfigurationDetailsOptional' => ServiceConfigurationDetailsOptional::class,
            'ShipmentNotificationType' => ShipmentNotificationType::class,
            'BankType' => BankType::class,
            'ShipperType' => ShipperType::class,
            'ShipperTypeType' => ShipperTypeType::class,
            'NameType' => NameType::class,
            'NativeAddressType' => NativeAddressType::class,
            'CountryType' => CountryType::class,
            'CommunicationType' => CommunicationType::class,
            'ReceiverType' => ReceiverType::class,
            'ReceiverTypeType' => ReceiverTypeType::class,
            'ReceiverNativeAddressType' => ReceiverNativeAddressType::class,
            'PackStationType' => PackStationType::class,
            'cis:PostfilialeType' => PostfilialeType::class,
            'ExportDocumentType' => ExportDocumentType::class,
            'ExportDocPosition' => ExportDocPosition::class,
            // CREATE SHIPMENT - response types
            'CreateShipmentOrderResponse' => CreateShipmentOrderResponse::class,
            'CreationState' => CreationState::class,
            'LabelData' => LabelData::class,
        ];
    }
}
