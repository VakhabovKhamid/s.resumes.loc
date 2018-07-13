<?php
/**
 * Created by PhpStorm.
 * User: I-Iomer
 * Date: 09.07.2018
 * Time: 17:22
 */

namespace App\Model\Endpoint;

use Muffin\Webservice\Model\Endpoint;

class ShortMessagesEndpoint extends Endpoint
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
        return 'opersms';
    }
}