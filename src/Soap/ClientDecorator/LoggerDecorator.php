<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap\ClientDecorator;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Exception\ClientException;
use Dhl\Sdk\Paket\Bcs\Exception\ServerException;
use Dhl\Sdk\Paket\Bcs\Model\Common\StatusInformation;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\ResponseType\CreationState;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\ResponseType\DeletionState;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractClient;
use Dhl\Sdk\Paket\Bcs\Soap\AbstractDecorator;
use Psr\Log\LoggerInterface;

/**
 * LoggerDecorator
 *
 * @package Dhl\Sdk\Paket\Bcs\Soap
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
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

    /**
     * LoggerDecorator constructor.
     * @param AbstractClient $client
     * @param \SoapClient $soapClient
     * @param LoggerInterface $logger
     */
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
     * @return CreateShipmentOrderResponse|DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     */
    private function logCommunication(\Closure $performRequest)
    {
        try {
            /** @var CreateShipmentOrderResponse|DeleteShipmentOrderResponse $response */
            $response = $performRequest();

            // adjust log level on successful responses
            if ($response->getStatus()->getStatusCode() === 2000) {
                // unknown shipment number errors contained in response.
                $logLevel = \Psr\Log\LogLevel::ERROR;
            } elseif ($response->getStatus()->getStatusText() === 'Some Shipments had errors.') {
                // hard validation errors contained in response.
                $logLevel = \Psr\Log\LogLevel::ERROR;
            } elseif ($response->getStatus()->getStatusText() === 'Weak validation error occured.') {
                // weak validation errors contained in response.
                $logLevel = \Psr\Log\LogLevel::WARNING;
            } else {
                $logLevel = \Psr\Log\LogLevel::INFO;
            }

            return $response;
        } catch (AuthenticationException $exception) {
            $logLevel = \Psr\Log\LogLevel::ERROR;

            throw $exception;
        } catch (ServerException $exception) {
            $logLevel = \Psr\Log\LogLevel::ERROR;

            throw $exception;
        } catch (ClientException $exception) {
            $logLevel = \Psr\Log\LogLevel::ERROR;

            throw $exception;
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

            if (isset($exception) && $exception instanceof \Exception) {
                $this->logger->log($logLevel, $exception->getMessage());
            }
        }
    }

    /**
     * Log status information from responses.
     *
     * @param StatusInformation $status
     * @param string $shipmentNumber
     * @param int $sequenceNumber
     */
    private function logStatus(StatusInformation $status, $shipmentNumber = '', $sequenceNumber = 0)
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

    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param CreateShipmentOrderRequest $requestType
     * @return CreateShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     */
    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::createShipmentOrder($requestType);
        };

        /** @var CreateShipmentOrderResponse $response */
        $response = $this->logCommunication($performRequest);

        /** @var CreationState $creationState */
        foreach ($response->getCreationState() as $creationState) {
            $this->logStatus($creationState->getLabelData()->getStatus(), $creationState->getShipmentNumber());
        }

        return $response;
    }

    /**
     * Cancel earlier created shipments. Cancellation is only possible before the end-of-the-day manifest.
     *
     * @param DeleteShipmentOrderRequest $requestType
     * @return DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws ServerException
     * @throws ClientException
     */
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
