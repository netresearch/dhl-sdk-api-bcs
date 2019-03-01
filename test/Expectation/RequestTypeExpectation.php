<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\Expectation;

use PHPUnit\Framework\Assert;

/**
 * Class RequestTypeExpectation
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class RequestTypeExpectation
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

    const XPATH_WEIGHT = './Shipment/ShipmentDetails/ShipmentItem/weightInKG';
    const XPATH_INSURED_VALUE = './Shipment/ShipmentDetails/Service/AdditionalInsurance/@insuranceAmount';

    /**
     * @return string[]
     */
    private static function getXPaths()
    {
        return [
            'printOnlyIfCodeable' => self::XPATH_PRINT_CODEABLE,
            'sequenceNumber' => self::XPATH_SEQUENCE_NUMBER,
            'accountNumber' => self::XPATH_ACCOUNT_NUMBER,
            'returnAccountNumber' => self::XPATH_RETURN_ACCOUNT_NUMBER,
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

            'packageWeight' => self::XPATH_WEIGHT,
            'packageValue' => self::XPATH_INSURED_VALUE,
        ];
    }

    /**
     * @param mixed[] $expected
     * @param string $actual
     */
    public static function assertRequestContentsAvailable(array $requestData, string $requestXml)
    {
        $request = new \SimpleXMLElement($requestXml);
        $request->registerXPathNamespace('SOAP-ENV', 'http://schemas.xmlsoap.org/soap/envelope/');
        $request->registerXPathNamespace('ns1', 'http://dhl.de/webservice/cisbase');
        $request->registerXPathNamespace('ns2', 'http://dhl.de/webservices/businesscustomershipping/3.0');
        $request = $request->xpath('/SOAP-ENV:Envelope/SOAP-ENV:Body/ns2:CreateShipmentOrderRequest')[0];

        $xPaths = self::getXPaths();

        foreach ($requestData as $sequenceNumber => $shipmentOrderData) {
            $shipmentOrder = $request->xpath("./ShipmentOrder[./sequenceNumber = '$sequenceNumber']")[0];
            foreach ($shipmentOrderData as $key => $expectedValue) {
                Assert::assertEquals($expectedValue, (string) $shipmentOrder->xpath($xPaths[$key])[0]);
            }
        }
    }
}
