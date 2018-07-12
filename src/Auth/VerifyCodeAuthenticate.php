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
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

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
        $config = $this->getConfig();
        if (!in_array($config['token']['detector'], array_keys($request->getData()))) {
            return false;
        }
        $token = $request->getData($config['token']['parameter']);

        if ($finder = $this->getConfig('token.finder')) {
            return call_user_func($finder, $token);
        }
        $this->getConfig('fields.username', $this->getConfig('fields.token'));

        return $this->_findUserByToken($token, $request->getSession()->read('Auth.User.id'));
    }

    protected function _findUser($username, $password = null)
    {
        $username = preg_replace('/[^0-9]+/', '', $username);

        $config = $this->_config;
        $table = TableRegistry::get($config['tokenModel']);
        $result = $table->findByPhone($username);
        //debug($result->get);die;
        if (!$result->first()) {
            $user = $this->_createUser($username);
            return $user->token;
        }

        return $result->first();
    }

    protected function _findUserByToken($token, $userId)
    {
        $config = $this->_config;
        $table = TableRegistry::get($config['tokenModel']);
        $result = $table->find()->where(['token'=>$token, 'user_id'=>$userId])->first();

        if (!$result) {
            return false;
        }

        $userId = $result->user_id;

        $table = TableRegistry::get($config['userModel']);
        $conditions = ['id' => $userId];
        $data = [
            'group_id' => Group::GROUP_USERS, //User group
            'modified' => new \DateTime(),
        ];
        $table->updateAll($data, $conditions);

        $result = $table->find()->contain(['Tokens'])->where(['Users.id'=>$userId])->first();

        return $result;
    }
}