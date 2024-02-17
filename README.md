# DHL BCS API SDK

The DHL Business Customer Shipping API SDK package offers an interface to the following web services:

- [Geschäftskundenversand 3.1.2](https://entwickler.dhl.de/group/ep/wsapis/geschaeftskundenversand/current)
- [DHL Parcel DE Shipping 2.1.6](https://developer.dhl.com/api-reference/parcel-de-shipping-post-parcel-germany-v2)

## Requirements

### System Requirements

- PHP 7.2+ with SOAP and JSON extension

### Package Requirements

- `league/openapi-psr7-validator`: Schema validator for JSON request messages
- `netresearch/jsonmapper`: Mapper for deserialization of JSON response messages into PHP objects
- `php-http/discovery`: Discovery service for HTTP client and message factory implementations
- `php-http/httplug`: Pluggable HTTP client abstraction
- `php-http/logger-plugin`: HTTP client logger plugin for HTTPlug
- `psr/http-client`: PSR-18 HTTP client interfaces
- `psr/http-factory`: PSR-7 HTTP message factory interfaces
- `psr/http-message`: PSR-7 HTTP message interfaces
- `psr/log`: PSR-3 logger interfaces

### Virtual Package Requirements

- `psr/http-client-implementation`: Any package that provides a PSR-18 compatible HTTP client
- `psr/http-factory-implementation`: Any package that provides PSR-7 compatible HTTP message factories
- `psr/http-message-implementation`: Any package that provides PSR-7 HTTP messages

### Development Package Requirements

- `nyholm/psr7`: PSR-7 HTTP message factory & message implementation
- `phpunit/phpunit`: Testing framework
- `php-http/mock-client`: HTTPlug mock client implementation
- `phpstan/phpstan`: Static analysis tool
- `squizlabs/php_codesniffer`: Static analysis tool

## Installation

```bash
$ composer require dhl/sdk-api-bcs
```

## Uninstallation

```bash
$ composer remove dhl/sdk-api-bcs
```

## Testing

```bash
$ ./vendor/bin/phpunit -c test/phpunit.xml
```

## Features

The DHL BCS API SDK is able to connect to the legacy _Business Customer Shipping_ SOAP API
as well as its successor, the _Parcel DE Shipping_ REST web service.

While the connection to the REST API includes some shipping services that were introduced
after BCS v3.1.2, both connections share the same high-level functionality:

* Validate Shipment: Validate a shipment order without booking a label
* Create Shipment Order: Book a shipment label
* Delete Shipment Order: Cancel a shipment label

Please note that the _Parcel DE Shipping_ REST API takes different arguments in some cases:

- sandbox credentials and EKP
- countries must be specified as three-letter codes

## Authentication

Both APIs require a two-level authentication to identify application and user.
The API SDK offers an authentication storage to pass credentials in.

```php
// BCS
$authStorage = new \Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage('appId', 'appToken', 'user', 'signature');

// Parcel DE Shipping
$authStorage = new \Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage('', 'apiKey', 'user', 'password');
```

- API user credentials (user and signature/password) are created in the
  [DHL Business Customer Portal](https://geschaeftskunden.dhl.de/)
- SOAP access: application ID and token are created in the [Developer Portal](https://entwickler.dhl.de/)
- REST access: API key is created in the [API Developer Portal](https://developer.dhl.com/user/apps)

## API Selection

By default, the SDK connects to the legacy _Business Customer Shipping_ SOAP API.
In order to switch to the REST web service, pass an additional argument to the
service factory:

```php
$serviceFactory = new \Dhl\Sdk\Paket\Bcs\Service\ServiceFactory(
    \Dhl\Sdk\Paket\Bcs\Api\ServiceFactoryInterface::API_TYPE_REST
);
```

When using the request builder to create outgoing messages, then pass the respective
argument there as well:

```php
$requestBuilder = new \Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder(
    \Dhl\Sdk\Paket\Bcs\Api\ShipmentOrderRequestBuilderInterface::REQUEST_TYPE_REST
);
```

More thorough examples on using service factory and request builder can be found in the
section about [web service operations](#web-service-operations).

## Web Service Operations

### Validate Shipment

Validate shipments for DHL Paket including the relevant shipping documents.

#### Public API

The library's components suitable for consumption comprise

* services:
  * service factory
  * shipment service
  * data transfer object builder
* data transfer objects:
  * [authentication storage](#Authentication)
  * order/label settings
  * validation result with status message

#### Usage

```php
$logger = new \Psr\Log\NullLogger();

$serviceFactory = new \Dhl\Sdk\Paket\Bcs\Service\ServiceFactory();
$service = $serviceFactory->createShipmentService($authStorage, $logger, $sandbox = true);

$requestBuilder = new \Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder();
$requestBuilder->setShipperAccount($billingNumber = '22222222220101');
$requestBuilder->setShipperAddress(
    $company = 'DHL',
    $country = 'DE',
    $postalCode = '53113',
    $city = 'Bonn',
    $street = 'Charles-de-Gaulle-Straße',
    $streetNumber = '20'
);
$requestBuilder->setRecipientAddress(
    $recipientName = 'Jane Doe',
    $recipientCountry = 'DE',
    $recipientPostalCode = '53113',
    $recipientCity = 'Bonn',
    $recipientStreet = 'Sträßchensweg',
    $recipientStreetNumber = '2'
);
$requestBuilder->setShipmentDetails($productCode = 'V01PAK', $shipmentDate = new \DateTime());
$requestBuilder->setPackageDetails($weightInKg = 2.4);

$shipmentOrder = $requestBuilder->create();
$result = $service->validateShipments([$shipmentOrder]);
```
### Create Shipment Order

Create shipments for DHL Paket including the relevant shipping documents. In
addition to the primary shipment data (shipper, consignee, etc.), further
settings can be defined per request via the _order configuration_ object, including
label printing size, profile, and more.

#### Public API

The library's components suitable for consumption comprise

* services:
  * service factory
  * shipment service
  * data transfer object builder
* data transfer objects:
  * [authentication storage](#Authentication)
  * order/label settings
  * shipment with shipment/tracking number and label(s)

#### Usage

```php
$logger = new \Psr\Log\NullLogger();

$serviceFactory = new \Dhl\Sdk\Paket\Bcs\Service\ServiceFactory();
$service = $serviceFactory->createShipmentService($authStorage, $logger, $sandbox = true);

$orderConfiguration = new \Dhl\Sdk\Paket\Bcs\Service\ShipmentService\OrderConfiguration(
    $printOnlyIfCodable = true,
    $combinedPrinting = null,
    $docFormat = \Dhl\Sdk\Paket\Bcs\Api\Data\OrderConfigurationInterface::DOC_FORMAT_PDF,
    $printFormat = \Dhl\Sdk\Paket\Bcs\Api\Data\OrderConfigurationInterface::PRINT_FORMAT_A4
);

$requestBuilder = new \Dhl\Sdk\Paket\Bcs\RequestBuilder\ShipmentOrderRequestBuilder();
$requestBuilder->setShipperAccount($billingNumber = '22222222220101');
$requestBuilder->setShipperAddress(
    $company = 'DHL',
    $country = 'DE',
    $postalCode = '53113',
    $city = 'Bonn',
    $street = 'Charles-de-Gaulle-Straße',
    $streetNumber = '20'
);
$requestBuilder->setRecipientAddress(
    $recipientName = 'Jane Doe',
    $recipientCountry = 'DE',
    $recipientPostalCode = '53113',
    $recipientCity = 'Bonn',
    $recipientStreet = 'Sträßchensweg',
    $recipientStreetNumber = '2'
);
$requestBuilder->setShipmentDetails($productCode = 'V01PAK', $shipmentDate = new \DateTime());
$requestBuilder->setPackageDetails($weightInKg = 2.4);

$shipmentOrder = $requestBuilder->create();
$shipments = $service->createShipments([$shipmentOrder], $orderConfiguration);
```

### Delete Shipment Order

Cancel earlier created shipments.

#### Public API

The library's components suitable for consumption comprise

* services:
  * service factory
  * shipment service
* data transfer objects:
  * authentication storage

#### Usage

```php
$logger = new \Psr\Log\NullLogger();

$serviceFactory = new \Dhl\Sdk\Paket\Bcs\Service\ServiceFactory();
$service = $serviceFactory->createShipmentService($authStorage, $logger, $sandbox = true);

$shipmentNumber = '222201011234567890';
$cancelled = $service->cancelShipments([$shipmentNumber]);
```
