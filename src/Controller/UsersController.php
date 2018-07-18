<?php
namespace App\Controller;

use App\Auth\SmsAuthenticate;
use App\Controller\AppController;
use App\Model\Resource\ShortMessage;
use Cake\Event\Event;

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

    public function loginSms()
    {
        $this->Auth->setConfig('authenticate', ['Sms']);

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                //$this->Auth->setUser($user);
                $this->request->getSession()->write('Auth.User.phone', $this->request->getData('phone'));
                $this->Flash->success(__('A one-time code has been send to you by sms.'));
                return $this->redirect(['action' => 'verify-code']);
            }

            $this->Flash->error(__('Sms code is incorrect'), [
                'key' => 'auth'
            ]);
        }
    }

    public function verifyCode()
    {

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

            $this->Flash->error(__('Verify code is incorrect'), [
                'key' => 'auth'
            ]);
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

        $sms = new ShortMessage();
        $sms->phone = $result->token->phone;
        $sms->text = $token;

        $sendedMessage = $this->ShortMessages->save($sms);

        if($sendedMessage) {
            return $result;
        } else {
            throw new \Exception('Sms not sended');
        }
    }
}
