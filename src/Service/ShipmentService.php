<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\ServiceExceptionFactory;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ValidateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ValidateShipmentResponseMapper;
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

    public function validateShipments(array $shipmentOrders): array
    {
        try {
            $version = new Version('3', '1');
            $version->setBuild('2');
            $validateShipmentRequest = new ValidateShipmentOrderRequest($version, array_values($shipmentOrders));

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

	public function createShipments(array $shipmentOrders, string $labelFormat = null, string $labelFormatRetoure = null): array {
		try {
			$version = new Version('3', '1');
			$version->setBuild('2');
			$createShipmentRequest = new CreateShipmentOrderRequest($version, array_values($shipmentOrders));
			$createShipmentRequest->setLabelResponseType('B64');

			if ($labelFormat)
				$createShipmentRequest->setLabelFormat($labelFormat);
			if ($labelFormatRetoure)
				$createShipmentRequest->setLabelFormatRetoure($labelFormatRetoure);

			$shipmentResponse = $this->client->createShipmentOrder($createShipmentRequest);

			return $this->createShipmentResponseMapper->map($shipmentResponse);
		}
		catch (AuthenticationErrorException $exception) {
			throw ServiceExceptionFactory::createAuthenticationException($exception);
		}
		catch (DetailedErrorException $exception) {
			throw ServiceExceptionFactory::createDetailedServiceException($exception);
		}
		catch (\Throwable $exception) {
			// Catch all leftovers, e.g. \SoapFault, \Exception, ...
			throw ServiceExceptionFactory::createServiceException($exception);
		}
	}

    public function cancelShipments(array $shipmentNumbers): array
    {
        try {
            $version = new Version('3', '1');
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
