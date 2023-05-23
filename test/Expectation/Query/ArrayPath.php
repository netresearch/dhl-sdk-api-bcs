<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation\Query;

class ArrayPath
{
    public const PATH_MUST_ENCODE = './ShipmentOrder/PrintOnlyIfCodeable/@active';
    public const PATH_LABEL_RESPONSE_TYPE = './labelResponseType';
    public const PATH_GROUP_PROFILE_NAME = './groupProfileName';
    public const PATH_LABEL_FORMAT = './labelFormat';
    public const PATH_LABEL_FORMAT_RETOURE = './labelFormatRetoure';
    public const PATH_COMBINED_PRINTING = './combinedPrinting';

    public const PATH_SEQUENCE_NUMBER = ''; // N/A
    public const PATH_ACCOUNT_NUMBER = 'billingNumber';
    public const PATH_RETURN_ACCOUNT_NUMBER = 'services/dhlRetoure/billingNumber';

    public const PATH_PRODUCT = 'product';
    public const PATH_SHIPMENT_DATE = 'shipDate';

    public const PATH_CUSTOMER_REFERENCE = 'refNo';
    public const PATH_RETURN_REFERENCE = 'services/dhlRetoure/refNo';
    public const PATH_COST_CENTRE = 'costCenter';

    public const PATH_SHIPPER_COMPANY = 'shipper/name1';
    public const PATH_SHIPPER_NAME = 'shipper/name2';
    public const PATH_SHIPPER_NAME_ADDITION = 'shipper/name3';
    public const PATH_SHIPPER_EMAIL = 'shipper/email';
    public const PATH_SHIPPER_PHONE = 'shipper/phone';
    public const PATH_SHIPPER_CONTACT_PERSON = 'shipper/contactName';
    public const PATH_SHIPPER_COUNTRY = 'shipper/country';
    public const PATH_SHIPPER_STATE = 'shipper/state';
    public const PATH_SHIPPER_POSTAL_CODE = 'shipper/postalCode';
    public const PATH_SHIPPER_CITY = 'shipper/city';
    public const PATH_SHIPPER_STREET_NAME = 'shipper/addressStreet';
    public const PATH_SHIPPER_STREET_NUMBER = 'shipper/addressHouse';
    public const PATH_SHIPPER_ADDRESS_ADD1 = 'shipper/additionalAddressInformation1';
    public const PATH_SHIPPER_ADDRESS_ADD2 = 'shipper/additionalAddressInformation2';
    public const PATH_SHIPPER_DISPATCH_INFO = 'shipper/dispatchingInformation';
    public const PATH_SHIPPER_REFERENCE = 'shipper/shipperRef';

    public const PATH_SHIPPER_BANK_OWNER = 'services/cashOnDelivery/bankAccount/accountHolder';
    public const PATH_SHIPPER_BANK_NAME = 'services/cashOnDelivery/bankAccount/bankName';
    public const PATH_SHIPPER_BANK_IBAN = 'services/cashOnDelivery/bankAccount/iban';
    public const PATH_SHIPPER_BANK_BIC = 'services/cashOnDelivery/bankAccount/bic';
    public const PATH_SHIPPER_BANK_REFERENCE = 'services/cashOnDelivery/accountReference';
    public const PATH_SHIPPER_BANK_NOTE1 = 'services/cashOnDelivery/transferNote1';
    public const PATH_SHIPPER_BANK_NOTE2 = 'services/cashOnDelivery/transferNote2';

    public const PATH_RETURN_COMPANY = 'services/dhlRetoure/returnAddress/name1';
    public const PATH_RETURN_NAME = 'services/dhlRetoure/returnAddress/name2';
    public const PATH_RETURN_NAME_ADDITION = 'services/dhlRetoure/returnAddress/name3';
    public const PATH_RETURN_EMAIL = 'services/dhlRetoure/returnAddress/email';
    public const PATH_RETURN_PHONE = 'services/dhlRetoure/returnAddress/phone';
    public const PATH_RETURN_CONTACT_PERSON = 'services/dhlRetoure/returnAddress/contactName';
    public const PATH_RETURN_COUNTRY = 'services/dhlRetoure/returnAddress/country';
    public const PATH_RETURN_STATE = 'services/dhlRetoure/returnAddress/state';
    public const PATH_RETURN_POSTAL_CODE = 'services/dhlRetoure/returnAddress/postalCode';
    public const PATH_RETURN_CITY = 'services/dhlRetoure/returnAddress/city';
    public const PATH_RETURN_STREET_NAME = 'services/dhlRetoure/returnAddress/addressStreet';
    public const PATH_RETURN_STREET_NUMBER = 'services/dhlRetoure/returnAddress/addressHouse';
    public const PATH_RETURN_ADDRESS_ADD1 = 'services/dhlRetoure/returnAddress/additionalAddressInformation1';
    public const PATH_RETURN_ADDRESS_ADD2 = 'services/dhlRetoure/returnAddress/additionalAddressInformation2';
    public const PATH_RETURN_DISPATCH_INFO = 'services/dhlRetoure/returnAddress/dispatchingInformation';

    public const PATH_RECIPIENT_NAME = 'consignee/name1';
    public const PATH_RECIPIENT_COMPANY = 'consignee/name2';
    public const PATH_RECIPIENT_NAME_ADDITION = 'consignee/name3';
    public const PATH_RECIPIENT_EMAIL = 'consignee/email';
    public const PATH_RECIPIENT_PHONE = 'consignee/phone';
    public const PATH_RECIPIENT_CONTACT_PERSON = 'consignee/contactName';
    public const PATH_RECIPIENT_COUNTRY = 'consignee/country';
    public const PATH_RECIPIENT_STATE = 'consignee/state';
    public const PATH_RECIPIENT_POSTAL_CODE = 'consignee/postalCode';
    public const PATH_RECIPIENT_CITY = 'consignee/city';
    public const PATH_RECIPIENT_STREET_NAME = 'consignee/addressStreet';
    public const PATH_RECIPIENT_STREET_NUMBER = 'consignee/addressHouse';
    public const PATH_RECIPIENT_ADDRESS_ADD1 = 'consignee/additionalAddressInformation1';
    public const PATH_RECIPIENT_ADDRESS_ADD2 = 'consignee/additionalAddressInformation2';
    public const PATH_RECIPIENT_DISPATCH_INFO = 'consignee/dispatchingInformation';
    public const PATH_RECIPIENT_NOTIFICATION = 'services/shippingConfirmation/email';

    public const PATH_PACKSTATION_NAME = 'consignee/name';
    public const PATH_PACKSTATION_NUMBER = 'consignee/lockerID';
    public const PATH_PACKSTATION_POSTAL_CODE = 'consignee/postalCode';
    public const PATH_PACKSTATION_CITY = 'consignee/city';
    public const PATH_PACKSTATION_POST_NUMBER = 'consignee/postNumber';
    public const PATH_PACKSTATION_PROVINCE = ''; // N/A
    public const PATH_PACKSTATION_COUNTRY_CODE = 'consignee/country';
    public const PATH_PACKSTATION_COUNTRY = ''; // N/A
    public const PATH_PACKSTATION_STATE = ''; // N/A

    public const PATH_POSTFILIALE_NAME = 'consignee/name';
    public const PATH_POSTFILIALE_NUMBER = 'consignee/retailID';
    public const PATH_POSTFILIALE_POST_NUMBER = 'consignee/postNumber';
    public const PATH_POSTFILIALE_POSTAL_CODE = 'consignee/postalCode';
    public const PATH_POSTFILIALE_CITY = 'consignee/city';
    public const PATH_POSTFILIALE_COUNTRY = ''; // N/A
    public const PATH_POSTFILIALE_COUNTRY_CODE = 'consignee/country';
    public const PATH_POSTFILIALE_STATE = ''; // N/A

    public const PATH_WEIGHT = 'details/weight/value';
    public const PATH_INSURED_VALUE = 'services/additionalInsurance/value';
    public const PATH_COD_AMOUNT = 'services/cashOnDelivery/amount/value';
    public const PATH_COD_ADD_FEE = ''; // N/A

    public const PATH_PACKAGE_LENGTH = 'details/dim/length';
    public const PATH_PACKAGE_WIDTH = 'details/dim/width';
    public const PATH_PACKAGE_HEIGHT = 'details/dim/height';

    public const PATH_EXPORT_TYPE = 'customs/exportType';
    public const PATH_EXPORT_PLACE = 'customs/officeOfOrigin';
    public const PATH_EXPORT_FEE = 'customs/postalCharges/value';
    public const PATH_EXPORT_DESCRIPTION = 'customs/exportDescription';
    public const PATH_EXPORT_INCOTERMS = 'customs/shippingConditions';
    public const PATH_EXPORT_INVOICE_NO = 'customs/invoiceNo';
    public const PATH_EXPORT_PERMIT_NO = 'customs/permitNo';
    public const PATH_EXPORT_ATTESTATION_NO = 'customs/attestationNo';
    public const PATH_EXPORT_NOTIFICATION = 'customs/hasElectronicExportNotification';
    public const PATH_EXPORT_ITEM1_QTY = 'customs/items/0/packagedQuantity';
    public const PATH_EXPORT_ITEM1_DESC = 'customs/items/0/itemDescription';
    public const PATH_EXPORT_ITEM1_WEIGHT = 'customs/items/0/itemWeight/value';
    public const PATH_EXPORT_ITEM1_VALUE = 'customs/items/0/itemValue/value';
    public const PATH_EXPORT_ITEM1_HSCODE = 'customs/items/0/hsCode';
    public const PATH_EXPORT_ITEM1_ORIGIN = 'customs/items/0/countryOfOrigin';
    public const PATH_EXPORT_ITEM2_QTY = 'customs/items/1/packagedQuantity';
    public const PATH_EXPORT_ITEM2_DESC = 'customs/items/1/itemDescription';
    public const PATH_EXPORT_ITEM2_WEIGHT = 'customs/items/1/itemWeight/value';
    public const PATH_EXPORT_ITEM2_VALUE = 'customs/items/1/itemValue/value';
    public const PATH_EXPORT_ITEM2_HSCODE = 'customs/items/1/hsCode';
    public const PATH_EXPORT_ITEM2_ORIGIN = 'customs/items/1/countryOfOrigin';

    public const PATH_SERVICE_PREFERRED_DAY = 'services/preferredDay';
    public const PATH_SERVICE_PREFERRED_TIME = ''; // N/A
    public const PATH_SERVICE_PREFERRED_LOCATION = 'services/preferredLocation';
    public const PATH_SERVICE_PREFERRED_NEIGHBOUR = 'services/preferredNeighbour';
    public const PATH_SERVICE_SENDER_REQUIREMENT = 'services/individualSenderRequirement';
    public const PATH_SERVICE_AGECHECK = 'services/visualCheckOfAge';
    public const PATH_SERVICE_GOGREEN = ''; // N/A
    public const PATH_SERVICE_PERISHABLES = ''; // N/A
    public const PATH_SERVICE_PERSONALLY = ''; // N/A
    public const PATH_SERVICE_NO_NEIGHBOUR_DELIVERY = 'services/noNeighbourDelivery';
    public const PATH_SERVICE_NAMES_PERSON_ONLY = 'services/namedPersonOnly';
    public const PATH_SERVICE_RETURN_RECEIPT = ''; // N/A
    public const PATH_SERVICE_PDDP = 'services/postalDeliveryDutyPaid';
    public const PATH_SERVICE_PREMIUM = 'services/premium';
    public const PATH_SERVICE_CDP = 'services/closestDropPoint';
    public const PATH_SERVICE_BULKY_GOODS = 'services/bulkyGoods';
    public const PATH_SERVICE_IDENT_LASTNAME = 'services/identCheck/lastName';
    public const PATH_SERVICE_IDENT_FIRSTNAME = 'services/identCheck/firstName';
    public const PATH_SERVICE_IDENT_DOB = 'services/identCheck/dateOfBirth';
    public const PATH_SERVICE_IDENT_MINAGE = 'services/identCheck/minimumAge';
    public const PATH_SERVICE_ROUTING = 'services/parcelOutletRouting';

    /**
     * @param string $attribute
     * @return string
     */
    public static function get(string $attribute): string
    {
        $map = [
            'mustEncode' => self::PATH_MUST_ENCODE,
            'labelResponseType' => self::PATH_LABEL_RESPONSE_TYPE,
            'groupProfileName' => self::PATH_GROUP_PROFILE_NAME,
            'labelFormat' => self::PATH_LABEL_FORMAT,
            'labelFormatRetoure' => self::PATH_LABEL_FORMAT_RETOURE,
            'combinedPrinting' => self::PATH_COMBINED_PRINTING,

            'sequenceNumber' => self::PATH_SEQUENCE_NUMBER,
            'billingNumber' => self::PATH_ACCOUNT_NUMBER,
            'returnBillingNumber' => self::PATH_RETURN_ACCOUNT_NUMBER,
            'productCode' => self::PATH_PRODUCT,
            'shipDate' => self::PATH_SHIPMENT_DATE,
            'customerReference' => self::PATH_CUSTOMER_REFERENCE,
            'returnReference' => self::PATH_RETURN_REFERENCE,
            'costCentre' => self::PATH_COST_CENTRE,

            'shipperName' => self::PATH_SHIPPER_NAME,
            'shipperNameAddition' => self::PATH_SHIPPER_NAME_ADDITION,
            'shipperCompany' => self::PATH_SHIPPER_COMPANY,
            'shipperEmail' => self::PATH_SHIPPER_EMAIL,
            'shipperPhone' => self::PATH_SHIPPER_PHONE,
            'shipperContactPerson' => self::PATH_SHIPPER_CONTACT_PERSON,
            'shipperCountryCode' => self::PATH_SHIPPER_COUNTRY,
            'shipperState' => self::PATH_SHIPPER_STATE,
            'shipperPostalCode' => self::PATH_SHIPPER_POSTAL_CODE,
            'shipperCity' => self::PATH_SHIPPER_CITY,
            'shipperStreet' => self::PATH_SHIPPER_STREET_NAME,
            'shipperStreetNumber' => self::PATH_SHIPPER_STREET_NUMBER,
            'shipperAddressAddition1' => self::PATH_SHIPPER_ADDRESS_ADD1,
            'shipperAddressAddition2' => self::PATH_SHIPPER_ADDRESS_ADD2,
            'shipperDispatchingInformation' => self::PATH_SHIPPER_DISPATCH_INFO,
            'shipperReference' => self::PATH_SHIPPER_REFERENCE,

            'shipperBankOwner' => self::PATH_SHIPPER_BANK_OWNER,
            'shipperBankName' => self::PATH_SHIPPER_BANK_NAME,
            'shipperBankIban' => self::PATH_SHIPPER_BANK_IBAN,
            'shipperBankBic' => self::PATH_SHIPPER_BANK_BIC,
            'shipperBankReference' => self::PATH_SHIPPER_BANK_REFERENCE,
            'shipperBankNote1' => self::PATH_SHIPPER_BANK_NOTE1,
            'shipperBankNote2' => self::PATH_SHIPPER_BANK_NOTE2,

            'returnName' => self::PATH_RETURN_NAME,
            'returnNameAddition' => self::PATH_RETURN_NAME_ADDITION,
            'returnCompany' => self::PATH_RETURN_COMPANY,
            'returnEmail' => self::PATH_RETURN_EMAIL,
            'returnPhone' => self::PATH_RETURN_PHONE,
            'returnContactPerson' => self::PATH_RETURN_CONTACT_PERSON,
            'returnCountryCode' => self::PATH_RETURN_COUNTRY,
            'returnState' => self::PATH_RETURN_STATE,
            'returnPostalCode' => self::PATH_RETURN_POSTAL_CODE,
            'returnCity' => self::PATH_RETURN_CITY,
            'returnStreet' => self::PATH_RETURN_STREET_NAME,
            'returnStreetNumber' => self::PATH_RETURN_STREET_NUMBER,
            'returnAddressAddition1' => self::PATH_RETURN_ADDRESS_ADD1,
            'returnAddressAddition2' => self::PATH_RETURN_ADDRESS_ADD2,
            'returnDispatchingInformation' => self::PATH_RETURN_DISPATCH_INFO,

            'recipientName' => self::PATH_RECIPIENT_NAME,
            'recipientNameAddition' => self::PATH_RECIPIENT_NAME_ADDITION,
            'recipientCompany' => self::PATH_RECIPIENT_COMPANY,
            'recipientEmail' => self::PATH_RECIPIENT_EMAIL,
            'recipientPhone' => self::PATH_RECIPIENT_PHONE,
            'recipientContactPerson' => self::PATH_RECIPIENT_CONTACT_PERSON,
            'recipientCountryCode' => self::PATH_RECIPIENT_COUNTRY,
            'recipientState' => self::PATH_RECIPIENT_STATE,
            'recipientPostalCode' => self::PATH_RECIPIENT_POSTAL_CODE,
            'recipientCity' => self::PATH_RECIPIENT_CITY,
            'recipientStreet' => self::PATH_RECIPIENT_STREET_NAME,
            'recipientStreetNumber' => self::PATH_RECIPIENT_STREET_NUMBER,
            'recipientAddressAddition1' => self::PATH_RECIPIENT_ADDRESS_ADD1,
            'recipientAddressAddition2' => self::PATH_RECIPIENT_ADDRESS_ADD2,
            'recipientDispatchingInformation' => self::PATH_RECIPIENT_DISPATCH_INFO,
            'recipientNotification' => self::PATH_RECIPIENT_NOTIFICATION,

            'packstationRecipientName' => self::PATH_PACKSTATION_NAME,
            'packstationNumber' => self::PATH_PACKSTATION_NUMBER,
            'packstationPostalCode' => self::PATH_PACKSTATION_POSTAL_CODE,
            'packstationCity' => self::PATH_PACKSTATION_CITY,
            'packstationPostNumber' => self::PATH_PACKSTATION_POST_NUMBER,
            'packstationState' => self::PATH_PACKSTATION_STATE,
            'packstationProvince' => self::PATH_PACKSTATION_PROVINCE,
            'packstationCountry' => self::PATH_PACKSTATION_COUNTRY,
            'packstationCountryCode' => self::PATH_PACKSTATION_COUNTRY_CODE,

            'postfilialRecipientName' => self::PATH_POSTFILIALE_NAME,
            'postfilialNumber' => self::PATH_POSTFILIALE_NUMBER,
            'postfilialPostNumber' => self::PATH_POSTFILIALE_POST_NUMBER,
            'postfilialPostalCode' => self::PATH_POSTFILIALE_POSTAL_CODE,
            'postfilialCity' => self::PATH_POSTFILIALE_CITY,
            'postfilialCountry' => self::PATH_POSTFILIALE_COUNTRY,
            'postfilialCountryCode' => self::PATH_POSTFILIALE_COUNTRY_CODE,
            'postfilialState' => self::PATH_POSTFILIALE_STATE,

            'packageWeight' => self::PATH_WEIGHT,
            'packageValue' => self::PATH_INSURED_VALUE,
            'packageLength' => self::PATH_PACKAGE_LENGTH,
            'packageWidth' => self::PATH_PACKAGE_WIDTH,
            'packageHeight' => self::PATH_PACKAGE_HEIGHT,

            'exportType' => self::PATH_EXPORT_TYPE,
            'placeOfCommital' => self::PATH_EXPORT_PLACE,
            'additionalFee' => self::PATH_EXPORT_FEE,
            'exportTypeDescription' => self::PATH_EXPORT_DESCRIPTION,
            'termsOfTrade' => self::PATH_EXPORT_INCOTERMS,
            'invoiceNumber' => self::PATH_EXPORT_INVOICE_NO,
            'permitNumber' => self::PATH_EXPORT_PERMIT_NO,
            'attestationNumber' => self::PATH_EXPORT_ATTESTATION_NO,
            'electronicExportNotification' => self::PATH_EXPORT_NOTIFICATION,
            'exportItem1Qty' => self::PATH_EXPORT_ITEM1_QTY,
            'exportItem1Desc' => self::PATH_EXPORT_ITEM1_DESC,
            'exportItem1Weight' => self::PATH_EXPORT_ITEM1_WEIGHT,
            'exportItem1Value' => self::PATH_EXPORT_ITEM1_VALUE,
            'exportItem1HsCode' => self::PATH_EXPORT_ITEM1_HSCODE,
            'exportItem1Origin' => self::PATH_EXPORT_ITEM1_ORIGIN,
            'exportItem2Qty' => self::PATH_EXPORT_ITEM2_QTY,
            'exportItem2Desc' => self::PATH_EXPORT_ITEM2_DESC,
            'exportItem2Weight' => self::PATH_EXPORT_ITEM2_WEIGHT,
            'exportItem2Value' => self::PATH_EXPORT_ITEM2_VALUE,
            'exportItem2HsCode' => self::PATH_EXPORT_ITEM2_HSCODE,
            'exportItem2Origin' => self::PATH_EXPORT_ITEM2_ORIGIN,

            'codAmount' => self::PATH_COD_AMOUNT,
            'addCodFee' => self::PATH_COD_ADD_FEE,

            'preferredDay' => self::PATH_SERVICE_PREFERRED_DAY,
            'preferredTime' => self::PATH_SERVICE_PREFERRED_TIME,
            'preferredLocation' => self::PATH_SERVICE_PREFERRED_LOCATION,
            'preferredNeighbour' => self::PATH_SERVICE_PREFERRED_NEIGHBOUR,
            'senderRequirement' => self::PATH_SERVICE_SENDER_REQUIREMENT,
            'visualCheckOfAge' => self::PATH_SERVICE_AGECHECK,
            'goGreen' => self::PATH_SERVICE_GOGREEN,
            'perishables' => self::PATH_SERVICE_PERISHABLES,
            'personally' => self::PATH_SERVICE_PERSONALLY,
            'noNeighbourDelivery' => self::PATH_SERVICE_NO_NEIGHBOUR_DELIVERY,
            'namedPersonOnly' => self::PATH_SERVICE_NAMES_PERSON_ONLY,
            'returnReceipt' => self::PATH_SERVICE_RETURN_RECEIPT,
            'postalDeliveryDutyPaid' => self::PATH_SERVICE_PDDP,
            'premium' => self::PATH_SERVICE_PREMIUM,
            'closestDropPoint' => self::PATH_SERVICE_CDP,
            'bulkyGoods' => self::PATH_SERVICE_BULKY_GOODS,
            'identLastName' => self::PATH_SERVICE_IDENT_LASTNAME,
            'identFirstName' => self::PATH_SERVICE_IDENT_FIRSTNAME,
            'identDob' => self::PATH_SERVICE_IDENT_DOB,
            'identMinAge' => self::PATH_SERVICE_IDENT_MINAGE,
            'parcelOutletRouting' => self::PATH_SERVICE_ROUTING,
        ];

        return $map[$attribute];
    }
}
