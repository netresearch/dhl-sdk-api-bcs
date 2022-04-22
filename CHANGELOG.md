# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

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
