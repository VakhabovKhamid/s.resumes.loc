<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Model\Entity\Group;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $components = [
        'Acl' => [
            'className' => 'Acl.Acl'
        ]
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authorize' => [
                'Acl.Actions' => ['actionPath' => 'controllers/']
            ],
            'loginAction' => [
                'plugin' => false,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'plugin' => false,
                'controller' => 'Pages',
                'action' => 'display'
            ],
            'logoutRedirect' => [
                'plugin' => false,
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'prefix' => false
            ],
            'authError' => 'You are not authorized to access that location.',
            'flash' => [
                'element' => 'error'
            ]
        ]);

        $this->loadComponent('Permissions', [
            'Session' => $this->getRequest()->getSession()
        ]);

        $this->loadModel('Users');
    }

    public function beforeFilter(Event $event) {
        $this->Auth->allow(['display', 'login', 'logout', 'changelanguage']);

        $userId = (int) $this->getRequest()->getSession()->read('Auth.User.id');
        if ($userId) {
            //$this->AccessLog->save($this->name . "." . $this->action, $this->request);
            //
            // Write ACL to session
            $userGroupId = $this->Auth->user('group_id');
            $this->Permissions->setAuthGroupPermissions($userGroupId);
        } else {
            //$this->getRequest()->getSession()->write("System.language", Configure::read('System.default.language'));
            $this->getRequest()->getSession()->write("System.language", I18n::getLocale());
        }
        if (!$this->getRequest()->getSession()->check("System.administrators")) {
            // Write idx of all Administrator users
            $administrators = $this->Users->find("list",
                array(
                    'conditions' => array('Users.group_id' => Group::GROUP_ADMINISTRATORS)
                )
            )
                ->hydrate(false)
                ->toArray();

            $this->getRequest()->getSession()->write("System.administrators", $administrators);
        }
        //
        if ($this->getRequest()->getSession()->check('System.language')) {

            $language = $this->getRequest()->getSession()->read('System.language');

            //Configure::write('Config.language', $language);
            I18n::setLocale($language);
        }
    }
}
