<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Sdk\Paket\Bcs\Test;

/**
 * Fake SOAP client used in tests.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class SoapClientFake extends \SoapClient
{
    /**
     * SoapClientFake constructor.
     *
     * PHPUnit does not pass through the wsdl to the client constructor, need to add it by overriding original one.
     *
     * @param $wsdl
     * @param mixed[]|null $options
     * @throws \SoapFault
     */
    public function __construct($wsdl, array $options = null)
    {
        $wsdl = __DIR__ . '/Provider/_files/bcs-3.1.2/geschaeftskundenversand-api-3.1.2.wsdl';
        parent::__construct($wsdl, $options);
    }
}
