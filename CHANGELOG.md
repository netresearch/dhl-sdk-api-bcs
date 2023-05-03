# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

### Added

- Connect to DHL REST API.
- Choose a delivery type service (_Premium_, _Economy_, _CDP_).
- Configure shipment order parameters such as paper size (compare PR [#2](https://github.com/netresearch/dhl-sdk-api-bcs/pull/2)).

### Changed

- Update documentation of possible request builder arguments, expose via constants.
- Premium service is now booked via `ShipmentOrderRequestBuilderInterface::setDeliveryType`.
- The method `ShipmentOrderRequestBuilderInterface::setPrintOnlyIfCodeable` per order item
  was removed. Set the `mustEncode` flag via `OrderConfigurationInterface` for the entire
  order instead.

### Removed

- Argument `$addFee` is no longer supported in `ShipmentOrderRequestBuilderInterface::setCodAmount`. 
- Services _PreferredTime_, _ShipmentHandling_, _GoGreen_, _Perishables_, _Personally_ can no longer
  be booked.

## 1.3.0

### Added

- Support for PHP 8

### Removed

- Support for PHP 7.1

## 1.2.0

### Added

- `validateShipment` web service operation.

## 1.1.0

### Changed

- Connect to DHL Business Customer Shipping API version 3.1.2 (previously 3.0).
- Argument type of `$shipmentDate` in `ShipmentOrderRequestBuilderInterface::setShipmentDetails`
  was changed from `\DateTime` to `\DateTimeInterface`.

### Removed

- PHP 7.0 support

## 1.0.1

Bugfix release

### Fixed

- Cast response status code to `int` to prevent type error, contributed by [@YiffyToys](https://github.com/YiffyToys) via [PR #1](https://github.com/netresearch/dhl-sdk-api-bcs/pull/1)

## 1.0.0

Initial release
