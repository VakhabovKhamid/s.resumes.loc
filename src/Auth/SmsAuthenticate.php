<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 09.07.18
 * Time: 9:47
 */

namespace App\Auth;


use App\Model\Entity\Group;
use Cake\Auth\FormAuthenticate;
use Cake\Cache\Cache;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

class SmsAuthenticate extends FormAuthenticate
{
    const LAST_SEND_SMS_TIME_KEY = 'last_send_sms_time';
    const SEND_SMS_TIME_EXPIRES = '+2 mins';

    protected $_defaultConfig = [
        'token' => [
            'parameter' => 'token',
            'detector' => 'token',
            'length' => 10,
            'expires' => '+2 mins',
            'finder' => null,
            'factory' => null,
        ],
        'fields' => [
            'username' => 'phone',
            'token' => 'token',
            'expires' => 'expire',
            'role' => 'group_id',
            'creator' => 'user_id'
        ],
        'sms' => [
            'expires' => '+2 mins',
        ],
        'userModel' => 'Users',
        'tokenModel' => 'Tokens',
        'scope' => [],
        'finder' => 'all',
        'contain' => null,
    ];

    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        parent::__construct($registry, $config);

        if (!$this->getConfig('token.factory')) {
            $this->setConfig('token.factory', [$this, '_tokenize']);
        }
    }

    public function authenticate(Request $request, Response $response)
    {
        $phone = $request->getData('phone');

        $phonePattern = '/^\+998 \([0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}$/'; //+998 (99) 000 00 01
        if($phone && !preg_match($phonePattern, $phone)) {
            return false;
        }

        /*if(!$this->canSendSms()) {
            return false;
        }*/

        $request->getSession()->write('Auth.User.phone', $phone);
        //dd($request->getSession()->read('Auth.User'));
        return $this->_findUserByPhone($phone);
    }

    /*private function canSendSms()
    {
        $lastSendTime = Cache::read(self::LAST_SEND_SMS_TIME_KEY);

        if(!$lastSendTime) {
            Cache::write(self::LAST_SEND_SMS_TIME_KEY, new Time(self::SEND_SMS_TIME_EXPIRES));
            return true;
        }

        $now = Time::now();
        if($now->diffInMinutes($lastSendTime, false) === 0) {
            return false;
        }

        return true;
    }*/

    protected function _findUserByPhone($phone)
    {
        $phone = preg_replace('/[^0-9]+/', '', $phone);
        $username = 'user-'.$phone;

        $config = $this->_config;
        $usersTable = $this->getTableLocator()->get($config['userModel']);
        $user = $usersTable->findByUsername($username)->contain('Tokens')->first();

        if (!$user) {
            $userWithToken = $this->_createUserWithToken($phone, $usersTable);
            return $userWithToken;
        }

        return $user;
    }

    private function _createUserWithToken($phone, $usersTable)
    {
        $data = [
            'username' => 'user-'.$phone,
            'group_id' => Group::GROUP_USERS,
            'password' => Security::randomString(10),
            'email' => 'user-'.$phone.'@mail.loc',
            'created' => new \DateTime(),
            'modified' => new \DateTime(),
            'token' => [
                'phone' => $phone,
                'created' => new \DateTime(),
                'token' => rand(100000, 999999),
                'expire' => new \DateTime(),
                'created_by' => 1,
            ]
        ];
        $user = $usersTable->newEntity($data, ['associated' => ['Tokens']]);
        $user->created_by = 1;
        $user->modified_by = 1;

        if($usersTable->save($user)) {
            return $user;
        } else {
            dd($user->getErrors());die;
            return false;
        }
    }

    public function token(array $token)
    {
        return call_user_func($this->getConfig('token.factory'), $token);
    }

    protected function _tokenize(array $token)
    {
        $config = $this->_config;
        $tokensTable = $this->getTableLocator()->get($config['tokenModel']);
        $phone = $token['phone'];
        $token = $tokensTable->findByPhone($phone)->first();

        if(!$token) {
            return false;
        }

        $token->token = rand(100000, 999999);
        $token->expire = new Time($config['token']['expires']);
        $tokensTable->save($token);

        return $token->token;
    }

}