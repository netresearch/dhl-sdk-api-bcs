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
use Dhl\Sdk\Paket\Bcs\Test\Provider\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\NullLogger;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\RequestTypeExpectation as Expectation;

/**
 * Class ShipmentServiceRequestBuilderTest
 *
 * @package Dhl\Sdk\Paket\Bcs\Test
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
                'accountNumber' => '22222222220101',
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
                'shipDate' => date('Y-m-d', $tsShip),
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
        $tsShip = time() + 60 * 60 * 24; // tomorrow;
        $wsdl = __DIR__ . '/../Provider/_files/gvapi-3.0/geschaeftskundenversand-api-3.0.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();
        $requestData = [
            's0' => [
                'sequenceNumber' => 's0',
                'accountNumber' => '22222222220101',
                'productCode' => 'V53PAK',
                'shipDate' => date('Y-m-d', $tsShip),
                'shipperCountry' => 'DE',
                'shipperPostalCode' => '04229',
                'shipperCity' => 'Leipzig',
                'shipperStreet' => 'Nonnenstraße',
                'shipperStreetNumber' => '11d',
                'shipperCompany' => 'Netresearch GmbH & Co.KG',
                'recipientCountry' => 'US',
                'recipientPostalCode' => '89109',
                'recipientCity' => 'Las Vegas',
                'recipientStreet' => 'S Las Vegas Blvd',
                'recipientStreetNumber' => '3131',
                'recipientName' => 'Vince Viva',
                'packageWeight' => 2.4,
            ],
            's1' => [
                'printOnlyIfCodeable' => true,
                'sequenceNumber' => 's1',
                'accountNumber' => '22222222220101',
                'returnAccountNumber' => '22222222220701',
                'productCode' => 'V01PAK',
                'shipDate' => date('Y-m-d', $tsShip),
                'customerReference' => 'Customer Reference',
                'returnReference' => 'Return Shipment Reference',
                'costCentre' => 'Cost Centre XY',
                'shipperCountry' => 'DE',
                'shipperPostalCode' => '04229',
                'shipperCity' => 'Leipzig',
                'shipperStreet' => 'Nonnenstraße',
                'shipperStreetNumber' => '11d',
                'shipperCompany' => 'Netresearch GmbH & Co.KG',
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

                'returnCountry' => 'DE',
                'returnPostalCode'=> '22419',
                'returnCity' => 'Hamburg',
                'returnStreet' => 'Essener Straße',
                'returnStreetNumber' => '89',
                'returnCompany' => 'Returns Center',
                'returnName' => 'Sandy Smith',
                'returnNameAddition' => 'SXO',
                'returnEmail' => 'returns@example.com',
                'returnPhone' => '+49 40 1234567890',
                'returnContactPerson' => 'Steven Smith',
                'returnState' => 'HH',
                'returnDispatchingInformation' => 'dispatch sooner',
                'returnAddressAddition1' => 'add something return',
                'returnAddressAddition2' => 'add more return',

                'recipientCountry' => 'DE',
                'recipientPostalCode' => '53113',
                'recipientCity' => 'Bonn',
                'recipientStreet' => 'Sträßchensweg',
                'recipientStreetNumber' => '2',
                'recipientName' => 'Jane Doe',
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

                'packageWeight' => 1.125,
                'packageValue' => 24.99,
            ]
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
        $requestBuilder->setShipperAccount($requestData['s0']['accountNumber']);
        $requestBuilder->setShipperAddress(
            $requestData['s0']['shipperCountry'],
            $requestData['s0']['shipperPostalCode'],
            $requestData['s0']['shipperCity'],
            $requestData['s0']['shipperStreet'],
            $requestData['s0']['shipperStreetNumber'],
            $requestData['s0']['shipperCompany']
        );
        $requestBuilder->setRecipientAddress(
            $requestData['s0']['recipientCountry'],
            $requestData['s0']['recipientPostalCode'],
            $requestData['s0']['recipientCity'],
            $requestData['s0']['recipientStreet'],
            $requestData['s0']['recipientStreetNumber'],
            $requestData['s0']['recipientName']
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
        $requestBuilder->setShipperAccount($requestData['s0']['accountNumber']);
        $requestBuilder->setShipperAddress(
            $requestData['s0']['shipperCountry'],
            $requestData['s0']['shipperPostalCode'],
            $requestData['s0']['shipperCity'],
            $requestData['s0']['shipperStreet'],
            $requestData['s0']['shipperStreetNumber'],
            $requestData['s0']['shipperCompany']
        );
        $requestBuilder->setRecipientAddress(
            $requestData['s0']['recipientCountry'],
            $requestData['s0']['recipientPostalCode'],
            $requestData['s0']['recipientCity'],
            $requestData['s0']['recipientStreet'],
            $requestData['s0']['recipientStreetNumber'],
            $requestData['s0']['recipientName']
        );
        $requestBuilder->setPackageDetails(
            $requestData['s0']['packageWeight']
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
            $requestData['s1']['accountNumber'],
            $requestData['s1']['returnAccountNumber']
        );
        $requestBuilder->setShipperAddress(
            $requestData['s1']['shipperCountry'],
            $requestData['s1']['shipperPostalCode'],
            $requestData['s1']['shipperCity'],
            $requestData['s1']['shipperStreet'],
            $requestData['s1']['shipperStreetNumber'],
            $requestData['s1']['shipperCompany'],
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
            $requestData['s1']['returnCountry'],
            $requestData['s1']['returnPostalCode'],
            $requestData['s1']['returnCity'],
            $requestData['s1']['returnStreet'],
            $requestData['s1']['returnStreetNumber'],
            $requestData['s1']['returnCompany'],
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
            $requestData['s1']['recipientCountry'],
            $requestData['s1']['recipientPostalCode'],
            $requestData['s1']['recipientCity'],
            $requestData['s1']['recipientStreet'],
            $requestData['s1']['recipientStreetNumber'],
            $requestData['s1']['recipientName'],
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
        $requestBuilder->setPackageDetails(
            $requestData['s1']['packageWeight'],
            $requestData['s1']['packageValue']
        );
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[]= $shipmentOrder;

        $service->createShipments($shipmentOrders);

        $requestXml = $soapClient->__getLastRequest();
        Expectation::assertRequestContentsAvailable($requestData, $requestXml);
    }
}
