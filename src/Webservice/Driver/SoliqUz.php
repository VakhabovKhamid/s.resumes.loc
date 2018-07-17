<?php
/**
 * Created by PhpStorm.
 * User: I-Iomer
 * Date: 30.06.2018
 * Time: 17:15
 */

namespace App\Webservice\Driver;

use Cake\Network\Http\Client;
use Cake\Log\Engine\FileLog;
use Muffin\Webservice\AbstractDriver;

class SoliqUz extends AbstractDriver
{
    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $this->client(new Client([
            'host' => 'mv.soliq.uz',
            'port' => '81',
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
                'file' => 'mv.soliq.uz',
                'url' => env('LOG_DEBUG_URL', null),
                'scopes' => false,
                'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
            ]
        );
    }
}