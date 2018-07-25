<?php
namespace App\Controller;

use App\Auth\SmsAuthenticate;
use App\Controller\AppController;
use App\Model\Resource\ShortMessage;
use Cake\Cache\Cache;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->modelFactory('Endpoint', ['Muffin\Webservice\Model\EndpointRegistry', 'get']);
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->loadModel('ShortMessages', 'Endpoint');
    }

    public function sendCode()
    {
        if(!$this->request->getSession()->read('Auth.User.phone') ||
            !$this->request->getSession()->read('Auth.User.token')) {
            return $this->redirect(['action' => 'loginSms']);
        }

        $phone = preg_replace('/[^0-9]+/', '', $this->request->getSession()->read('Auth.User.phone'));
        $token = preg_replace('/[^0-9]+/', '', $this->request->getSession()->read('Auth.User.token'));



        $sms = new ShortMessage();
        $sms->phone = $phone;
        $sms->text = $token;

        $sendedMessage = $this->ShortMessages->save($sms);

        if(!$sendedMessage) {
            $this->Flash->error(__('Ошибка отправки короткого кода.'));
        }

        $this->redirect(['action' => 'verifyCode']);

    }

    public function loginSms()
    {
        $this->Auth->setConfig('authenticate', ['Sms']);

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Flash->success(__('A one-time code has been send to you by sms.'));
                return $this->redirect(['action' => 'verify-code']);
            }

            $this->Flash->error(__('Phone is incorrect'));
        }
    }

    public function verifyCode()
    {
        if(!$this->request->getSession()->read('Auth.User.phone')) {
            return $this->redirect(['action'=>'loginSms']);
        }

        $this->Auth->setConfig('authenticate', ['VerifyCode']);
        $this->Auth->getEventManager()->off(('Auth.afterIdentify'));

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->logout();
                $this->Auth->setUser($user);

                $redirectUrl = $this->Users->getRedirectUrlByUserGroup($user);
                return $this->redirect($redirectUrl);
            }

            $this->Flash->error(__('Verify code is incorrect'));
        }
    }

    public function implementedEvents()
    {
        return parent::implementedEvents() + [
                'Auth.afterIdentify' => 'afterIdentify',
            ];
    }

    public function afterIdentify(Event $event, $result, SmsAuthenticate $auth)
    {
        $token = $auth->token($result->token->toArray());

        if(!$token) {
            return false;
        }

        $sms = new ShortMessage();
        $sms->phone = $result->token->phone;
        $sms->text = $token;

        $sendedMessage = $this->ShortMessages->save($sms);

        if($sendedMessage) {
            $this->request->getSession()->write('Auth.User.token', $token);
            return $result;
        } else {
            return false;
        }
    }
}
