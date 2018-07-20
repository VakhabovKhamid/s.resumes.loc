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
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Date;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

class SmsAuthenticate extends FormAuthenticate
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
            'creator' => 'user_id'
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
        return $this->_findUserByPhone($phone);
    }

    protected function _findUserByPhone($phone)
    {
        $phone = preg_replace('/[^0-9]+/', '', $phone);
        $username = 'user-'.$phone;

        $config = $this->_config;
        $usersTable = $this->getTableLocator()->get($config['userModel']);
        $tokensTable = $this->getTableLocator()->get($config['tokenModel']);
        $user = $usersTable->findByUsername($username)->contain('Tokens')->first();

        if (!$user) {
            $userWithToken = $this->_createUserWithToken($phone, $usersTable);
            return $userWithToken;
        }

        //$user->token = $this->_createToken($user, $phone, $tokensTable);
        //$userWithToken = $usersTable->find()->contain(['Tokens'])->where(['Users.id'=>$user->id])->first();
        //dd($user);
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

    private function _createToken($user, $phone, $table)
    {
        $token = $table->newEntity(
            [
                'user_id' => $user->id,
                'phone' => $phone,
                'created' => new \DateTime(),
                'token' => rand(100000, 999999),
                'expire' => new \DateTime(),
                'created_by' => 1,
            ]
        );
        if($table->save($token)) {
            return $token;
        } else {
            dd($token->getErrors());
        }
    }

    public function token(array $token)
    {
        return call_user_func($this->getConfig('token.factory'), $token);
    }

    protected function _tokenize(array $token)
    {
        $config = $this->_config;
        $fields = $config['fields'];
        $tokensTable = $this->getTableLocator()->get($config['tokenModel']);
        $findBy = 'findBy'.ucfirst($fields['username']);
        $phone = $token[$fields['username']];

        $token = $tokensTable->{$findBy}($phone)->first();

        $token->token = rand(100000, 999999);
        $token->expires = new Date($config['token']['expires']);
        $tokensTable->save($token);

        return $token->token;
    }

}