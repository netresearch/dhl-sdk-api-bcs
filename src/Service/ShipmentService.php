<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\LabelInterface;
use Dhl\Sdk\Paket\Bcs\Api\ShipmentServiceInterface;
use Dhl\Sdk\Paket\Bcs\Model\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\CreateShipmentResponseMapper;
use Dhl\Sdk\Paket\Bcs\Model\CreateShipment\RequestType\ShipmentOrderType;
use Dhl\Sdk\Paket\Bcs\Model\DeleteShipment\DeleteShipmentResponseMapper;
use Psr\Log\LoggerInterface;

/**
 * ShipmentService
 *
 * @package Dhl\Sdk\Paket\Bcs\Service
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class ShipmentService implements ShipmentServiceInterface
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
     * ShipmentService constructor.
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
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param \stdClass[]|ShipmentOrderType[] $shipmentOrders
     * @param LoggerInterface $logger
     *
     * @return LabelInterface[]
     */
    public function createShipments(array $shipmentOrders, LoggerInterface $logger): array
    {
        // TODO: Implement createLabel() method.
        $version = new Version('3', '0');
        $createShipmentRequest = new CreateShipmentOrderRequest($version, $shipmentOrders);

        $shipmentResponse = $this->soapClient->__soapCall('createShipmentOrder', [ $createShipmentRequest ]);
        $result = $this->createShipmentResponseMapper->map($shipmentResponse);

        return $result;
    }

    /**
     * This operation cancels earlier created shipments.
     *
     * @param \stdClass $deleteShipmentRequest
     * @param LoggerInterface $logger
     *
     * @return bool
     */
    public function cancelShipments(\stdClass $deleteShipmentRequest, LoggerInterface $logger): bool
    {
        // TODO: Implement deleteLabel() method.
        $shipmentResponse = $this->soapClient->__soapCall('deleteShipmentOrder', [ $deleteShipmentRequest ]);
        $result = $this->deleteShipmentResponseMapper->map($shipmentResponse);

        return $result;
    }
}
