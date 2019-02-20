<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\LabelInterface;
use Dhl\Sdk\Paket\Bcs\Api\LabelServiceInterface;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Psr\Log\LoggerInterface;

/**
 * LabelService
 *
 * @package Dhl\Sdk\Paket\Bcs\Service
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class LabelService implements LabelServiceInterface
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
     * @var CreateShipmentResponseMapper
     */
    private $createShipmentResponseMapper;

    /**
     * @var DeleteShipmentResponseMapper
     */
    private $deleteShipmentResponseMapper;

    /**
     * LabelService constructor.
     *
     * @param \SoapClient $soapClient
     * @param LoggerInterface $logger
     * @param CreateShipmentResponseMapper $createShipmentResponseMapper
     * @param DeleteShipmentResponseMapper $deleteShipmentResponseMapper
     */
    public function __construct(
        \SoapClient $soapClient,
        LoggerInterface $logger,
        CreateShipmentResponseMapper $createShipmentResponseMapper,
        DeleteShipmentResponseMapper $deleteShipmentResponseMapper
    ) {
        $this->soapClient = $soapClient;
        $this->logger = $logger;
        $this->createShipmentResponseMapper = $createShipmentResponseMapper;
        $this->deleteShipmentResponseMapper = $deleteShipmentResponseMapper;
    }


    /**
     * @param \stdClass $createShipmentRequest
     * @param LoggerInterface $logger
     * @param CreateShipmentResponseMapper $responseMapper
     *
     * @return LabelInterface[]
     */
    public function createLabel(
        \stdClass $createShipmentRequest,
        LoggerInterface $logger,
        CreateShipmentResponseMapper $responseMapper
    ): array {
        // TODO: Implement createLabel() method.
        $shipmentResponse = $this->soapClient->__soapCall('createShipmentOrder', [ $createShipmentRequest ]);
        $result = $this->createShipmentResponseMapper->map($shipmentResponse);

        return $result;
    }

    /**
     * @param \stdClass $deleteShipmentRequest
     * @param LoggerInterface $logger
     * @param CreateShipmentResponseMapper $responseMapper
     *
     * @return bool
     */
    public function deleteLabel(
        \stdClass $deleteShipmentRequest,
        LoggerInterface $logger,
        CreateShipmentResponseMapper $responseMapper
    ): bool {
        // TODO: Implement deleteLabel() method.
        $shipmentResponse = $this->soapClient->__soapCall('deleteShipmentOrder', [ $deleteShipmentRequest ]);
        $result = $this->deleteShipmentResponseMapper->map($shipmentResponse);

        return $result;
    }

}
