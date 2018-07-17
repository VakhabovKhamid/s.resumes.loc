<?php

namespace App\Controller\Api;
use App\Model\Entity\Group;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;
use App\Controller\AppController;

class ApiController extends AppController{
    public function initialize(){

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);

        $this->loadComponent('Auth', [
            'authorize' => [
                'Acl.Actions' => ['actionPath' => 'controllers/']
            ],
            'authenticate' => [
                'Basic' => ['userModel' => 'Users']
            ],
            'unauthorizedRedirect' => false,
            'storage' => 'Memory'
        ]);
            
        // $this->Auth->allow();/* разрешает всем. */
        // $this->loadModel('Users');
        // Передача параметров
        // $this->Auth->config('authenticate',['Basic' => ['userModel' => 'Users']]);
        // $this->loadComponent('Auth',[]);
    }

    public function beforeFilter(Event $event)
    {
        /* Ovverride */
    }
}