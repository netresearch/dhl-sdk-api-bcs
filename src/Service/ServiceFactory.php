<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Service;

use Dhl\Sdk\Paket\Bcs\Api\Data\AuthenticationStorageInterface;
use Dhl\Sdk\Paket\Bcs\Api\LabelServiceInterface;
use Dhl\Sdk\Paket\Bcs\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\Bcs\Serializer\ClassMap;
use Dhl\Sdk\Paket\Bcs\Soap\AuthHeaderFactory;
use Dhl\Sdk\Paket\Bcs\Soap\SoapServiceFactory;
use Psr\Log\LoggerInterface;

/**
 * Class ServiceFactory
 *
 * @package Dhl\Sdk\Paket\Bcs\Soap
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ServiceFactory implements ServiceFactoryInterface
{
    /**
     * @param AuthenticationStorageInterface $authStorage
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     * @return LabelServiceInterface
     */
    public function createLabelService(
        AuthenticationStorageInterface $authStorage,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): LabelServiceInterface {
        $wsdl = 'https://cig.dhl.de/cig-wsdls/com/dpdhl/wsdl/geschaeftskundenversand-api/3.0/geschaeftskundenversand-api-3.0.wsdl';
        $options = [
            'login'    => $authStorage->getApplicationId(),
            'password' => $authStorage->getApplicationToken(),
            'classmap' => ClassMap::get(),
            'trace'    => true,
            'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
        ];

        if ($sandboxMode) {
            // override wsdl's default service location
            $options['location'] = self::BASE_URL_SANDBOX;
        }

        $soapClient = new \SoapClient($wsdl, $options);
        $soapServiceFactory = new SoapServiceFactory($soapClient);
        $labelService = $soapServiceFactory->createLabelService($authStorage, $logger, $sandboxMode);

        return $labelService;
    }
}
