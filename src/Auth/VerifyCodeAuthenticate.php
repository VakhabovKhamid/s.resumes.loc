<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 09.07.18
 * Time: 9:47
 */

namespace App\Auth;


use App\Model\Entity\Group;
use App\Model\Entity\Token;
use Cake\Auth\FormAuthenticate;
use Cake\Cache\Cache;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Time;
use Cake\Network\Request;
use Cake\Network\Response;

class VerifyCodeAuthenticate extends FormAuthenticate
{
    const VERIFY_CODE_ATTEMPTS_KEY = 'verify_code_attempts';
    const VERIFY_CODE_ATTEMPTS_COUNT = 16;

    protected $_defaultConfig = [
        'token' => [
            'parameter' => 'token',
            'detector' => 'token',
            'length' => 10,
            'expires' => '+10 mins',
            'finder' => null,
            'factory' => null,
        ],
        'fields' => [
            'username' => 'phone',
            'token' => 'token',
            'expires' => 'expire',
            'role' => 'group_id',
            'creator' => 'created_by'
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
        if (!in_array('token', array_keys($request->getData()))) {
            return false;
        }

        $token = $request->getData('token');
        $phone = $request->getSession()->read('Auth.User.phone');
        return $this->_findUserByToken($token, $phone);
    }

    protected function _findUserByToken($token, $phone)
    {
        $phone = preg_replace('/[^0-9]+/', '', $phone);
        $config = $this->_config;
        $tokensTable = $this->getTableLocator()->get($config['tokenModel']);
        $usersTable = $this->getTableLocator()->get($config['userModel']);
        $token = $tokensTable->find()->where(['token'=>$token, 'phone'=>$phone])->first();

        if (!$token) {
            return false;
        }

        $userId = $token->user_id;
        $this->regenerateToken($token, $tokensTable);

        $user = $usersTable->find()->where(['Users.id'=>$userId])->first();

        return $user;
    }

    private function regenerateToken(Token $token, $table)
    {
        $token->token = rand(100000, 999999); //Regenerate token. Prevent user login with old vefiry code.
        $table->save($token);
    }
}