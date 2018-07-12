<?php
/**
 * Created by PhpStorm.
 * User: I-Iomer
 * Date: 09.07.2018
 * Time: 12:10
 */

namespace App\Webservice\Driver;

use Cake\Http\Client;
use Cake\Log\Engine\FileLog;
use Muffin\Webservice\AbstractDriver;

class OperSMS extends AbstractDriver
{
    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $this->client(new Client([
            'host' => '83.69.139.182',
            'port' => '8080',
            'scheme' => 'http'
        ]));
    }

    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = new FileLog(
            [
                'path' => LOGS.DS.'webservice',
                'file' => 'oper.sms',
                'url' => env('LOG_DEBUG_URL', null),
                'scopes' => false,
                'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
            ]
        );
    }
}