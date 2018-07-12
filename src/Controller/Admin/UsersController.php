<?php
namespace App\Controller\Admin;

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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Groups']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups', 'Aros']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'licenses', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Employees']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups', 'licenses', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        $this->Auth->setConfig('authenticate', ['Form']);
        $this->Auth->getEventManager()->off(('Auth.afterIdentify'));

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Your username or password was incorrect.'));
        }
    }

    public function logout() {
        $this->Flash->success(__('Good-Bye'));
        $this->redirect($this->Auth->logout());
    }

    public function loginSms()
    {
        $this->Auth->setConfig('authenticate', ['Sms']);

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
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
