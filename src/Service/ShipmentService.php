<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\OrderConfigurationInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceExceptionFactory;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ServiceConfiguration;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractClient;

class ShipmentService implements ShipmentServiceInterface
{
    /**
     * @var AbstractClient
     */
    private $client;

    /**
     * @var ValidateShipmentResponseMapper
     */
    private $validateShipmentResponseMapper;

    /**
     * @var CreateShipmentResponseMapper
     */
    private $createShipmentResponseMapper;

    /**
     * @var DeleteShipmentResponseMapper
     */
    private $deleteShipmentResponseMapper;

    public function __construct(
        AbstractClient $client,
        ValidateShipmentResponseMapper $validateShipmentResponseMapper,
        CreateShipmentResponseMapper $createShipmentResponseMapper,
        DeleteShipmentResponseMapper $deleteShipmentResponseMapper
    ) {
        $this->client = $client;
        $this->validateShipmentResponseMapper = $validateShipmentResponseMapper;
        $this->createShipmentResponseMapper = $createShipmentResponseMapper;
        $this->deleteShipmentResponseMapper = $deleteShipmentResponseMapper;
    }

    public function getVersion(): string
    {
        try {
            $version = new Version('3', '1');
            $version->setBuild('2');

            $getVersionResponse = $this->client->getVersion($version);
            $version = $getVersionResponse->getVersion();
            $version = [
                $version->getMajorRelease(),
                $version->getMinorRelease(),
                $version->getBuild() ?: '0'
            ];
            return implode('.', $version);
        } catch (AuthenticationErrorException $exception) {
            throw ServiceExceptionFactory::createAuthenticationException($exception);
        } catch (DetailedErrorException $exception) {
            throw ServiceExceptionFactory::createDetailedServiceException($exception);
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }

    public function validateShipments(array $shipmentOrders, OrderConfigurationInterface $configuration = null): array
    {
        try {
            $version = new Version('3', '3');
            $version->setBuild('2');
            $validateShipmentRequest = new ValidateShipmentOrderRequest($version, array_values($shipmentOrders));

            if ($configuration instanceof OrderConfigurationInterface) {
                foreach ($shipmentOrders as $shipmentOrder) {
                    if ($shipmentOrder instanceof ShipmentOrderType && $configuration->mustEncode()) {
                        $shipmentOrder->setPrintOnlyIfCodeable(new ServiceConfiguration(true));
                    }
                }
            }

            $validationResponse = $this->client->validateShipment($validateShipmentRequest);
            return $this->validateShipmentResponseMapper->map($validationResponse);
        } catch (AuthenticationErrorException $exception) {
            throw ServiceExceptionFactory::createAuthenticationException($exception);
        } catch (DetailedErrorException $exception) {
            throw ServiceExceptionFactory::createDetailedServiceException($exception);
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }

    public function createShipments(array $shipmentOrders, OrderConfigurationInterface $configuration = null): array
    {
        try {
            $version = new Version('3', '3');
            $version->setBuild('2');
            $createShipmentRequest = new CreateShipmentOrderRequest($version, array_values($shipmentOrders));
            $createShipmentRequest->setLabelResponseType('B64');

            if ($configuration instanceof OrderConfigurationInterface) {
                foreach ($shipmentOrders as $shipmentOrder) {
                    if ($shipmentOrder instanceof ShipmentOrderType && $configuration->mustEncode()) {
                        $shipmentOrder->setPrintOnlyIfCodeable(new ServiceConfiguration(true));
                    }
                }

                if ($configuration->isCombinedPrinting() !== null) {
                    $createShipmentRequest->setCombinedPrinting($configuration->isCombinedPrinting() ? '1' : '0');
                }

                if ($configuration->getDocFormat() === OrderConfigurationInterface::DOC_FORMAT_ZPL2) {
                    $createShipmentRequest->setLabelResponseType('ZPL2');
                }

                if ($configuration->getProfile()) {
                    $createShipmentRequest->setGroupProfileName($configuration->getProfile());
                }

                if ($configuration->getPrintFormat()) {
                    $createShipmentRequest->setLabelFormat($configuration->getPrintFormat());
                }

                if ($configuration->getPrintFormatReturn()) {
                    $createShipmentRequest->setLabelFormatRetoure($configuration->getPrintFormatReturn());
                }
            }

            $shipmentResponse = $this->client->createShipmentOrder($createShipmentRequest);
            return $this->createShipmentResponseMapper->map($shipmentResponse);
        } catch (AuthenticationErrorException $exception) {
            throw ServiceExceptionFactory::createAuthenticationException($exception);
        } catch (DetailedErrorException $exception) {
            throw ServiceExceptionFactory::createDetailedServiceException($exception);
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }

    public function cancelShipments(
        array $shipmentNumbers,
        string $profile = OrderConfigurationInterface::DEFAULT_PROFILE
    ): array {
        try {
            $version = new Version('3', '3');
            $version->setBuild('2');
            $deleteShipmentRequest = new DeleteShipmentOrderRequest($version, $shipmentNumbers);

            $shipmentResponse = $this->client->deleteShipmentOrder($deleteShipmentRequest);
            return $this->deleteShipmentResponseMapper->map($shipmentResponse);
        } catch (AuthenticationErrorException $exception) {
            throw ServiceExceptionFactory::createAuthenticationException($exception);
        } catch (DetailedErrorException $exception) {
            throw ServiceExceptionFactory::createDetailedServiceException($exception);
        } catch (\Throwable $exception) {
            // Catch all leftovers, e.g. \SoapFault, \Exception, ...
            throw ServiceExceptionFactory::createServiceException($exception);
        }
    }
}
