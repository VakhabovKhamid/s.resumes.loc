<?php
/**
 * Created by PhpStorm.
 * User: I-Iomer
 * Date: 09.07.2018
 * Time: 12:20
 */

namespace App\Webservice;

use Muffin\Webservice\Query;
use Muffin\Webservice\Webservice\Webservice;
use Muffin\Webservice\Schema;
use Muffin\Webservice\ResultSet;

class ShortMessagesWebservice extends Webservice
{

    const login = 'smartlab';
    const password = 'gQ0ZXRsULexU';

    /**
     * Returns the base URL for this endpoint
     *
     * @return string Base URL
     */
    public function getBaseUrl()
    {
        return '/' . $this->getEndpoint();
    }

    /**
     * {@inheritDoc}
     */
    /**
     * {@inheritDoc}
     */
    protected function _executeCreateQuery(Query $query, array $options = [])
    {
        $values = $query->set();

        if (!isset($values['phone']) || !isset($values['text'])) {
            return false;
        }

        $payload['login'] = ShortMessagesWebservice::login;
        $payload['password'] = ShortMessagesWebservice::password;
        $payload['data'] = '['.json_encode($values).']';

        $response = $this->driver()->client()->post('', $payload, $options);

        if (!$response->isOk()) {
            return false;
        }

        return true;
    }

    public function describe($endpoint)
    {
        return new Schema($endpoint, [
            'phone' => [
                'type' => 'string'
            ],
            'recipient' => [
                'type' => 'string'
            ],
            'text' => [
                'type' => 'string'
            ],
            'date_received' => [
                'type' => 'string'
            ],
            'client_id' => [
                'type' => 'string'
            ],
            'request_id' => [
                'type' => 'string'
            ],
            'message_id' => [
                'type' => 'string'
            ],
            'ip' => [
                'type' => 'string'
            ],
            '_id' => [
                'type' => 'string'
            ]
        ]);
    }
}