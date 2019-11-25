<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

/**
 * Class XPath
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class XPath
{
    const XPATH_PRINT_CODEABLE = './PrintOnlyIfCodeable/@active';
    const XPATH_SEQUENCE_NUMBER = './sequenceNumber';
    const XPATH_ACCOUNT_NUMBER = './Shipment/ShipmentDetails/ns1:accountNumber';
    const XPATH_RETURN_ACCOUNT_NUMBER = './Shipment/ShipmentDetails/returnShipmentAccountNumber';

    const XPATH_PRODUCT = './Shipment/ShipmentDetails/product';
    const XPATH_SHIPMENT_DATE = './Shipment/ShipmentDetails/shipmentDate';

    const XPATH_CUSTOMER_REFERENCE = './Shipment/ShipmentDetails/customerReference';
    const XPATH_RETURN_REFERENCE = './Shipment/ShipmentDetails/returnShipmentReference';
    const XPATH_COST_CENTRE = './Shipment/ShipmentDetails/costCentre';

    const XPATH_SHIPPER_COMPANY = './Shipment/Shipper/Name/ns1:name1';
    const XPATH_SHIPPER_NAME = './Shipment/Shipper/Name/ns1:name2';
    const XPATH_SHIPPER_NAME_ADDITION = './Shipment/Shipper/Name/ns1:name3';
    const XPATH_SHIPPER_EMAIL = './Shipment/Shipper/Communication/ns1:email';
    const XPATH_SHIPPER_PHONE = './Shipment/Shipper/Communication/ns1:phone';
    const XPATH_SHIPPER_CONTACT_PERSON = './Shipment/Shipper/Communication/ns1:contactPerson';
    const XPATH_SHIPPER_COUNTRY = './Shipment/Shipper/Address/ns1:Origin/ns1:countryISOCode';
    const XPATH_SHIPPER_STATE = './Shipment/Shipper/Address/ns1:province';
    const XPATH_SHIPPER_POSTAL_CODE = './Shipment/Shipper/Address/ns1:zip';
    const XPATH_SHIPPER_CITY = './Shipment/Shipper/Address/ns1:city';
    const XPATH_SHIPPER_STREET_NAME = './Shipment/Shipper/Address/ns1:streetName';
    const XPATH_SHIPPER_STREET_NUMBER = './Shipment/Shipper/Address/ns1:streetNumber';
    const XPATH_SHIPPER_ADDRESS_ADD1 = './Shipment/Shipper/Address/ns1:addressAddition[1]';
    const XPATH_SHIPPER_ADDRESS_ADD2 = './Shipment/Shipper/Address/ns1:addressAddition[2]';
    const XPATH_SHIPPER_DISPATCH_INFO = './Shipment/Shipper/Address/ns1:dispatchingInformation';
    const XPATH_SHIPPER_REFERENCE = './Shipment/ShipperReference';

    const XPATH_SHIPPER_BANK_OWNER = './Shipment/ShipmentDetails/BankData/ns1:accountOwner';
    const XPATH_SHIPPER_BANK_NAME = './Shipment/ShipmentDetails/BankData/ns1:bankName';
    const XPATH_SHIPPER_BANK_IBAN = './Shipment/ShipmentDetails/BankData/ns1:iban';
    const XPATH_SHIPPER_BANK_BIC = './Shipment/ShipmentDetails/BankData/ns1:bic';
    const XPATH_SHIPPER_BANK_REFERENCE = './Shipment/ShipmentDetails/BankData/ns1:accountreference';
    const XPATH_SHIPPER_BANK_NOTE1 = './Shipment/ShipmentDetails/BankData/ns1:note1';
    const XPATH_SHIPPER_BANK_NOTE2 = './Shipment/ShipmentDetails/BankData/ns1:note2';

    const XPATH_RETURN_COMPANY = './Shipment/ReturnReceiver/Name/ns1:name1';
    const XPATH_RETURN_NAME = './Shipment/ReturnReceiver/Name/ns1:name2';
    const XPATH_RETURN_NAME_ADDITION = './Shipment/ReturnReceiver/Name/ns1:name3';
    const XPATH_RETURN_EMAIL = './Shipment/ReturnReceiver/Communication/ns1:email';
    const XPATH_RETURN_PHONE = './Shipment/ReturnReceiver/Communication/ns1:phone';
    const XPATH_RETURN_CONTACT_PERSON = './Shipment/ReturnReceiver/Communication/ns1:contactPerson';
    const XPATH_RETURN_COUNTRY = './Shipment/ReturnReceiver/Address/ns1:Origin/ns1:countryISOCode';
    const XPATH_RETURN_STATE = './Shipment/ReturnReceiver/Address/ns1:province';
    const XPATH_RETURN_POSTAL_CODE = './Shipment/ReturnReceiver/Address/ns1:zip';
    const XPATH_RETURN_CITY = './Shipment/ReturnReceiver/Address/ns1:city';
    const XPATH_RETURN_STREET_NAME = './Shipment/ReturnReceiver/Address/ns1:streetName';
    const XPATH_RETURN_STREET_NUMBER = './Shipment/ReturnReceiver/Address/ns1:streetNumber';
    const XPATH_RETURN_ADDRESS_ADD1 = './Shipment/ReturnReceiver/Address/ns1:addressAddition[1]';
    const XPATH_RETURN_ADDRESS_ADD2 = './Shipment/ReturnReceiver/Address/ns1:addressAddition[2]';
    const XPATH_RETURN_DISPATCH_INFO = './Shipment/ReturnReceiver/Address/ns1:dispatchingInformation';

    const XPATH_RECIPIENT_NAME = './Shipment/Receiver/ns1:name1';
    const XPATH_RECIPIENT_COMPANY = './Shipment/Receiver/Address/ns1:name2';
    const XPATH_RECIPIENT_NAME_ADDITION = './Shipment/Receiver/Address/ns1:name3';
    const XPATH_RECIPIENT_EMAIL = './Shipment/Receiver/Communication/ns1:email';
    const XPATH_RECIPIENT_PHONE = './Shipment/Receiver/Communication/ns1:phone';
    const XPATH_RECIPIENT_CONTACT_PERSON = './Shipment/Receiver/Communication/ns1:contactPerson';
    const XPATH_RECIPIENT_COUNTRY = './Shipment/Receiver/Address/ns1:Origin/ns1:countryISOCode';
    const XPATH_RECIPIENT_STATE = './Shipment/Receiver/Address/ns1:province';
    const XPATH_RECIPIENT_POSTAL_CODE = './Shipment/Receiver/Address/ns1:zip';
    const XPATH_RECIPIENT_CITY = './Shipment/Receiver/Address/ns1:city';
    const XPATH_RECIPIENT_STREET_NAME = './Shipment/Receiver/Address/ns1:streetName';
    const XPATH_RECIPIENT_STREET_NUMBER = './Shipment/Receiver/Address/ns1:streetNumber';
    const XPATH_RECIPIENT_ADDRESS_ADD1 = './Shipment/Receiver/Address/ns1:addressAddition[1]';
    const XPATH_RECIPIENT_ADDRESS_ADD2 = './Shipment/Receiver/Address/ns1:addressAddition[2]';
    const XPATH_RECIPIENT_DISPATCH_INFO = './Shipment/Receiver/Address/ns1:dispatchingInformation';
    const XPATH_RECIPIENT_NOTIFICATION = './Shipment/ShipmentDetails/Notification/recipientEmailAddress';

    const XPATH_PACKSTATION_NUMBER = './Shipment/Receiver/Packstation/ns1:packstationNumber';
    const XPATH_PACKSTATION_POSTAL_CODE = './Shipment/Receiver/Packstation/ns1:zip';
    const XPATH_PACKSTATION_CITY = './Shipment/Receiver/Packstation/ns1:city';
    const XPATH_PACKSTATION_POST_NUMBER = './Shipment/Receiver/Packstation/ns1:postNumber';
    const XPATH_PACKSTATION_STATE = './Shipment/Receiver/Packstation/ns1:province';
    const XPATH_PACKSTATION_COUNTRY = './Shipment/Receiver/Packstation/ns1:Origin/ns1:countryISOCode';
    const XPATH_POSTFILIALE_NUMBER = './Shipment/Receiver/Postfiliale/PostfilialNumber';
    const XPATH_POSTFILIALE_POST_NUMBER = './Shipment/Receiver/Postfiliale/PostNumber';
    const XPATH_POSTFILIALE_POSTAL_CODE = './Shipment/Receiver/Postfiliale/Zip';
    const XPATH_POSTFILIALE_CITY = './Shipment/Receiver/Postfiliale/City';

    const XPATH_WEIGHT = './Shipment/ShipmentDetails/ShipmentItem/weightInKG';
    const XPATH_INSURED_VALUE = './Shipment/ShipmentDetails/Service/AdditionalInsurance/@insuranceAmount';
    const XPATH_COD_AMOUNT = './Shipment/ShipmentDetails/Service/CashOnDelivery/@codAmount';
    const XPATH_COD_ADD_FEE = './Shipment/ShipmentDetails/Service/CashOnDelivery/@addFee';

    const XPATH_PACKAGE_LENGTH = './Shipment/ShipmentDetails/ShipmentItem/lengthInCM';
    const XPATH_PACKAGE_WIDTH = './Shipment/ShipmentDetails/ShipmentItem/widthInCM';
    const XPATH_PACKAGE_HEIGHT = './Shipment/ShipmentDetails/ShipmentItem/heightInCM';

    const XPATH_EXPORT_TYPE = './Shipment/ExportDocument/exportType';
    const XPATH_EXPORT_PLACE = './Shipment/ExportDocument/placeOfCommital';
    const XPATH_EXPORT_FEE = './Shipment/ExportDocument/additionalFee';
    const XPATH_EXPORT_DESCRIPTION = './Shipment/ExportDocument/exportTypeDescription';
    const XPATH_EXPORT_INCOTERMS = './Shipment/ExportDocument/termsOfTrade';
    const XPATH_EXPORT_INVOICE_NO = './Shipment/ExportDocument/invoiceNumber';
    const XPATH_EXPORT_PERMIT_NO = './Shipment/ExportDocument/permitNumber';
    const XPATH_EXPORT_ATTESTATION_NO = './Shipment/ExportDocument/attestationNumber';
    const XPATH_EXPORT_NOTIFICATION = './Shipment/ExportDocument/WithElectronicExportNtfctn/@active';
    const XPATH_EXPORT_ITEM1_QTY = './Shipment/ExportDocument/ExportDocPosition[1]/amount';
    const XPATH_EXPORT_ITEM1_DESC = './Shipment/ExportDocument/ExportDocPosition[1]/description';
    const XPATH_EXPORT_ITEM1_WEIGHT = './Shipment/ExportDocument/ExportDocPosition[1]/netWeightInKG';
    const XPATH_EXPORT_ITEM1_VALUE = './Shipment/ExportDocument/ExportDocPosition[1]/customsValue';
    const XPATH_EXPORT_ITEM1_HSCODE = './Shipment/ExportDocument/ExportDocPosition[1]/customsTariffNumber';
    const XPATH_EXPORT_ITEM1_ORIGIN = './Shipment/ExportDocument/ExportDocPosition[1]/countryCodeOrigin';
    const XPATH_EXPORT_ITEM2_QTY = './Shipment/ExportDocument/ExportDocPosition[2]/amount';
    const XPATH_EXPORT_ITEM2_DESC = './Shipment/ExportDocument/ExportDocPosition[2]/description';
    const XPATH_EXPORT_ITEM2_WEIGHT = './Shipment/ExportDocument/ExportDocPosition[2]/netWeightInKG';
    const XPATH_EXPORT_ITEM2_VALUE = './Shipment/ExportDocument/ExportDocPosition[2]/customsValue';
    const XPATH_EXPORT_ITEM2_HSCODE = './Shipment/ExportDocument/ExportDocPosition[2]/customsTariffNumber';
    const XPATH_EXPORT_ITEM2_ORIGIN = './Shipment/ExportDocument/ExportDocPosition[2]/countryCodeOrigin';

    const XPATH_SERVICE_PREFERRED_DAY = './Shipment/ShipmentDetails/Service/PreferredDay/@details';
    const XPATH_SERVICE_PREFERRED_TIME = './Shipment/ShipmentDetails/Service/PreferredTime/@type';
    const XPATH_SERVICE_PREFERRED_LOCATION = './Shipment/ShipmentDetails/Service/PreferredLocation/@details';
    const XPATH_SERVICE_PREFERRED_NEIGHBOUR = './Shipment/ShipmentDetails/Service/PreferredNeighbour/@details';
    const XPATH_SERVICE_SENDER_REQUIREMENT = './Shipment/ShipmentDetails/Service/IndividualSenderRequirement/@details';
    const XPATH_SERVICE_AGECHECK = './Shipment/ShipmentDetails/Service/VisualCheckOfAge/@type';
    const XPATH_SERVICE_GOGREEN = './Shipment/ShipmentDetails/Service/GoGreen/@active';
    const XPATH_SERVICE_PERISHABLES = './Shipment/ShipmentDetails/Service/Perishables/@active';
    const XPATH_SERVICE_PERSONALLY = './Shipment/ShipmentDetails/Service/Personally/@active';
    const XPATH_SERVICE_NO_NEIGHBOUR_DELIVERY = './Shipment/ShipmentDetails/Service/NoNeighbourDelivery/@active';
    const XPATH_SERVICE_NAMES_PERSON_ONLY = './Shipment/ShipmentDetails/Service/NamedPersonOnly/@active';
    const XPATH_SERVICE_RETURN_RECEIPT = './Shipment/ShipmentDetails/Service/ReturnReceipt/@active';
    const XPATH_SERVICE_PREMIUM = './Shipment/ShipmentDetails/Service/Premium/@active';
    const XPATH_SERVICE_BULKY_GOODS = './Shipment/ShipmentDetails/Service/BulkyGoods/@active';
    const XPATH_SERVICE_IDENT_LASTNAME = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/surname';
    const XPATH_SERVICE_IDENT_FIRSTNAME = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/givenName';
    const XPATH_SERVICE_IDENT_DOB = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/dateOfBirth';
    const XPATH_SERVICE_IDENT_MINAGE = './Shipment/ShipmentDetails/Service/IdentCheck/Ident/minimumAge';
    const XPATH_SERVICE_ROUTING = './Shipment/ShipmentDetails/Service/ParcelOutletRouting/@details';

    /**
     * @param string $attribute
     * @return string
     */
    public static function get(string $attribute)
    {
        $map = [
            'printOnlyIfCodeable' => self::XPATH_PRINT_CODEABLE,
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
            'packstationCountry' => self::XPATH_PACKSTATION_COUNTRY,
            'postfilialRecipientName' => self::XPATH_RECIPIENT_NAME,
            'postfilialNumber' => self::XPATH_POSTFILIALE_NUMBER,
            'postfilialPostNumber' => self::XPATH_POSTFILIALE_POST_NUMBER,
            'postfilialPostalCode' => self::XPATH_POSTFILIALE_POSTAL_CODE,
            'postfilialCity' => self::XPATH_POSTFILIALE_CITY,

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
            'addCodFee' => self::XPATH_COD_ADD_FEE,

            'preferredDay' => self::XPATH_SERVICE_PREFERRED_DAY,
            'preferredTime' => self::XPATH_SERVICE_PREFERRED_TIME,
            'preferredLocation' => self::XPATH_SERVICE_PREFERRED_LOCATION,
            'preferredNeighbour' => self::XPATH_SERVICE_PREFERRED_NEIGHBOUR,
            'senderRequirement' => self::XPATH_SERVICE_SENDER_REQUIREMENT,
            'visualCheckOfAge' => self::XPATH_SERVICE_AGECHECK,
            'goGreen' => self::XPATH_SERVICE_GOGREEN,
            'perishables' => self::XPATH_SERVICE_PERISHABLES,
            'personally' => self::XPATH_SERVICE_PERSONALLY,
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
