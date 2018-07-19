<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 16.07.18
 * Time: 14:32
 */

namespace App\Auth;


use Cake\Auth\BaseAuthenticate;
use Cake\Http\Response;
use Cake\Http\ServerRequest;


class GuestAuthenticate extends BaseAuthenticate
{

    const USERNAME = 'guest';
    const PASSWORD = '!vER#eN3=+^%PuYa#WdJQ4TEA$YRat^Pq?bbb^Yx2g%aUnrf';

    /**
     * Authenticate a user based on the request information.
     *
     * @param \Cake\Http\ServerRequest $request Request to get authentication information from.
     * @param \Cake\Http\Response $response A response object that can have headers added.
     * @return mixed Either false on failure, or an array of user data on success.
     */
    public function authenticate(ServerRequest $request, Response $response)
    {
        $user = $this->_findUser(self::USERNAME, self::PASSWORD);

        if(!$user) {
            return false;
        }

        return $user;
    }
}