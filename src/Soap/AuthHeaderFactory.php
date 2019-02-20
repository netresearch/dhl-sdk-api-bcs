<?php
/**
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\Bcs\Soap;

/**
 * SOAP authentication header factory.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://choosealicense.com/licenses/mit/ The MIT License
 * @link    https://www.netresearch.de/
 */
class AuthHeaderFactory
{
    const WSS_CIS = 'http://dhl.de/webservice/cisbase';

    /**
     * Create SOAP header.
     *
     * @link http://php.net/manual/en/soapclient.soapclient.php#114976
     *
     * @param string $username
     * @param string $password
     *
     * @return \SoapHeader
     */
    public function create(string $username, string $password): \SoapHeader
    {
        $auth = new \stdClass();

        $auth->user = new \SoapVar(
            $username,
            XSD_STRING,
            '',
            self::WSS_CIS,
            '',
            self::WSS_CIS
        );

        $auth->signature = new \SoapVar(
            $password,
            XSD_STRING,
            '',
            self::WSS_CIS,
            '',
            self::WSS_CIS
        );

        $authenticationVar = new \SoapVar(
            $auth,
            SOAP_ENC_OBJECT,
            '',
            self::WSS_CIS,
            '',
            self::WSS_CIS
        );

        return new \SoapHeader(self::WSS_CIS, 'Authentification', $authenticationVar);
    }
}
