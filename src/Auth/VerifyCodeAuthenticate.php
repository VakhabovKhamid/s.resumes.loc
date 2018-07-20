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
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\Network\Response;

class VerifyCodeAuthenticate extends FormAuthenticate
{
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
        //$this->setUserRole($token->user_id, $usersTable);

        $user = $usersTable->find()->where(['Users.id'=>$userId])->first();

        return $user;
    }

    private function setUserRole($userId, $table)
    {
        $user = $table->get($userId);
        $user->group_id = Group::GROUP_USERS;
        $user->modified = new \DateTime();
        $table->save($user);
    }

    private function regenerateToken(Token $token, $table)
    {
        $token->token = rand(100000, 999999); //Regenerate token. Prevent user login with old vefiry code.
        $table->save($token);
    }
}