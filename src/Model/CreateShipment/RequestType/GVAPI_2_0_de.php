<?php

namespace Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType;

class GVAPI_2_0_de extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'CreateShipmentOrderRequest' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\CreateShipmentOrderRequest',
      'CreateShipmentOrderResponse' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\CreateShipmentOrderResponse',
      'Version' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\Version',
      'ShipmentOrderType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipmentOrderType',
      'Shipment' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\Shipment',
      'ShipmentDetailsTypeType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipmentDetailsTypeType',
      'ShipmentDetailsType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipmentDetailsType',
      'ShipmentItemType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipmentItemType',
      'ShipmentService' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipmentService',
      'ServiceconfigurationDateOfDelivery' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationDateOfDelivery',
      'ServiceconfigurationDeliveryTimeframe' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationDeliveryTimeframe',
      'ServiceconfigurationISR' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationISR',
      'Serviceconfiguration' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\Serviceconfiguration',
      'ServiceconfigurationShipmentHandling' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationShipmentHandling',
      'ServiceconfigurationEndorsement' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationEndorsement',
      'ServiceconfigurationVisualAgeCheck' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationVisualAgeCheck',
      'ServiceconfigurationDetails' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationDetails',
      'ServiceconfigurationCashOnDelivery' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationCashOnDelivery',
      'ServiceconfigurationAdditionalInsurance' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationAdditionalInsurance',
      'ServiceconfigurationIC' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationIC',
      'Ident' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\Ident',
      'ServiceconfigurationDetailsOptional' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ServiceconfigurationDetailsOptional',
      'ShipmentNotificationType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipmentNotificationType',
      'BankType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\BankType',
      'ShipperType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipperType',
      'ShipperTypeType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ShipperTypeType',
      'NameType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\NameType',
      'NativeAddressType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\NativeAddressType',
      'CountryType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\CountryType',
      'CommunicationType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\CommunicationType',
      'ReceiverType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ReceiverType',
      'ReceiverTypeType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ReceiverTypeType',
      'ReceiverNativeAddressType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ReceiverNativeAddressType',
      'PackStationType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\PackStationType',
      'PostfilialeType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\PostfilialeType',
      'ExportDocumentType' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ExportDocumentType',
      'ExportDocPosition' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\ExportDocPosition',
      'Statusinformation' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\Statusinformation',
      'CreationState' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\CreationState',
      'LabelData' => 'Dhl\\Sdk\\Paket\\Bcs\\Model\\CreateLabel\\RequestType\\LabelData',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      if (!$wsdl) {
        $wsdl = 'https://cig.dhl.de/cig-wsdls/com/dpdhl/wsdl/geschaeftskundenversand-api/3.0/geschaeftskundenversand-api-3.0.wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * Creates shipments.
     *
     * @param CreateShipmentOrderRequest $part1
     * @return CreateShipmentOrderResponse
     */
    public function createShipmentOrder(CreateShipmentOrderRequest $part1)
    {
      return $this->__soapCall('createShipmentOrder', array($part1));
    }

}
