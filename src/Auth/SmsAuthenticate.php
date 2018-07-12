<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 09.07.18
 * Time: 9:47
 */

namespace App\Auth;


use Cake\Auth\FormAuthenticate;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\Date;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\ORM\Locator\TableLocator;
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
        Request::addDetector($this->getConfig('token.detector'), function (Request $request) {
            return (bool)$request->getQuery($this->getConfig('token.parameter'))
                || (bool)$request->getParam($this->getConfig('token.parameter'));
        });
        if (!$this->getConfig('token.factory')) {
            $this->setConfig('token.factory', [$this, '_tokenize']);
        }
    }

    public function authenticate(Request $request, Response $response)
    {
        return $this->_findUser($request->getData()[$this->getConfig('fields.username')]);
    }

    protected function _findUser($username, $password = null)
    {
        $username = preg_replace('/[^0-9]+/', '', $username);

        $config = $this->_config;
        $table = TableRegistry::get($config['tokenModel']);
        $result = $table->findByPhone($username);

        if (!$result->first()) {
            $user = $this->_createUser($username);
            return $user;
        }

        $userId = $result->first()->user_id;
        $table = TableRegistry::get($config['userModel']);
        $result = $table->find()->contain(['Tokens'])->where(['Users.id'=>$userId])->first();

        return $result;
    }

    private function _createUser($username)
    {
        //debug($username);die;
        $config = $this->_config;
        $table = TableRegistry::get($config['userModel']);
        $data = [
            'username' => 'user-'.$username,
            'group_id' => 4, //Guest group
            'password' => Security::randomString(10),
            'email' => 'user-'.$username.'@test.com',
            'created' => new \DateTime(),
            'modified' => new \DateTime(),
            'token' => [
                'phone' => $username,
                'created' => new \DateTime(),
                'token' => Security::randomString(10),
                'expire' => new \DateTime(),
                'created_by' => 1,
            ]
        ];
        $user = $table->newEntity($data, ['associated' => ['Tokens']]);
        $user->created_by = 1;
        $user->modified_by = 1;
//dd($user);die;
        if($table->save($user)) {
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
        $fields = $config['fields'];
        $table = TableRegistry::get($config['tokenModel']);
        $conditions = [$fields['username'] => $token[$fields['username']]];
        $data = [
            $fields['token'] => rand(100000, 999999),
            $fields['expires'] => new Date($config['token']['expires']),
        ];
        $table->updateAll($data, $conditions);
        return $data[$fields['token']];
    }

}