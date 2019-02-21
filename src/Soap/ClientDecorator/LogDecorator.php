<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Exception\AuthenticationException;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentOrderResponse;
use Psr\Log\LoggerInterface;

/**
 * LogDecorator
 *
 * @package Dhl\Sdk\Paket\Bcs\Soap
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class LogDecorator extends AbstractDecorator
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
     * LogDecorator constructor.
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
     * @param \Closure $performRequest
     * @return CreateShipmentOrderResponse|DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws \SoapFault
     */
    private function log(\Closure $performRequest)
    {
        try {
            $logLevel = \Psr\Log\LogLevel::INFO;

            /** @var CreateShipmentOrderResponse|DeleteShipmentOrderResponse $response */
            $response = $performRequest();

            return $response;
        } catch (\SoapFault $fault) {
            $logLevel = \Psr\Log\LogLevel::ERROR;

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
        }
    }

    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param CreateShipmentOrderRequest $requestType
     * @return CreateShipmentOrderResponse
     * @throws AuthenticationException
     * @throws \SoapFault
     */
    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::createShipmentOrder($requestType);
        };

        return $this->log($performRequest);
    }

    /**
     * Cancel earlier created shipments. Cancellation is only possible before the end-of-the-day manifest.
     *
     * @param DeleteShipmentOrderRequest $requestType
     * @return DeleteShipmentOrderResponse
     * @throws AuthenticationException
     * @throws \SoapFault
     */
    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        $performRequest = function () use ($requestType) {
            return parent::deleteShipmentOrder($requestType);
        };

        return $this->log($performRequest);
    }
}
