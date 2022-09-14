<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationErrorException;
use Dhl\Sdk\Paket\Bcs\Exception\DetailedErrorException;
use Dhl\Sdk\Paket\Bcs\Model\Common\AbstractResponse;
use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\ResponseType\CreationState;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;
use Dhl\Sdk\Paket\Bcs\Model\GetVersion\GetVersionResponse;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ResponseType\ValidationState;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ValidateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\ValidateShipment\ValidateShipmentResponse;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractClient;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractDecorator;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LoggerDecorator extends AbstractDecorator
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(AbstractClient $client, \SoapClient $soapClient, LoggerInterface $logger)
    {
        $this->soapClient = $soapClient;
        $this->logger = $logger;

        parent::__construct($client);
    }

    /**
     * Log entire webservice requests and responses.
     *
     * @param \Closure $performRequest
     *
     * @return CreateShipmentOrderResponse|DeleteShipmentOrderResponse
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     * @throws \SoapFault
     */
    private function logCommunication(\Closure $performRequest): AbstractResponse
    {
        $logLevel = LogLevel::INFO;

        try {
            /** @var CreateShipmentOrderResponse|DeleteShipmentOrderResponse $response */
            $response = $performRequest();
            if (!$response->getStatus()) {
                return $response;
            }

            // adjust log level on successful responses
            if ($response->getStatus()->getStatusCode() === 2000) {
                // unknown shipment number errors contained in response.
                $logLevel = LogLevel::ERROR;
            } elseif ($response->getStatus()->getStatusText() === 'Some Shipments had errors.') {
                // hard validation errors contained in response.
                $logLevel = LogLevel::ERROR;
            } elseif ($response->getStatus()->getStatusText() === 'Weak validation error occured.') {
                // weak validation errors contained in response.
                $logLevel = LogLevel::WARNING;
            }

            return $response;
        } catch (AuthenticationErrorException | DetailedErrorException | \SoapFault $fault) {
            $logLevel = LogLevel::ERROR;

            throw $fault;
        } finally {
            $lastRequest = sprintf(
                "%s\n%s",
                $this->soapClient->__getLastRequestHeaders(),
                $this->soapClient->__getLastRequest()
            );

            $lastResponse = sprintf(
                "%s\n%s",
                $this->soapClient->__getLastResponseHeaders(),
                $this->soapClient->__getLastResponse()
            );

            $this->logger->log($logLevel, $lastRequest);
            $this->logger->log($logLevel, $lastResponse);

            if (isset($fault)) {
                $this->logger->log($logLevel, $fault->getMessage());
            }
        }
    }

    /**
     * Log status information from responses.
     *
     * @param StatusInformation $status
     * @param string|null $shipmentNumber
     * @param string|null $sequenceNumber
     */
    private function logStatus(StatusInformation $status, $shipmentNumber = '', $sequenceNumber = '0'): void
    {
        $shipmentNumber = $shipmentNumber ?: $sequenceNumber;
        $statusCode = $status->getStatusCode();
        $statusText = $status->getStatusText();
        $statusMessages = array_unique($status->getStatusMessage());
        $logMessage = sprintf(
            'Shipment %s: Status %s (%s) – %s',
            $shipmentNumber,
            $statusCode,
            $statusText,
            implode(' ', $statusMessages)
        );

        if ($statusCode !== 0) {
            $this->logger->error($logMessage);
        } elseif ($statusText === 'Weak validation error occured.') {
            $this->logger->warning($logMessage);
        } else {
            $this->logger->debug($logMessage);
        }
    }

    public function getVersion(Version $requestType): GetVersionResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::getVersion($requestType);
        };

        /** @var GetVersionResponse $response */
        $response = $this->logCommunication($performRequest);

        return $response;
    }

    public function validateShipment(ValidateShipmentOrderRequest $requestType): ValidateShipmentResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::validateShipment($requestType);
        };

        /** @var ValidateShipmentResponse $response */
        $response = $this->logCommunication($performRequest);

        /** @var ValidationState $validationState */
        foreach ($response->getValidationState() as $validationState) {
            $this->logStatus($validationState->getStatus(), '', $validationState->getSequenceNumber());
        }

        return $response;
    }

    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::createShipmentOrder($requestType);
        };

        /** @var CreateShipmentOrderResponse $response */
        $response = $this->logCommunication($performRequest);

        /** @var CreationState $creationState */
        foreach ($response->getCreationState() as $creationState) {
            $this->logStatus(
                $creationState->getLabelData()->getStatus(),
                $creationState->getShipmentNumber(),
                $creationState->getSequenceNumber()
            );
        }

        return $response;
    }

    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::deleteShipmentOrder($requestType);
        };

        /** @var DeleteShipmentOrderResponse $response */
        $response = $this->logCommunication($performRequest);

        /** @var DeletionState $deletionState */
        foreach ($response->getDeletionState() as $deletionState) {
            $this->logStatus($deletionState->getStatus(), $deletionState->getShipmentNumber());
        }

        return $response;
    }
}
