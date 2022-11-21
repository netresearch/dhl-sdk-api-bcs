<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\RequestBuilder;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\RequestTypeExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\AbstractRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\CrossBorderRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\DomesticServicesRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\DomesticSimpleRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\LockerRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\PostOfficeRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\AuthenticationStorageProvider;
use Dhl\Sdk\Paket\Bcs\Test\SoapClientFake;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class SoapRequestBuilderTest extends TestCase
{
    /**
     * @return mixed[]
     * @throws \Exception
     */
    public function simpleDataProvider(): array
    {
        $wsdl = __DIR__ . '/../Provider/_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $sequenceNumbers = ['s0'];
        $requestData = array_map(
            function (string $sequenceNumber, AbstractRequestData $requestData) {
                $requestData->setSequenceNumber($sequenceNumber);
                return $requestData->get();
            },
            $sequenceNumbers,
            [new DomesticSimpleRequestData()]
        );

        $requestData = array_combine($sequenceNumbers, $requestData);

        // response does not matter really, just to make it not fail
        $responseXml = \file_get_contents(__DIR__ . '/../Provider/_files/createshipment/singleShipmentSuccess.xml');

        return [
            'label request' => [$wsdl, $authStorage, $requestData, $responseXml],
        ];
    }

    /**
     * @return mixed[]
     * @throws \Exception
     */
    public function complexDataProvider(): array
    {
        $wsdl = __DIR__ . '/../Provider/_files/bcs-3.3.2/geschaeftskundenversand-api-3.3.2.wsdl';
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $sequenceNumbers = ['s0', 's1', 's2', 's3'];
        $requestData = array_map(
            function (string $sequenceNumber, AbstractRequestData $requestData) {
                $requestData->setSequenceNumber($sequenceNumber);
                return $requestData->get();
            },
            $sequenceNumbers,
            [
                new CrossBorderRequestData(),
                new DomesticServicesRequestData(),
                new LockerRequestData(),
                new PostOfficeRequestData()
            ]
        );

        $requestData = array_combine($sequenceNumbers, $requestData);

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
     * @throws ServiceException
     */
    public function createMinimalShipmentRequest(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseXml
    ): void {
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
        $shipmentOrders[] = $shipmentOrder;

        $service->createShipments($shipmentOrders);

        $requestXml = $soapClient->__getLastRequest();
        Expectation::assertXmlContentsAvailable($requestData, $requestXml);
    }

    /**
     * @test
     * @dataProvider complexDataProvider
     *
     * @param string $wsdl
     * @param AuthenticationStorageInterface $authStorage
     * @param mixed[][] $requestData
     * @param string $responseXml
     * @throws ServiceException
     */
    public function createMultiShipmentRequest(
        string $wsdl,
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseXml
    ): void {
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
        $shipmentOrders[] = $shipmentOrder;

        // shipment order 2
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
        $requestBuilder->setCodAmount($requestData['s1']['codAmount']);
        $requestBuilder->setPackageDimensions(
            $requestData['s1']['packageWidth'],
            $requestData['s1']['packageLength'],
            $requestData['s1']['packageHeight']
        );
        $requestBuilder->setPreferredDay($requestData['s1']['preferredDay']);
        $requestBuilder->setPreferredLocation($requestData['s1']['preferredLocation']);
        $requestBuilder->setPreferredNeighbour($requestData['s1']['preferredNeighbour']);
        $requestBuilder->setIndividualSenderRequirement($requestData['s1']['senderRequirement']);
        $requestBuilder->setVisualCheckOfAge($requestData['s1']['visualCheckOfAge']);
        if (!empty($requestData['s1']['noNeighbourDelivery'])) {
            $requestBuilder->setNoNeighbourDelivery();
        }
        if (!empty($requestData['s1']['namedPersonOnly'])) {
            $requestBuilder->setNamedPersonOnly();
        }
        if (!empty($requestData['s1']['returnReceipt'])) {
            $requestBuilder->setReturnReceipt();
        }
        if (!empty($requestData['s1']['premium'])) {
            $requestBuilder->setPremium();
        }
        if (!empty($requestData['s1']['bulkyGoods'])) {
            $requestBuilder->setBulkyGoods();
        }
//        $requestBuilder->setIdentCheck(
//            $requestData['s1']['identLastName'],
//            $requestData['s1']['identFirstName'],
//            $requestData['s1']['identDob'],
//            $requestData['s1']['identMinAge']
//        );
        $requestBuilder->setParcelOutletRouting($requestData['s1']['parcelOutletRouting']);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

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
            $requestData['s2']['packstationPostNumber'],
            $requestData['s2']['packstationNumber'],
            $requestData['s2']['packstationCountryCode'],
            $requestData['s2']['packstationPostalCode'],
            $requestData['s2']['packstationCity'],
            $requestData['s2']['packstationState'],
            $requestData['s2']['packstationCountry']
        );
        $requestBuilder->setPackageDetails($requestData['s2']['packageWeight']);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        // shipment order 4
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
            $requestData['s3']['postfilialCountryCode'],
            $requestData['s3']['postfilialPostalCode'],
            $requestData['s3']['postfilialCity'],
            $requestData['s3']['postfilialPostNumber'],
            $requestData['s3']['postfilialState'],
            $requestData['s3']['postfilialCountry']
        );
        $requestBuilder->setPackageDetails($requestData['s3']['packageWeight']);
        $shipmentOrder = $requestBuilder->create();
        $shipmentOrders[] = $shipmentOrder;

        $service->createShipments($shipmentOrders);

        $requestXml = $soapClient->__getLastRequest();
        Expectation::assertXmlContentsAvailable($requestData, $requestXml);
    }
}
