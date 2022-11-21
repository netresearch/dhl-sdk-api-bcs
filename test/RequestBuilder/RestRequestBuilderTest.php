<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Test\RequestBuilder;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceException;
use Dhl\Sdk\Paket\Bcs\Http\HttpServiceFactory;
use Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder;
use Dhl\Sdk\Paket\Bcs\Test\Expectation\RequestTypeExpectation as Expectation;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\CrossBorderRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\DomesticServicesRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\DomesticSimpleRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\LockerRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Common\PostOfficeRequestData;
use Dhl\Sdk\Paket\Bcs\Test\Provider\Soap\AuthenticationStorageProvider;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class RestRequestBuilderTest extends TestCase
{
    /**
     * @return mixed[]
     * @throws \Exception
     */
    public function simpleDataProvider(): array
    {
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $requestData = [
            (new DomesticSimpleRequestData())->get()
        ];

        // response does not matter really, just to make it not fail
        $responseBody = \file_get_contents(__DIR__ . '/../Provider/_files/createshipment/singleShipmentSuccess.json');

        return [
            'label request' => [$authStorage, $requestData, $responseBody],
        ];
    }

    /**
     * @return mixed[]
     * @throws \Exception
     */
    public function complexDataProvider(): array
    {
        $authStorage = AuthenticationStorageProvider::authSuccess();

        $requestData = [
            (new CrossBorderRequestData())->get(),
            (new DomesticServicesRequestData())->get(),
            (new LockerRequestData())->get(),
            (new PostOfficeRequestData())->get(),
        ];

        // response does not matter really, just to make it not fail
        $responseBody = \file_get_contents(__DIR__ . '/../Provider/_files/createshipment/singleShipmentSuccess.json');

        return [
            'label request' => [$authStorage, $requestData, $responseBody],
        ];
    }

    /**
     * @test
     * @dataProvider simpleDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param mixed[][] $requestData
     * @param string $responseBody
     * @throws ServiceException
     */
    public function createMinimalShipmentRequest(
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseBody
    ): void {
        $httpClient = new Client();
        $logger = new NullLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $labelResponse = $responseFactory
            ->createResponse(200, 'OK')
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($labelResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();
        $requestBuilder->setShipmentDetails(
            $requestData[0]['productCode'],
            $requestData[0]['shipDate']
        );
        $requestBuilder->setShipperAccount($requestData[0]['billingNumber']);
        $requestBuilder->setShipperAddress(
            $requestData[0]['shipperCompany'],
            $requestData[0]['shipperCountry'],
            $requestData[0]['shipperPostalCode'],
            $requestData[0]['shipperCity'],
            $requestData[0]['shipperStreet'],
            $requestData[0]['shipperStreetNumber']
        );
        $requestBuilder->setRecipientAddress(
            $requestData[0]['recipientName'],
            $requestData[0]['recipientCountry'],
            $requestData[0]['recipientPostalCode'],
            $requestData[0]['recipientCity'],
            $requestData[0]['recipientStreet'],
            $requestData[0]['recipientStreetNumber']
        );
        $requestBuilder->setPackageDetails(
            $requestData[0]['packageWeight']
        );
        $shipmentOrder = $requestBuilder->create(ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_REST);
        $shipmentOrders[] = $shipmentOrder;

        $service->createShipments($shipmentOrders);

        $lastRequest = $httpClient->getLastRequest();
        $requestBody = (string) $lastRequest->getBody();

        Expectation::assertJsonContentsAvailable($requestData, $requestBody);
    }

    /**
     * @test
     * @dataProvider complexDataProvider
     *
     * @param AuthenticationStorageInterface $authStorage
     * @param mixed[][] $requestData
     * @param string $responseBody
     * @throws ServiceException
     */
    public function createMultiShipmentRequest(
        AuthenticationStorageInterface $authStorage,
        array $requestData,
        string $responseBody
    ): void {
        $httpClient = new Client();
        $logger = new NullLogger();

        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $labelResponse = $responseFactory
            ->createResponse(200, 'OK')
            ->withBody($streamFactory->createStream($responseBody));

        $httpClient->setDefaultResponse($labelResponse);

        $serviceFactory = new HttpServiceFactory($httpClient, Client::class);
        $service = $serviceFactory->createShipmentService($authStorage, $logger, true);

        $shipmentOrders = [];

        $requestBuilder = new ShipmentOrderRequestBuilder();

        // shipment order 1
        $requestBuilder->setShipmentDetails(
            $requestData[0]['productCode'],
            $requestData[0]['shipDate']
        );
        $requestBuilder->setShipperAccount($requestData[0]['billingNumber']);
        $requestBuilder->setShipperAddress(
            $requestData[0]['shipperCompany'],
            $requestData[0]['shipperCountry'],
            $requestData[0]['shipperPostalCode'],
            $requestData[0]['shipperCity'],
            $requestData[0]['shipperStreet'],
            $requestData[0]['shipperStreetNumber']
        );
        $requestBuilder->setRecipientAddress(
            $requestData[0]['recipientName'],
            $requestData[0]['recipientCountry'],
            $requestData[0]['recipientPostalCode'],
            $requestData[0]['recipientCity'],
            $requestData[0]['recipientStreet'],
            $requestData[0]['recipientStreetNumber']
        );
        $requestBuilder->setPackageDetails(
            $requestData[0]['packageWeight']
        );
        $requestBuilder->setCustomsDetails(
            $requestData[0]['exportType'],
            $requestData[0]['placeOfCommital'],
            $requestData[0]['additionalFee'],
            $requestData[0]['exportTypeDescription'],
            $requestData[0]['termsOfTrade'],
            $requestData[0]['invoiceNumber'],
            $requestData[0]['permitNumber'],
            $requestData[0]['attestationNumber'],
            $requestData[0]['electronicExportNotification']
        );
        $requestBuilder->addExportItem(
            $requestData[0]['exportItem1Qty'],
            $requestData[0]['exportItem1Desc'],
            $requestData[0]['exportItem1Value'],
            $requestData[0]['exportItem1Weight'],
            $requestData[0]['exportItem1HsCode'],
            $requestData[0]['exportItem1Origin']
        );
        $requestBuilder->addExportItem(
            $requestData[0]['exportItem2Qty'],
            $requestData[0]['exportItem2Desc'],
            $requestData[0]['exportItem2Value'],
            $requestData[0]['exportItem2Weight'],
            $requestData[0]['exportItem2HsCode'],
            $requestData[0]['exportItem2Origin']
        );
        $shipmentOrder = $requestBuilder->create(ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_REST);
        $shipmentOrders[] = $shipmentOrder;

        // shipment order 2
        $requestBuilder->setShipmentDetails(
            $requestData[1]['productCode'],
            $requestData[1]['shipDate'],
            $requestData[1]['customerReference'],
            $requestData[1]['returnReference'],
            $requestData[1]['costCentre']
        );
        $requestBuilder->setShipperAccount(
            $requestData[1]['billingNumber'],
            $requestData[1]['returnBillingNumber']
        );
        $requestBuilder->setShipperAddress(
            $requestData[1]['shipperCompany'],
            $requestData[1]['shipperCountry'],
            $requestData[1]['shipperPostalCode'],
            $requestData[1]['shipperCity'],
            $requestData[1]['shipperStreet'],
            $requestData[1]['shipperStreetNumber'],
            $requestData[1]['shipperName'],
            $requestData[1]['shipperNameAddition'],
            $requestData[1]['shipperEmail'],
            $requestData[1]['shipperPhone'],
            $requestData[1]['shipperContactPerson'],
            $requestData[1]['shipperState'],
            $requestData[1]['shipperDispatchingInformation'],
            [
                $requestData[1]['shipperAddressAddition1'],
                $requestData[1]['shipperAddressAddition2'],
            ]
        );
        $requestBuilder->setShipperBankData(
            $requestData[1]['shipperBankOwner'],
            $requestData[1]['shipperBankName'],
            $requestData[1]['shipperBankIban'],
            $requestData[1]['shipperBankBic'],
            $requestData[1]['shipperBankReference'],
            [
                $requestData[1]['shipperBankNote1'],
                $requestData[1]['shipperBankNote2'],
            ]
        );
        $requestBuilder->setReturnAddress(
            $requestData[1]['returnCompany'],
            $requestData[1]['returnCountry'],
            $requestData[1]['returnPostalCode'],
            $requestData[1]['returnCity'],
            $requestData[1]['returnStreet'],
            $requestData[1]['returnStreetNumber'],
            $requestData[1]['returnName'],
            $requestData[1]['returnNameAddition'],
            $requestData[1]['returnEmail'],
            $requestData[1]['returnPhone'],
            $requestData[1]['returnContactPerson'],
            $requestData[1]['returnState'],
            $requestData[1]['returnDispatchingInformation'],
            [
                $requestData[1]['returnAddressAddition1'],
                $requestData[1]['returnAddressAddition2'],
            ]
        );
        $requestBuilder->setRecipientAddress(
            $requestData[1]['recipientName'],
            $requestData[1]['recipientCountry'],
            $requestData[1]['recipientPostalCode'],
            $requestData[1]['recipientCity'],
            $requestData[1]['recipientStreet'],
            $requestData[1]['recipientStreetNumber'],
            $requestData[1]['recipientCompany'],
            $requestData[1]['recipientNameAddition'],
            $requestData[1]['recipientEmail'],
            $requestData[1]['recipientPhone'],
            $requestData[1]['recipientContactPerson'],
            $requestData[1]['recipientState'],
            $requestData[1]['recipientDispatchingInformation'],
            [
                $requestData[1]['recipientAddressAddition1'],
                $requestData[1]['recipientAddressAddition2'],
            ]
        );
        $requestBuilder->setRecipientNotification($requestData[1]['recipientNotification']);
        $requestBuilder->setPackageDetails($requestData[1]['packageWeight']);
        $requestBuilder->setInsuredValue($requestData[1]['packageValue']);
        $requestBuilder->setCodAmount($requestData[1]['codAmount']);
        $requestBuilder->setPackageDimensions(
            $requestData[1]['packageWidth'],
            $requestData[1]['packageLength'],
            $requestData[1]['packageHeight']
        );
        $requestBuilder->setPreferredDay($requestData[1]['preferredDay']);
        $requestBuilder->setPreferredLocation($requestData[1]['preferredLocation']);
        $requestBuilder->setPreferredNeighbour($requestData[1]['preferredNeighbour']);
        $requestBuilder->setIndividualSenderRequirement($requestData[1]['senderRequirement']);
        $requestBuilder->setVisualCheckOfAge($requestData[1]['visualCheckOfAge']);
        if (!empty($requestData[1]['noNeighbourDelivery'])) {
            $requestBuilder->setNoNeighbourDelivery();
        }
        if (!empty($requestData[1]['namedPersonOnly'])) {
            $requestBuilder->setNamedPersonOnly();
        }
        if (!empty($requestData[1]['returnReceipt'])) {
            $requestBuilder->setReturnReceipt();
        }
        if (!empty($requestData[1]['premium'])) {
            $requestBuilder->setPremium();
        }
        if (!empty($requestData[1]['bulkyGoods'])) {
            $requestBuilder->setBulkyGoods();
        }
//        $requestBuilder->setIdentCheck(
//            $requestData[1]['identLastName'],
//            $requestData[1]['identFirstName'],
//            $requestData[1]['identDob'],
//            $requestData[1]['identMinAge']
//        );
        $requestBuilder->setParcelOutletRouting($requestData[1]['parcelOutletRouting']);
        $shipmentOrder = $requestBuilder->create(ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_REST);
        $shipmentOrders[] = $shipmentOrder;

        // shipment order 3
        $requestBuilder->setSequenceNumber($requestData[2]['sequenceNumber']);
        $requestBuilder->setShipmentDetails(
            $requestData[2]['productCode'],
            $requestData[2]['shipDate']
        );
        $requestBuilder->setShipperAccount($requestData[2]['billingNumber']);
        $requestBuilder->setShipperReference($requestData[2]['shipperReference']);
        $requestBuilder->setPackstation(
            $requestData[2]['packstationRecipientName'],
            $requestData[2]['packstationPostNumber'],
            $requestData[2]['packstationNumber'],
            $requestData[2]['packstationCountryCode'],
            $requestData[2]['packstationPostalCode'],
            $requestData[2]['packstationCity'],
            $requestData[2]['packstationState'],
            $requestData[2]['packstationCountry']
        );

        $requestBuilder->setPackageDetails($requestData[2]['packageWeight']);
        $shipmentOrder = $requestBuilder->create(ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_REST);
        $shipmentOrders[] = $shipmentOrder;

        // shipment order 4
        $requestBuilder->setSequenceNumber($requestData[3]['sequenceNumber']);
        $requestBuilder->setShipmentDetails(
            $requestData[3]['productCode'],
            $requestData[3]['shipDate']
        );
        $requestBuilder->setShipperAccount($requestData[3]['billingNumber']);
        $requestBuilder->setShipperReference($requestData[3]['shipperReference']);
        $requestBuilder->setPostfiliale(
            $requestData[3]['postfilialRecipientName'],
            $requestData[3]['postfilialNumber'],
            $requestData[3]['postfilialCountryCode'],
            $requestData[3]['postfilialPostalCode'],
            $requestData[3]['postfilialCity'],
            $requestData[3]['postfilialPostNumber'],
            $requestData[3]['postfilialState'],
            $requestData[3]['postfilialCountry']
        );

        $requestBuilder->setPackageDetails($requestData[3]['packageWeight']);
        $shipmentOrder = $requestBuilder->create(ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_REST);
        $shipmentOrders[] = $shipmentOrder;

        $service->createShipments($shipmentOrders);

        $lastRequest = $httpClient->getLastRequest();
        $requestBody = (string) $lastRequest->getBody();

        // unset values that are not supported at the REST API
        unset($requestData[1]['returnReceipt']);
        unset($requestData[2]['packstationState']);
        unset($requestData[2]['packstationCountry']);
        unset($requestData[3]['postfilialState']);
        unset($requestData[3]['postfilialCountry']);

        Expectation::assertJsonContentsAvailable($requestData, $requestBody);
    }
}
