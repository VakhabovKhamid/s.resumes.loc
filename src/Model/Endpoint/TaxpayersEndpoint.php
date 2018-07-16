<?php
/**
 * Created by PhpStorm.
 * User: I-Iomer
 * Date: 30.06.2018
 * Time: 17:24
 */

namespace App\Model\Endpoint;

use Muffin\Webservice\Model\Endpoint;

class TaxpayersEndpoint extends Endpoint
{
    /**
     * Get the default connection name.
     *
     * This method is used to get the fallback connection name if an
     * instance is created through the EndpointRegistry without a connection.
     *
     * @return string
     *
     * @see \Muffin\Webservice\Model\EndpointRegistry::get()
     */
    public static function defaultConnectionName()
    {
        return 'soliquz';
    }
}