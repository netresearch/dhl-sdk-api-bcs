<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

use Dhl\Sdk\Paket\Bcs\Model\Bcs\Common\Version;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\CreateShipment\CreateShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\DeleteShipment\DeleteShipmentOrderResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\GetVersion\GetVersionResponse;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentOrderRequest;
use Dhl\Sdk\Paket\Bcs\Model\Bcs\ValidateShipment\ValidateShipmentResponse;

class Client extends AbstractClient
{
    /**
     * @var \SoapClient
     */
    private $soapClient;

    public function __construct(\SoapClient $soapClient)
    {
        $this->soapClient = $soapClient;
    }

    /**
     * GetVersion is the operation call used to query the latest version available on the web.
     *
     * @param Version $requestType
     *
     * @return GetVersionResponse
     * @throws \SoapFault
     */
    public function getVersion(Version $requestType): GetVersionResponse
    {
        return $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);
    }

    /**
     * ValidateShipmentOrder is the operation call used to validate shipments before booking label and tracking number.
     *
     * @param ValidateShipmentOrderRequest $requestType
     *
     * @return ValidateShipmentResponse
     * @throws \SoapFault
     */
    public function validateShipment(ValidateShipmentOrderRequest $requestType): ValidateShipmentResponse
    {
        return $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);
    }

    /**
     * CreateShipmentOrder is the operation call used to generate shipments with the relevant DHL Paket labels.
     *
     * @param CreateShipmentOrderRequest $requestType
     *
     * @return CreateShipmentOrderResponse
     * @throws \SoapFault
     */
    public function createShipmentOrder(CreateShipmentOrderRequest $requestType): CreateShipmentOrderResponse
    {
        return $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);
    }

    /**
     * @param DeleteShipmentOrderRequest $requestType
     *
     * @return DeleteShipmentOrderResponse
     * @throws \SoapFault
     */
    public function deleteShipmentOrder(DeleteShipmentOrderRequest $requestType): DeleteShipmentOrderResponse
    {
        return $this->soapClient->__soapCall(__FUNCTION__, [$requestType]);
    }
}
