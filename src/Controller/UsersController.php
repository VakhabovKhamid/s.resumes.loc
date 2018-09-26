<?php
namespace App\Controller;

use App\Auth\SmsAuthenticate;
use App\Model\Entity\LocaliseTrait;
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
    use LocaliseTrait;

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

        if (!$this->request->is('bruteForce')) {

            $phone = preg_replace('/[^0-9]+/', '', $this->request->getSession()->read('Auth.User.phone'));
            $token = preg_replace('/[^0-9]+/', '', $this->request->getSession()->read('Auth.User.token'));

            $this->getEventManager()->dispatch(new Event('User.retrySendVerifyCode', $this, [
                'phone' => $phone,
                'token' => $token
            ]));
        } else {
            $this->Flash->error(__('Превышен лимит запросов.'));
        }

        return $this->redirect(['action' => 'verifyCode']);
    }

    public function loginSms()
    {
        if (!$this->Permissions->isGuest($this->Auth)) {
            return $this->redirect(['prefix' => false, 'controller' => 'Pages', 'action' => 'home']);
        }

        $this->Auth->setConfig('authenticate', ['Sms']);

        if ($this->request->is('post')) {
            if (!$this->request->getParam('bruteForce')) {
                $data = $this->request->getData();
                $phone = preg_replace('/[^0-9]/', '', $data['phone']);
                $user = $this->Auth->identify();

                if ($user && strlen($phone) === 12) {
                    $this->Flash->success(__('Одноразовый код был отправлен вам по sms.'), ['key' => 'verifyPage']);

                    return $this->redirect(['action' => 'verify-code']);
                }

                $this->Flash->error(__('Неверный номер телефона.'), ['key' => 'loginSmsPage']);
            }else{
                $this->Flash->error(__('Превышен лимит запросов.'), ['key' => 'loginSmsPage']);
            }
        }
    }

    public function verifyCode()
    {
        if (!$this->Permissions->isGuest($this->Auth)) {
            return $this->redirect(['prefix' => false, 'controller' => 'Pages', 'action' => 'home']);
        }

        if(!$this->request->getSession()->check('Auth.User.phone')) {
            return $this->redirect(['action'=>'loginSms']);
        }

        $this->Auth->setConfig('authenticate', ['VerifyCode']);
        $this->Auth->getEventManager()->off(('Auth.afterIdentify'));

        if ($this->request->is('post')) {
            if (!$this->request->getParam('bruteForce')) {
                $user = $this->Auth->identify();

                if ($user) {
                    $this->Auth->logout();
                    $this->Auth->setUser($user);

                    $redirectUrl = $this->Users->getRedirectUrlByUserGroup($user);
                    return $this->redirect($redirectUrl);
                }

                $this->Flash->error(__('Неверный код.'), ['key' => 'verifyPage']);
            }else{
                $this->Flash->error(__('Превышен лимит запросов.'), ['key' => 'verifyPage']);
            }
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
        $phone = $result->token->phone;

        if(!$token) {
            return false;
        }

        $this->getEventManager()->dispatch(new Event('User.sendVerifyCode', $this, [
            'phone' => $phone,
            'token' => $token
        ]));

        $this->request->getSession()->write('Auth.User.token', $token);
        return $result;
    }

    public function changeLanguage($lang=null)
    {
        $languages = $this->languages;

        if ($lang) {
            $this->setDefaultLocale($lang);
            $user = $this->Auth->user();
            $redirectUrl = $this->Users->getRedirectUrlByUserGroup($user);
            return $this->redirect($redirectUrl);
        }
        $this->set(compact('languages'));
    }
}
