<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Serializer;

use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\BankType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\CDP;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\CommunicationType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\CountryType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\Economy;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ExportDocPosition;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ExportDocumentType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\Ident;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\NameType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\NativeAddressType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\PackStationType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\PostfilialeType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ReceiverNativeAddressType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ReceiverType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ReceiverTypeType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfiguration;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationAdditionalInsurance;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationCashOnDelivery;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDateOfDelivery;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDeliveryTimeFrame;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDetails;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationDetailsOptional;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationEndorsement;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationIC;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationISR;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfigurationVisualAgeCheck;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\Shipment;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentDetailsType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentDetailsTypeType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentItemType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentNotificationType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentService;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipperType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipperTypeType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\ResponseType\CreationState;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\ResponseType\LabelData;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\ResponseType\DeletionState;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\GetVersion\GetVersionResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ResponseType\ValidationState;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentResponse;

class ClassMap
{
    /**
     * Map WSDL types to PHP classes.
     *
     * @return string[]
     */
    public static function get(): array
    {
        return [
            // shared types
            'Statusinformation' => StatusInformation::class,
            'Version' => Version::class,

            // GET VERSION - response types
            'GetVersionResponse' => GetVersionResponse::class,

            // VALIDATE SHIPMENT - request types
            'ValidateShipmentOrderRequest' => ValidateShipmentOrderRequest::class,
            // VALIDATE SHIPMENT - response types
            'ValidateShipmentResponse' => ValidateShipmentResponse::class,
            'ValidationState' => ValidationState::class,

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
            'ServiceconfigurationEndorsement' => ServiceConfigurationEndorsement::class,
            'ServiceconfigurationVisualAgeCheck' => ServiceConfigurationVisualAgeCheck::class,
            'ServiceconfigurationDetails' => ServiceConfigurationDetails::class,
            'ServiceconfigurationCashOnDelivery' => ServiceConfigurationCashOnDelivery::class,
            'ServiceconfigurationAdditionalInsurance' => ServiceConfigurationAdditionalInsurance::class,
            'ServiceconfigurationIC' => ServiceConfigurationIC::class,
            'Ident' => Ident::class,
            'ServiceconfigurationDetailsOptional' => ServiceConfigurationDetailsOptional::class,
            'Economy' => Economy::class,
            'CDP' => CDP::class,
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
