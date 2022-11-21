<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation\Query;

class XPath
{
    public const XPATH_MUST_ENCODE = './ShipmentOrder/PrintOnlyIfCodeable/@active';
    public const XPATH_LABEL_RESPONSE_TYPE = './labelResponseType';
    public const XPATH_GROUP_PROFILE_NAME = './groupProfileName';
    public const XPATH_LABEL_FORMAT = './labelFormat';
    public const XPATH_LABEL_FORMAT_RETOURE = './labelFormatRetoure';
    public const XPATH_COMBINED_PRINTING = './combinedPrinting';

    public const XPATH_SEQUENCE_NUMBER = './sequenceNumber';
    public const XPATH_ACCOUNT_NUMBER = './Shipment/ShipmentDetails/ns1:accountNumber';
    public const XPATH_RETURN_ACCOUNT_NUMBER = './Shipment/ShipmentDetails/returnShipmentAccountNumber';

    public const XPATH_PRODUCT = './Shipment/ShipmentDetails/product';
    public const XPATH_SHIPMENT_DATE = './Shipment/ShipmentDetails/shipmentDate';

    public const XPATH_CUSTOMER_REFERENCE = './Shipment/ShipmentDetails/customerReference';
    public const XPATH_RETURN_REFERENCE = './Shipment/ShipmentDetails/returnShipmentReference';
    public const XPATH_COST_CENTRE = './Shipment/ShipmentDetails/costCentre';

    public const XPATH_SHIPPER_COMPANY = './Shipment/Shipper/Name/ns1:name1';
    public const XPATH_SHIPPER_NAME = './Shipment/Shipper/Name/ns1:name2';
    public const XPATH_SHIPPER_NAME_ADDITION = './Shipment/Shipper/Name/ns1:name3';
    public const XPATH_SHIPPER_EMAIL = './Shipment/Shipper/Communication/ns1:email';
    public const XPATH_SHIPPER_PHONE = './Shipment/Shipper/Communication/ns1:phone';
    public const XPATH_SHIPPER_CONTACT_PERSON = './Shipment/Shipper/Communication/ns1:contactPerson';
    public const XPATH_SHIPPER_COUNTRY = './Shipment/Shipper/Address/ns1:Origin/ns1:countryISOCode';
    public const XPATH_SHIPPER_STATE = './Shipment/Shipper/Address/ns1:province';
    public const XPATH_SHIPPER_POSTAL_CODE = './Shipment/Shipper/Address/ns1:zip';
    public const XPATH_SHIPPER_CITY = './Shipment/Shipper/Address/ns1:city';
    public const XPATH_SHIPPER_STREET_NAME = './Shipment/Shipper/Address/ns1:streetName';
    public const XPATH_SHIPPER_STREET_NUMBER = './Shipment/Shipper/Address/ns1:streetNumber';
    public const XPATH_SHIPPER_ADDRESS_ADD1 = './Shipment/Shipper/Address/ns1:addressAddition[1]';
    public const XPATH_SHIPPER_ADDRESS_ADD2 = './Shipment/Shipper/Address/ns1:addressAddition[2]';
    public const XPATH_SHIPPER_DISPATCH_INFO = './Shipment/Shipper/Address/ns1:dispatchingInformation';
    public const XPATH_SHIPPER_REFERENCE = './Shipment/ShipperReference';

    public const XPATH_SHIPPER_BANK_OWNER = './Shipment/ShipmentDetails/BankData/ns1:accountOwner';
    public const XPATH_SHIPPER_BANK_NAME = './Shipment/ShipmentDetails/BankData/ns1:bankName';
    public const XPATH_SHIPPER_BANK_IBAN = './Shipment/ShipmentDetails/BankData/ns1:iban';
    public const XPATH_SHIPPER_BANK_BIC = './Shipment/ShipmentDetails/BankData/ns1:bic';
    public const XPATH_SHIPPER_BANK_REFERENCE = './Shipment/ShipmentDetails/BankData/ns1:accountreference';
    public const XPATH_SHIPPER_BANK_NOTE1 = './Shipment/ShipmentDetails/BankData/ns1:note1';
    public const XPATH_SHIPPER_BANK_NOTE2 = './Shipment/ShipmentDetails/BankData/ns1:note2';

    public const XPATH_RETURN_COMPANY = './Shipment/ReturnReceiver/Name/ns1:name1';
    public const XPATH_RETURN_NAME = './Shipment/ReturnReceiver/Name/ns1:name2';
    public const XPATH_RETURN_NAME_ADDITION = './Shipment/ReturnReceiver/Name/ns1:name3';
    public const XPATH_RETURN_EMAIL = './Shipment/ReturnReceiver/Communication/ns1:email';
    public const XPATH_RETURN_PHONE = './Shipment/ReturnReceiver/Communication/ns1:phone';
    public const XPATH_RETURN_CONTACT_PERSON = './Shipment/ReturnReceiver/Communication/ns1:contactPerson';
    public const XPATH_RETURN_COUNTRY = './Shipment/ReturnReceiver/Address/ns1:Origin/ns1:countryISOCode';
    public const XPATH_RETURN_STATE = './Shipment/ReturnReceiver/Address/ns1:province';
    public const XPATH_RETURN_POSTAL_CODE = './Shipment/ReturnReceiver/Address/ns1:zip';
    public const XPATH_RETURN_CITY = './Shipment/ReturnReceiver/Address/ns1:city';
    public const XPATH_RETURN_STREET_NAME = './Shipment/ReturnReceiver/Address/ns1:streetName';
    public const XPATH_RETURN_STREET_NUMBER = './Shipment/ReturnReceiver/Address/ns1:streetNumber';
    public const XPATH_RETURN_ADDRESS_ADD1 = './Shipment/ReturnReceiver/Address/ns1:addressAddition[1]';
    public const XPATH_RETURN_ADDRESS_ADD2 = './Shipment/ReturnReceiver/Address/ns1:addressAddition[2]';
    public const XPATH_RETURN_DISPATCH_INFO = './Shipment/ReturnReceiver/Address/ns1:dispatchingInformation';

    public const XPATH_RECIPIENT_NAME = './Shipment/Receiver/ns1:name1';
    public const XPATH_RECIPIENT_COMPANY = './Shipment/Receiver/Address/ns1:name2';
    public const XPATH_RECIPIENT_NAME_ADDITION = './Shipment/Receiver/Address/ns1:name3';
    public const XPATH_RECIPIENT_EMAIL = './Shipment/Receiver/Communication/ns1:email';
    public const XPATH_RECIPIENT_PHONE = './Shipment/Receiver/Communication/ns1:phone';
    public const XPATH_RECIPIENT_CONTACT_PERSON = './Shipment/Receiver/Communication/ns1:contactPerson';
    public const XPATH_RECIPIENT_COUNTRY = './Shipment/Receiver/Address/ns1:Origin/ns1:countryISOCode';
    public const XPATH_RECIPIENT_STATE = './Shipment/Receiver/Address/ns1:province';
    public const XPATH_RECIPIENT_POSTAL_CODE = './Shipment/Receiver/Address/ns1:zip';
    public const XPATH_RECIPIENT_CITY = './Shipment/Receiver/Address/ns1:city';
    public const XPATH_RECIPIENT_STREET_NAME = './Shipment/Receiver/Address/ns1:streetName';
    public const XPATH_RECIPIENT_STREET_NUMBER = './Shipment/Receiver/Address/ns1:streetNumber';
    public const XPATH_RECIPIENT_ADDRESS_ADD1 = './Shipment/Receiver/Address/ns1:addressAddition[1]';
    public const XPATH_RECIPIENT_ADDRESS_ADD2 = './Shipment/Receiver/Address/ns1:addressAddition[2]';
    public const XPATH_RECIPIENT_DISPATCH_INFO = './Shipment/Receiver/Address/ns1:dispatchingInformation';
    public const XPATH_RECIPIENT_NOTIFICATION = './Shipment/ShipmentDetails/Notification/recipientEmailAddress';

    public const XPATH_PACKSTATION_NUMBER = './Shipment/Receiver/Packstation/ns1:packstationNumber';
    public const XPATH_PACKSTATION_POSTAL_CODE = './Shipment/Receiver/Packstation/ns1:zip';
    public const XPATH_PACKSTATION_CITY = './Shipment/Receiver/Packstation/ns1:city';
    public const XPATH_PACKSTATION_POST_NUMBER = './Shipment/Receiver/Packstation/ns1:postNumber';
    public const XPATH_PACKSTATION_PROVINCE = './Shipment/Receiver/Packstation/ns1:province';
    public const XPATH_PACKSTATION_COUNTRY_CODE = './Shipment/Receiver/Packstation/ns1:Origin/ns1:countryISOCode';
    public const XPATH_PACKSTATION_COUNTRY = './Shipment/Receiver/Packstation/ns1:Origin/ns1:country';
    public const XPATH_PACKSTATION_STATE = './Shipment/Receiver/Packstation/ns1:Origin/ns1:state';

    public const XPATH_POSTFILIALE_NUMBER = './Shipment/Receiver/Postfiliale/ns1:postfilialNumber';
    public const XPATH_POSTFILIALE_POST_NUMBER = './Shipment/Receiver/Postfiliale/ns1:postNumber';
    public const XPATH_POSTFILIALE_POSTAL_CODE = './Shipment/Receiver/Postfiliale/ns1:zip';
    public const XPATH_POSTFILIALE_CITY = './Shipment/Receiver/Postfiliale/ns1:city';
    public const XPATH_POSTFILIALE_COUNTRY = './Shipment/Receiver/Postfiliale/ns1:Origin/ns1:country';
    public const XPATH_POSTFILIALE_COUNTRY_CODE = './Shipment/Receiver/Postfiliale/ns1:Origin/ns1:countryISOCode';
    public const XPATH_POSTFILIALE_STATE = './Shipment/Receiver/Postfiliale/ns1:Origin/ns1:state';

    public const XPATH_WEIGHT = './Shipment/ShipmentDetails/ShipmentItem/weightInKG';
    public const XPATH_INSURED_VALUE = './Shipment/ShipmentDetails/Service/AdditionalInsurance/@insuranceAmount';
    public const XPATH_COD_AMOUNT = './Shipment/ShipmentDetails/Service/CashOnDelivery/@codAmount';

    public const XPATH_PACKAGE_LENGTH = './Shipment/ShipmentDetails/ShipmentItem/lengthInCM';
    public const XPATH_PACKAGE_WIDTH = './Shipment/ShipmentDetails/ShipmentItem/widthInCM';
    public const XPATH_PACKAGE_HEIGHT = './Shipment/ShipmentDetails/ShipmentItem/heightInCM';

    public const XPATH_EXPORT_TYPE = './Shipment/ExportDocument/exportType';
    public const XPATH_EXPORT_PLACE = './Shipment/ExportDocument/placeOfCommital';
    public const XPATH_EXPORT_FEE = './Shipment/ExportDocument/additionalFee';
    public const XPATH_EXPORT_DESCRIPTION = './Shipment/ExportDocument/exportTypeDescription';
    public const XPATH_EXPORT_INCOTERMS = './Shipment/ExportDocument/termsOfTrade';
    public const XPATH_EXPORT_INVOICE_NO = './Shipment/ExportDocument/invoiceNumber';
    public const XPATH_EXPORT_PERMIT_NO = './Shipment/ExportDocument/permitNumber';
    public const XPATH_EXPORT_ATTESTATION_NO = './Shipment/ExportDocument/attestationNumber';
    public const XPATH_EXPORT_NOTIFICATION = './Shipment/ExportDocument/WithElectronicExportNtfctn/@active';
    public const XPATH_EXPORT_ITEM1_QTY = './Shipment/ExportDocument/ExportDocPosition[1]/amount';
    public const XPATH_EXPORT_ITEM1_DESC = './Shipment/ExportDocument/ExportDocPosition[1]/description';
    public const XPATH_EXPORT_ITEM1_WEIGHT = './Shipment/ExportDocument/ExportDocPosition[1]/netWeightInKG';
    public const XPATH_EXPORT_ITEM1_VALUE = './Shipment/ExportDocument/ExportDocPosition[1]/customsValue';
    public const XPATH_EXPORT_ITEM1_HSCODE = './Shipment/ExportDocument/ExportDocPosition[1]/customsTariffNumber';
    public const XPATH_EXPORT_ITEM1_ORIGIN = './Shipment/ExportDocument/ExportDocPosition[1]/countryCodeOrigin';
    public const XPATH_EXPORT_ITEM2_QTY = './Shipment/ExportDocument/ExportDocPosition[2]/amount';
    public const XPATH_EXPORT_ITEM2_DESC = './Shipment/ExportDocument/ExportDocPosition[2]/description';
    public const XPATH_EXPORT_ITEM2_WEIGHT = './Shipment/ExportDocument/ExportDocPosition[2]/netWeightInKG';
    public const XPATH_EXPORT_ITEM2_VALUE = './Shipment/ExportDocument/ExportDocPosition[2]/customsValue';
    public const XPATH_EXPORT_ITEM2_HSCODE = './Shipment/ExportDocument/ExportDocPosition[2]/customsTariffNumber';
    public const XPATH_EXPORT_ITEM2_ORIGIN = './Shipment/ExportDocument/ExportDocPosition[2]/countryCodeOrigin';

    public const XPATH_SERVICE_PREFERRED_DAY = './Shipment/ShipmentDetails/Service/PreferredDay/@details';
    public const XPATH_SERVICE_PREFERRED_LOCATION = './Shipment/ShipmentDetails/Service/PreferredLocation/@details';
    public const XPATH_SERVICE_PREFERRED_NEIGHBOUR = './Shipment/ShipmentDetails/Service/PreferredNeighbour/@details';
    public const XPATH_SERVICE_SENDER_REQUIREMENT = './Shipment/ShipmentDetails/Service/IndividualSenderRequirement/' .
    '@details';
    public const XPATH_SERVICE_AGECHECK = './Shipment/ShipmentDetails/Service/VisualCheckOfAge/@type';
    public const XPATH_SERVICE_NO_NEIGHBOUR_DELIVERY = './Shipment/ShipmentDetails/Service/NoNeighbourDelivery/@active';
    public const XPATH_SERVICE_NAMES_PERSON_ONLY = './Shipment/ShipmentDetails/Service/NamedPersonOnly/@active';
    public const XPATH_SERVICE_RETURN_RECEIPT = './Shipment/ShipmentDetails/Service/ReturnReceipt/@active';
    public const XPATH_SERVICE_PREMIUM = './Shipment/ShipmentDetails/Service/Premium/@active';
    public const XPATH_SERVICE_BULKY_GOODS = './Shipment/ShipmentDetails/Service/BulkyGoods/@active';
    public const XPATH_SERVICE_IDENT_LASTNAME = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/surname';
    public const XPATH_SERVICE_IDENT_FIRSTNAME = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/givenName';
    public const XPATH_SERVICE_IDENT_DOB = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/dateOfBirth';
    public const XPATH_SERVICE_IDENT_MINAGE = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/minimumAge';
    public const XPATH_SERVICE_ROUTING = './Shipment/ShipmentDetails/Service/ParcelOutletRouting/@details';

    /**
     * @param string $attribute
     * @return string
     */
    public static function get(string $attribute): string
    {
        $map = [
            'mustEncode' => self::XPATH_MUST_ENCODE,
            'labelResponseType' => self::XPATH_LABEL_RESPONSE_TYPE,
            'groupProfileName' => self::XPATH_GROUP_PROFILE_NAME,
            'labelFormat' => self::XPATH_LABEL_FORMAT,
            'labelFormatRetoure' => self::XPATH_LABEL_FORMAT_RETOURE,
            'combinedPrinting' => self::XPATH_COMBINED_PRINTING,

            'sequenceNumber' => self::XPATH_SEQUENCE_NUMBER,
            'billingNumber' => self::XPATH_ACCOUNT_NUMBER,
            'returnBillingNumber' => self::XPATH_RETURN_ACCOUNT_NUMBER,
            'productCode' => self::XPATH_PRODUCT,
            'shipDate' => self::XPATH_SHIPMENT_DATE,
            'customerReference' => self::XPATH_CUSTOMER_REFERENCE,
            'returnReference' => self::XPATH_RETURN_REFERENCE,
            'costCentre' => self::XPATH_COST_CENTRE,

            'shipperName' => self::XPATH_SHIPPER_NAME,
            'shipperNameAddition' => self::XPATH_SHIPPER_NAME_ADDITION,
            'shipperCompany' => self::XPATH_SHIPPER_COMPANY,
            'shipperEmail' => self::XPATH_SHIPPER_EMAIL,
            'shipperPhone' => self::XPATH_SHIPPER_PHONE,
            'shipperContactPerson' => self::XPATH_SHIPPER_CONTACT_PERSON,
            'shipperCountry' => self::XPATH_SHIPPER_COUNTRY,
            'shipperState' => self::XPATH_SHIPPER_STATE,
            'shipperPostalCode' => self::XPATH_SHIPPER_POSTAL_CODE,
            'shipperCity' => self::XPATH_SHIPPER_CITY,
            'shipperStreet' => self::XPATH_SHIPPER_STREET_NAME,
            'shipperStreetNumber' => self::XPATH_SHIPPER_STREET_NUMBER,
            'shipperAddressAddition1' => self::XPATH_SHIPPER_ADDRESS_ADD1,
            'shipperAddressAddition2' => self::XPATH_SHIPPER_ADDRESS_ADD2,
            'shipperDispatchingInformation' => self::XPATH_SHIPPER_DISPATCH_INFO,
            'shipperReference' => self::XPATH_SHIPPER_REFERENCE,

            'shipperBankOwner' => self::XPATH_SHIPPER_BANK_OWNER,
            'shipperBankName' => self::XPATH_SHIPPER_BANK_NAME,
            'shipperBankIban' => self::XPATH_SHIPPER_BANK_IBAN,
            'shipperBankBic' => self::XPATH_SHIPPER_BANK_BIC,
            'shipperBankReference' => self::XPATH_SHIPPER_BANK_REFERENCE,
            'shipperBankNote1' => self::XPATH_SHIPPER_BANK_NOTE1,
            'shipperBankNote2' => self::XPATH_SHIPPER_BANK_NOTE2,

            'returnName' => self::XPATH_RETURN_NAME,
            'returnNameAddition' => self::XPATH_RETURN_NAME_ADDITION,
            'returnCompany' => self::XPATH_RETURN_COMPANY,
            'returnEmail' => self::XPATH_RETURN_EMAIL,
            'returnPhone' => self::XPATH_RETURN_PHONE,
            'returnContactPerson' => self::XPATH_RETURN_CONTACT_PERSON,
            'returnCountry' => self::XPATH_RETURN_COUNTRY,
            'returnState' => self::XPATH_RETURN_STATE,
            'returnPostalCode' => self::XPATH_RETURN_POSTAL_CODE,
            'returnCity' => self::XPATH_RETURN_CITY,
            'returnStreet' => self::XPATH_RETURN_STREET_NAME,
            'returnStreetNumber' => self::XPATH_RETURN_STREET_NUMBER,
            'returnAddressAddition1' => self::XPATH_RETURN_ADDRESS_ADD1,
            'returnAddressAddition2' => self::XPATH_RETURN_ADDRESS_ADD2,
            'returnDispatchingInformation' => self::XPATH_RETURN_DISPATCH_INFO,

            'recipientName' => self::XPATH_RECIPIENT_NAME,
            'recipientNameAddition' => self::XPATH_RECIPIENT_NAME_ADDITION,
            'recipientCompany' => self::XPATH_RECIPIENT_COMPANY,
            'recipientEmail' => self::XPATH_RECIPIENT_EMAIL,
            'recipientPhone' => self::XPATH_RECIPIENT_PHONE,
            'recipientContactPerson' => self::XPATH_RECIPIENT_CONTACT_PERSON,
            'recipientCountry' => self::XPATH_RECIPIENT_COUNTRY,
            'recipientState' => self::XPATH_RECIPIENT_STATE,
            'recipientPostalCode' => self::XPATH_RECIPIENT_POSTAL_CODE,
            'recipientCity' => self::XPATH_RECIPIENT_CITY,
            'recipientStreet' => self::XPATH_RECIPIENT_STREET_NAME,
            'recipientStreetNumber' => self::XPATH_RECIPIENT_STREET_NUMBER,
            'recipientAddressAddition1' => self::XPATH_RECIPIENT_ADDRESS_ADD1,
            'recipientAddressAddition2' => self::XPATH_RECIPIENT_ADDRESS_ADD2,
            'recipientDispatchingInformation' => self::XPATH_RECIPIENT_DISPATCH_INFO,
            'recipientNotification' => self::XPATH_RECIPIENT_NOTIFICATION,

            'packstationRecipientName' => self::XPATH_RECIPIENT_NAME,
            'packstationNumber' => self::XPATH_PACKSTATION_NUMBER,
            'packstationPostalCode' => self::XPATH_PACKSTATION_POSTAL_CODE,
            'packstationCity' => self::XPATH_PACKSTATION_CITY,
            'packstationPostNumber' => self::XPATH_PACKSTATION_POST_NUMBER,
            'packstationState' => self::XPATH_PACKSTATION_STATE,
            'packstationProvince' => self::XPATH_PACKSTATION_PROVINCE,
            'packstationCountry' => self::XPATH_PACKSTATION_COUNTRY,
            'packstationCountryCode' => self::XPATH_PACKSTATION_COUNTRY_CODE,

            'postfilialRecipientName' => self::XPATH_RECIPIENT_NAME,
            'postfilialNumber' => self::XPATH_POSTFILIALE_NUMBER,
            'postfilialPostNumber' => self::XPATH_POSTFILIALE_POST_NUMBER,
            'postfilialPostalCode' => self::XPATH_POSTFILIALE_POSTAL_CODE,
            'postfilialCity' => self::XPATH_POSTFILIALE_CITY,
            'postfilialCountry' => self::XPATH_POSTFILIALE_COUNTRY,
            'postfilialCountryCode' => self::XPATH_POSTFILIALE_COUNTRY_CODE,
            'postfilialState' => self::XPATH_POSTFILIALE_STATE,

            'packageWeight' => self::XPATH_WEIGHT,
            'packageValue' => self::XPATH_INSURED_VALUE,
            'packageLength' => self::XPATH_PACKAGE_LENGTH,
            'packageWidth' => self::XPATH_PACKAGE_WIDTH,
            'packageHeight' => self::XPATH_PACKAGE_HEIGHT,

            'exportType' => self::XPATH_EXPORT_TYPE,
            'placeOfCommital' => self::XPATH_EXPORT_PLACE,
            'additionalFee' => self::XPATH_EXPORT_FEE,
            'exportTypeDescription' => self::XPATH_EXPORT_DESCRIPTION,
            'termsOfTrade' => self::XPATH_EXPORT_INCOTERMS,
            'invoiceNumber' => self::XPATH_EXPORT_INVOICE_NO,
            'permitNumber' => self::XPATH_EXPORT_PERMIT_NO,
            'attestationNumber' => self::XPATH_EXPORT_ATTESTATION_NO,
            'electronicExportNotification' => self::XPATH_EXPORT_NOTIFICATION,
            'exportItem1Qty' => self::XPATH_EXPORT_ITEM1_QTY,
            'exportItem1Desc' => self::XPATH_EXPORT_ITEM1_DESC,
            'exportItem1Weight' => self::XPATH_EXPORT_ITEM1_WEIGHT,
            'exportItem1Value' => self::XPATH_EXPORT_ITEM1_VALUE,
            'exportItem1HsCode' => self::XPATH_EXPORT_ITEM1_HSCODE,
            'exportItem1Origin' => self::XPATH_EXPORT_ITEM1_ORIGIN,
            'exportItem2Qty' => self::XPATH_EXPORT_ITEM2_QTY,
            'exportItem2Desc' => self::XPATH_EXPORT_ITEM2_DESC,
            'exportItem2Weight' => self::XPATH_EXPORT_ITEM2_WEIGHT,
            'exportItem2Value' => self::XPATH_EXPORT_ITEM2_VALUE,
            'exportItem2HsCode' => self::XPATH_EXPORT_ITEM2_HSCODE,
            'exportItem2Origin' => self::XPATH_EXPORT_ITEM2_ORIGIN,

            'codAmount' => self::XPATH_COD_AMOUNT,

            'preferredDay' => self::XPATH_SERVICE_PREFERRED_DAY,
            'preferredLocation' => self::XPATH_SERVICE_PREFERRED_LOCATION,
            'preferredNeighbour' => self::XPATH_SERVICE_PREFERRED_NEIGHBOUR,
            'senderRequirement' => self::XPATH_SERVICE_SENDER_REQUIREMENT,
            'visualCheckOfAge' => self::XPATH_SERVICE_AGECHECK,
            'noNeighbourDelivery' => self::XPATH_SERVICE_NO_NEIGHBOUR_DELIVERY,
            'namedPersonOnly' => self::XPATH_SERVICE_NAMES_PERSON_ONLY,
            'returnReceipt' => self::XPATH_SERVICE_RETURN_RECEIPT,
            'premium' => self::XPATH_SERVICE_PREMIUM,
            'bulkyGoods' => self::XPATH_SERVICE_BULKY_GOODS,
            'identLastName' => self::XPATH_SERVICE_IDENT_LASTNAME,
            'identFirstName' => self::XPATH_SERVICE_IDENT_FIRSTNAME,
            'identDob' => self::XPATH_SERVICE_IDENT_DOB,
            'identMinAge' => self::XPATH_SERVICE_IDENT_MINAGE,
            'parcelOutletRouting' => self::XPATH_SERVICE_ROUTING,
        ];

        return $map[$attribute];
    }
}
