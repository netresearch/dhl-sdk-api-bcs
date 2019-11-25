<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\RequestBuilder;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\RequestTypeExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\NullLogger;

/**
 * Class ShipmentServiceRequestBuilderTest
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ShipmentServiceRequestBuilderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return mixed[]
     */
    public function simpleDataProvider()
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow;
        $wsdl = __DIR__ . '/../Provider/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();
        $requestData = [
            's0' => [
                'sequenceNumber' => 's0',
                'billingNumber' => '22222222220101',
                'shipperCountry' => 'DE',
                'shipperPostalCode' => '04229',
                'shipperCity' => 'Leipzig',
                'shipperStreet' => 'Nonnenstraße',
                'shipperStreetNumber' => '11d',
                'shipperCompany' => 'Netresearch GmbH & Co.KG',
                'recipientCountry' => 'DE',
                'recipientPostalCode' => '53113',
                'recipientCity' => 'Bonn',
                'recipientStreet' => 'Charles-de-Gaulle-Straße',
                'recipientStreetNumber' => '20',
                'recipientName' => 'John Doe',
                'productCode' => 'V01PAK',
                'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
                'packageWeight' => 2.4,
            ]
        ];
        // response does not matter really, just to make it not fail
        $responseXml = \file_get_contents(__DIR__ . '/../Provider/_files/createshipment/singleShipmentSuccess.xml');

        return [
            'label request' => [$wsdl, $authStorage, $requestData, $responseXml],
        ];
    }

    /**
     * @return mixed[]
     */
    public function complexDataProvider()
    {
        $tsShip = time() + 60 * 60 * 24; // tomorrow
        $wsdl = __DIR__ . '/../Provider/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();
        $requestData = [
            's0' => [
                'sequenceNumber' => 's0',
                'billingNumber' => '22222222220101',
                'productCode' => 'V53PAK',
                'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
                'shipperCompany' => 'Netresearch GmbH & Co.KG',
                'shipperCountry' => 'DE',
                'shipperPostalCode' => '04229',
                'shipperCity' => 'Leipzig',
                'shipperStreet' => 'Nonnenstraße',
                'shipperStreetNumber' => '11d',
                'recipientCountry' => 'US',
                'recipientPostalCode' => '89109',
                'recipientCity' => 'Las Vegas',
                'recipientStreet' => 'S Las Vegas Blvd',
                'recipientStreetNumber' => '3131',
                'recipientName' => 'Vince Viva',
                'packageWeight' => 2.4,

                'exportType' => 'OTHER',
                'placeOfCommital' => 'Leipzig',
                'additionalFee' => 7.99,
                'exportTypeDescription' => 'Lekker Double Vla',
                'termsOfTrade' => 'DDU',
                'invoiceNumber' => '2121212121',
                'permitNumber' => 'p3rm1t n0.',
                'attestationNumber' => '4tt35t4t10n n0.',
                'electronicExportNotification' => false,
                'exportItem1Qty' => 2,
                'exportItem1Desc' => 'Export Desc 1',
                'exportItem1Weight' => 3.37,
                'exportItem1Value' => 29.99,
                'exportItem1HsCode' => ' 42031000',
                'exportItem1Origin' => 'CN',
                'exportItem2Qty' => 1,
                'exportItem2Desc' => 'Export Desc 2',
                'exportItem2Weight' => 2.22,
                'exportItem2Value' => 35,
                'exportItem2HsCode' => '  62099010',
                'exportItem2Origin' => 'US',
            ],
            's1' => [
                'printOnlyIfCodeable' => true,
                'sequenceNumber' => 's1',
                'billingNumber' => '22222222220101',
                'returnBillingNumber' => '22222222220701',
                'productCode' => 'V01PAK',
                'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
                'customerReference' => 'Customer Reference',
                'returnReference' => 'Return Shipment Reference',
                'costCentre' => 'Cost Centre XY',
                'shipperCompany' => 'Netresearch GmbH & Co.KG',
                'shipperCountry' => 'DE',
                'shipperPostalCode' => '04229',
                'shipperCity' => 'Leipzig',
                'shipperStreet' => 'Nonnenstraße',
                'shipperStreetNumber' => '11d',
                'shipperName' => 'Foo Bar',
                'shipperNameAddition' => 'Sr.',
                'shipperEmail' => 'foo@example.com',
                'shipperPhone' => '+49 341 1234567890',
                'shipperContactPerson' => 'Fox Baz',
                'shipperState' => 'SN',
                'shipperDispatchingInformation' => 'dispatch soon',
                'shipperAddressAddition1' => 'add something',
                'shipperAddressAddition2' => 'add more',
                'shipperBankOwner' => 'Owen Banks',
                'shipperBankName' => 'Wall Institute',
                'shipperBankIban' => 'DEX123',
                'shipperBankBic' => 'DEX987',
                'shipperBankReference' => 'Bank Reference',
                'shipperBankNote1' => 'Bank Note 1',
                'shipperBankNote2' => 'Bank Note 2',

                'returnCompany' => 'Returns Center',
                'returnCountry' => 'DE',
                'returnPostalCode'=> '22419',
                'returnCity' => 'Hamburg',
                'returnStreet' => 'Essener Straße',
                'returnStreetNumber' => '89',
                'returnName' => 'Sandy Smith',
                'returnNameAddition' => 'SXO',
                'returnEmail' => 'returns@example.com',
                'returnPhone' => '+49 40 1234567890',
                'returnContactPerson' => 'Steven Smith',
                'returnState' => 'HH',
                'returnDispatchingInformation' => 'dispatch sooner',
                'returnAddressAddition1' => 'add something return',
                'returnAddressAddition2' => 'add more return',

                'recipientName' => 'Jane Doe',
                'recipientCountry' => 'DE',
                'recipientPostalCode' => '53113',
                'recipientCity' => 'Bonn',
                'recipientStreet' => 'Sträßchensweg',
                'recipientStreetNumber' => '2',
                'recipientNameAddition' => 'XXO',
                'recipientCompany' => 'Organisation AG',
                'recipientEmail' => 'doe@example.org',
                'recipientPhone' => '+49 228 911110',
                'recipientContactPerson' => 'Yılmaz Yılmaz',
                'recipientState' => 'NW',
                'recipientDispatchingInformation' => 'dispatch tomorrow',
                'recipientAddressAddition1' => 'add something ship',
                'recipientAddressAddition2' => 'add more ship',

                'recipientNotification' => 'notify@example.org',

                'packageWeight' => 1.12,
                'packageValue' => 24.99,
                'codAmount' => 29.99,
                'addCodFee' => false,

                'packageLength' => 30,
                'packageWidth' => 20,
                'packageHeight' => 15,

                'preferredDay' => date('Y-m-d', time() + 60 * 60 * 24 * 4),
                'preferredTime' => '12001400',
                'preferredLocation' => 'Mailbox',
                'preferredNeighbour' => 'Mr. Smith',
                'senderRequirement' => 'Do not kick.',
                'visualCheckOfAge' => 'A18',
                'goGreen' => true,
                'perishables' => true,
                'personally' => true,
                'noNeighbourDelivery' => true,
                'namedPersonOnly' => true,
                'returnReceipt' => true,
                'premium' => true,
                'bulkyGoods' => true,
//                'identLastName' => 'Smith',
//                'identFirstName' => 'Sam',
//                'identDob' => '1970-01-01',
//                'identMinAge' => '21',
                'parcelOutletRouting' => 'route@example.com',
            ],
            's2' => [
                'sequenceNumber' => 's2',
                'billingNumber' => '22222222220101',
                'productCode' => 'V53PAK',
                'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
                'shipperReference' => 'Shipper Reference #123',
                'packstationNumber' => '139',
                'packstationPostalCode' => '53113',
                'packstationCity' => 'Bonn',
                'packstationRecipientName' => 'Jane Doe',
                'packstationPostNumber' => '12345678',
                'packstationState' => 'NW',
                'packstationCountry' => 'DE',
                'packageWeight' => 4.5,
            ],
            's3' => [
                'sequenceNumber' => 's3',
                'billingNumber' => '22222222220101',
                'productCode' => 'V53PAK',
                'shipDate' => new \DateTime(date('Y-m-d', $tsShip)),
                'shipperReference' => 'Shipper Reference #123',
                'postfilialRecipientName' => 'Jane Doe',
                'postfilialNumber' => '502',
                'postfilialPostNumber' => '12345678',
                'postfilialPostalCode' => '53113',
                'postfilialCity' => 'Bonn',
                'packageWeight' => 1.2,
            ],
        ];

        // response does not matter really, just to make it not fail
        $responseXml = \file_get_contents(__DIR__ . '/../Provider/_files/createshipment/singleShipmentSuccess.xml');

        return [
            'label request' => [$wsdl, $authStorage, $requestData, $responseXml],
        ];
    }

    /**
     * @test
     * @dataProvider simpleDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param mixed[][] $requestData
     * @param string $responseXml
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createMinimalShipmentRequest(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseXml
    ) {
        $logger = new NullLogger();

        $clientOptions = [
            'trace' => 1,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
            'login' => $authStorage->getApplicationId(),
            'password' => $authStorage->getApplicationToken(),
        ];

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();
        $requestBuilder->setSequenceNumber($requestData['s0']['sequenceNumber']);
        $requestBuilder->setShipperAccount($requestData['s0']['billingNumber']);
        $requestBuilder->setShipperAddress(
            $requestData['s0']['shipperCompany'],
            $requestData['s0']['shipperCountry'],
            $requestData['s0']['shipperPostalCode'],
            $requestData['s0']['shipperCity'],
            $requestData['s0']['shipperStreet'],
            $requestData['s0']['shipperStreetNumber']
        );
        $requestBuilder->setRecipientAddress(
            $requestData['s0']['recipientName'],
            $requestData['s0']['recipientCountry'],
            $requestData['s0']['recipientPostalCode'],
            $requestData['s0']['recipientCity'],
            $requestData['s0']['recipientStreet'],
            $requestData['s0']['recipientStreetNumber']
        );
        $requestBuilder->setShipmentDetails(
            $requestData['s0']['productCode'],
            $requestData['s0']['shipDate']
        );
        $requestBuilder->setPackageDetails(
            $requestData['s0']['packageWeight']
        );
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[]= $shipmentOrder;

        $service->createShipments($shipmentOrders);

        $requestXml = $soapClient->__getLastRequest();
        Expectation::assertRequestContentsAvailable($requestData, $requestXml);
    }

    /**
     * @test
     * @dataProvider complexDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param mixed[][] $requestData
     * @param string $responseXml
     * @throws AuthenticationException
     * @throws ClientException
     * @throws ServerException
     */
    public function createMultiShipmentRequest(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseXml
    ) {
        $logger = new NullLogger();

        $clientOptions = [
            'trace' => 1,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap' => ClassMap::get(),
            'login' => $authStorage->getApplicationId(),
            'password' => $authStorage->getApplicationToken(),
            'cache_wsdl' => WSDL_CACHE_NONE,
        ];

        /** @var \SoapClient|MockObject $soapClient */
        $soapClient = $this->getMockFromWsdl($wsdl, SoapClientFake::class, '', ['__doRequest'], true, $clientOptions);
        $soapClient->expects(self::once())
            ->method('__doRequest')
            ->willReturn($responseXml);
        $serviceFactory = new SoapServiceFactory($soapClient);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();

        // shipment order 1
        $requestBuilder->setSequenceNumber($requestData['s0']['sequenceNumber']);
        $requestBuilder->setShipmentDetails(
            $requestData['s0']['productCode'],
            $requestData['s0']['shipDate']
        );
        $requestBuilder->setShipperAccount($requestData['s0']['billingNumber']);
        $requestBuilder->setShipperAddress(
            $requestData['s0']['shipperCompany'],
            $requestData['s0']['shipperCountry'],
            $requestData['s0']['shipperPostalCode'],
            $requestData['s0']['shipperCity'],
            $requestData['s0']['shipperStreet'],
            $requestData['s0']['shipperStreetNumber']
        );
        $requestBuilder->setRecipientAddress(
            $requestData['s0']['recipientName'],
            $requestData['s0']['recipientCountry'],
            $requestData['s0']['recipientPostalCode'],
            $requestData['s0']['recipientCity'],
            $requestData['s0']['recipientStreet'],
            $requestData['s0']['recipientStreetNumber']
        );
        $requestBuilder->setPackageDetails(
            $requestData['s0']['packageWeight']
        );
        $requestBuilder->setCustomsDetails(
            $requestData['s0']['exportType'],
            $requestData['s0']['placeOfCommital'],
            $requestData['s0']['additionalFee'],
            $requestData['s0']['exportTypeDescription'],
            $requestData['s0']['termsOfTrade'],
            $requestData['s0']['invoiceNumber'],
            $requestData['s0']['permitNumber'],
            $requestData['s0']['attestationNumber'],
            $requestData['s0']['electronicExportNotification']
        );
        $requestBuilder->addExportItem(
            $requestData['s0']['exportItem1Qty'],
            $requestData['s0']['exportItem1Desc'],
            $requestData['s0']['exportItem1Value'],
            $requestData['s0']['exportItem1Weight'],
            $requestData['s0']['exportItem1HsCode'],
            $requestData['s0']['exportItem1Origin']
        );
        $requestBuilder->addExportItem(
            $requestData['s0']['exportItem2Qty'],
            $requestData['s0']['exportItem2Desc'],
            $requestData['s0']['exportItem2Value'],
            $requestData['s0']['exportItem2Weight'],
            $requestData['s0']['exportItem2HsCode'],
            $requestData['s0']['exportItem2Origin']
        );
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[]= $shipmentOrder;

        // shipment order 2
        $requestBuilder->setPrintOnlyIfCodeable($requestData['s1']['printOnlyIfCodeable']);
        $requestBuilder->setSequenceNumber($requestData['s1']['sequenceNumber']);
        $requestBuilder->setShipmentDetails(
            $requestData['s1']['productCode'],
            $requestData['s1']['shipDate'],
            $requestData['s1']['customerReference'],
            $requestData['s1']['returnReference'],
            $requestData['s1']['costCentre']
        );
        $requestBuilder->setShipperAccount(
            $requestData['s1']['billingNumber'],
            $requestData['s1']['returnBillingNumber']
        );
        $requestBuilder->setShipperAddress(
            $requestData['s1']['shipperCompany'],
            $requestData['s1']['shipperCountry'],
            $requestData['s1']['shipperPostalCode'],
            $requestData['s1']['shipperCity'],
            $requestData['s1']['shipperStreet'],
            $requestData['s1']['shipperStreetNumber'],
            $requestData['s1']['shipperName'],
            $requestData['s1']['shipperNameAddition'],
            $requestData['s1']['shipperEmail'],
            $requestData['s1']['shipperPhone'],
            $requestData['s1']['shipperContactPerson'],
            $requestData['s1']['shipperState'],
            $requestData['s1']['shipperDispatchingInformation'],
            [
                $requestData['s1']['shipperAddressAddition1'],
                $requestData['s1']['shipperAddressAddition2'],
            ]
        );
        $requestBuilder->setShipperBankData(
            $requestData['s1']['shipperBankOwner'],
            $requestData['s1']['shipperBankName'],
            $requestData['s1']['shipperBankIban'],
            $requestData['s1']['shipperBankBic'],
            $requestData['s1']['shipperBankReference'],
            [
                $requestData['s1']['shipperBankNote1'],
                $requestData['s1']['shipperBankNote2'],
            ]
        );
        $requestBuilder->setReturnAddress(
            $requestData['s1']['returnCompany'],
            $requestData['s1']['returnCountry'],
            $requestData['s1']['returnPostalCode'],
            $requestData['s1']['returnCity'],
            $requestData['s1']['returnStreet'],
            $requestData['s1']['returnStreetNumber'],
            $requestData['s1']['returnName'],
            $requestData['s1']['returnNameAddition'],
            $requestData['s1']['returnEmail'],
            $requestData['s1']['returnPhone'],
            $requestData['s1']['returnContactPerson'],
            $requestData['s1']['returnState'],
            $requestData['s1']['returnDispatchingInformation'],
            [
                $requestData['s1']['returnAddressAddition1'],
                $requestData['s1']['returnAddressAddition2'],
            ]
        );
        $requestBuilder->setRecipientAddress(
            $requestData['s1']['recipientName'],
            $requestData['s1']['recipientCountry'],
            $requestData['s1']['recipientPostalCode'],
            $requestData['s1']['recipientCity'],
            $requestData['s1']['recipientStreet'],
            $requestData['s1']['recipientStreetNumber'],
            $requestData['s1']['recipientCompany'],
            $requestData['s1']['recipientNameAddition'],
            $requestData['s1']['recipientEmail'],
            $requestData['s1']['recipientPhone'],
            $requestData['s1']['recipientContactPerson'],
            $requestData['s1']['recipientState'],
            $requestData['s1']['recipientDispatchingInformation'],
            [
                $requestData['s1']['recipientAddressAddition1'],
                $requestData['s1']['recipientAddressAddition2'],
            ]
        );
        $requestBuilder->setRecipientNotification($requestData['s1']['recipientNotification']);
        $requestBuilder->setPackageDetails($requestData['s1']['packageWeight']);
        $requestBuilder->setInsuredValue($requestData['s1']['packageValue']);
        $requestBuilder->setCodAmount(
            $requestData['s1']['codAmount'],
            $requestData['s1']['addCodFee']
        );
        $requestBuilder->setPackageDimensions(
            $requestData['s1']['packageWidth'],
            $requestData['s1']['packageLength'],
            $requestData['s1']['packageHeight']
        );
        $requestBuilder->setPreferredDay($requestData['s1']['preferredDay']);
        $requestBuilder->setPreferredTime($requestData['s1']['preferredTime']);
        $requestBuilder->setPreferredLocation($requestData['s1']['preferredLocation']);
        $requestBuilder->setPreferredNeighbour($requestData['s1']['preferredNeighbour']);
        $requestBuilder->setIndividualSenderRequirement($requestData['s1']['senderRequirement']);
        $requestBuilder->setVisualCheckOfAge($requestData['s1']['visualCheckOfAge']);
        $requestBuilder->setGoGreen();
        $requestBuilder->setPerishables();
        $requestBuilder->setPersonally();
        $requestBuilder->setNoNeighbourDelivery();
        $requestBuilder->setNamedPersonOnly();
        $requestBuilder->setReturnReceipt();
        $requestBuilder->setPremium();
        $requestBuilder->setBulkyGoods();
//        $requestBuilder->setIdentCheck(
//            $requestData['s1']['identLastName'],
//            $requestData['s1']['identFirstName'],
//            $requestData['s1']['identDob'],
//            $requestData['s1']['identMinAge']
//        );
        $requestBuilder->setParcelOutletRouting($requestData['s1']['parcelOutletRouting']);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[]= $shipmentOrder;

        // shipment order 3
        $requestBuilder->setSequenceNumber($requestData['s2']['sequenceNumber']);
        $requestBuilder->setShipmentDetails(
            $requestData['s2']['productCode'],
            $requestData['s2']['shipDate']
        );
        $requestBuilder->setShipperAccount($requestData['s2']['billingNumber']);
        $requestBuilder->setShipperReference($requestData['s2']['shipperReference']);
        $requestBuilder->setPackstation(
            $requestData['s2']['packstationRecipientName'],
            $requestData['s2']['packstationNumber'],
            $requestData['s2']['packstationPostalCode'],
            $requestData['s2']['packstationCity'],
            $requestData['s2']['packstationPostNumber'],
            $requestData['s2']['packstationState'],
            $requestData['s2']['packstationCountry']
        );
        $requestBuilder->setPackageDetails($requestData['s2']['packageWeight']);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[]= $shipmentOrder;

        // shipment order 3
        $requestBuilder->setSequenceNumber($requestData['s3']['sequenceNumber']);
        $requestBuilder->setShipmentDetails(
            $requestData['s3']['productCode'],
            $requestData['s3']['shipDate']
        );
        $requestBuilder->setShipperAccount($requestData['s3']['billingNumber']);
        $requestBuilder->setShipperReference($requestData['s3']['shipperReference']);
        $requestBuilder->setPostfiliale(
            $requestData['s3']['postfilialRecipientName'],
            $requestData['s3']['postfilialNumber'],
            $requestData['s3']['postfilialPostNumber'],
            $requestData['s3']['postfilialPostalCode'],
            $requestData['s3']['postfilialCity']
        );
        $requestBuilder->setPackageDetails($requestData['s3']['packageWeight']);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[]= $shipmentOrder;

        $service->createShipments($shipmentOrders);

        $requestXml = $soapClient->__getLastRequest();
        Expectation::assertRequestContentsAvailable($requestData, $requestXml);
    }
}
