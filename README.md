# DHL BCS API SDK

The DHL Business Customer Shipping API SDK package offers an interface to the following web services:

- Geschäftskundenversand 3.1.2

## Requirements

### System Requirements

- PHP 7.1+ with SOAP extension

### Package Requirements

- `psr/log`: PSR-3 logger interfaces

### Development Package Requirements

- `phpunit/phpunit`: Testing framework

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

The DHL BCS API SDK supports the following features:

* Validate Shipment
* Create Shipment Order
* Delete Shipment Order

### Authentication

The DHL BCS API requires a two-level authentication (_HTTP Basic Authentication_
and _SOAP Header Authentication_). The API SDK offers an authentication storage
to pass credentials in.

```php
$authStorage = new \Dhl\Sdk\Paket\Bcs\Auth\AuthenticationStorage('appId', 'appToken', 'user', 'signature');
```

### Validate Shipment

Validate shipments for DHL Paket including the relevant shipping documents.

#### Public API

The library's components suitable for consumption comprise

* services:
  * service factory
  * shipment service
  * data transfer object builder
* data transfer objects:
  * authentication storage
  * validation result with status message

#### Usage

```php
$logger = new \Psr\Log\NullLogger();

$serviceFactory = new ServiceFactory();
$service = $serviceFactory->createShipmentService($authStorage, $logger, $sandbox = true);

$requestBuilder = new ShipmentOrderRequestBuilder();
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
$requestBuilder->setShipmentDetails($productCode = 'V01PAK', $shipmentDate = '2019-09-09');
$requestBuilder->setPackageDetails($weightInKg = 2.4);

$shipmentOrder = $requestBuilder->create();
$result = $service->validateShipments([$shipmentOrder]);
```
### Create Shipment Order

Create shipments for DHL Paket including the relevant shipping documents.

#### Public API

The library's components suitable for consumption comprise

* services:
  * service factory
  * shipment service
  * data transfer object builder
* data transfer objects:
  * authentication storage
  * shipment with shipment/tracking number and label(s)

#### Usage

```php
$logger = new \Psr\Log\NullLogger();

$serviceFactory = new ServiceFactory();
$service = $serviceFactory->createShipmentService($authStorage, $logger, $sandbox = true);

$requestBuilder = new ShipmentOrderRequestBuilder();
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
$requestBuilder->setShipmentDetails($productCode = 'V01PAK', $shipmentDate = '2019-09-09');
$requestBuilder->setPackageDetails($weightInKg = 2.4);

$shipmentOrder = $requestBuilder->create();
$shipments = $service->createShipments([$shipmentOrder]);
```

### Delete Shipment Order

Cancel earlier created shipments.

#### Public API

The library's components suitable for consumption comprise of

* services:
  * service factory
  * shipment service
* data transfer objects:
  * authentication storage

#### Usage

```php
$logger = new \Psr\Log\NullLogger();

$serviceFactory = new ServiceFactory();
$service = $serviceFactory->createShipmentService($authStorage, $logger, $sandbox = true);

$shipmentNumber = '222201011234567890';
$cancelled = $service->cancelShipments([$shipmentNumber]);
```
