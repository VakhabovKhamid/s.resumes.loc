<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\Group;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

class AclController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Permissions', [
            'Session' => $this->getRequest()->getSession()
        ]);
        $this->loadComponent('Utils');
        $this->loadModel('Groups');
        $this->loadModel('Users');
        $this->loadModel('ArosAcos');

        //$this->loadComponent('Auth');
        //$this->Auth->allow();
    }

    public function beforeFilter(Event $event)
    {
        $this->getEventManager()->off($this->Csrf);
    }

    public function setgrouppermissions()
    {
        $this->request->allowMethod('post');
        $group = $this->Groups->newEntity();

        $connection = ConnectionManager::get('default');
        $connection->execute('TRUNCATE TABLE `aros_acos`;');

        $group->id = Group::GROUP_ADMINISTRATORS;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Admin/Acl/index');
        $this->Acl->allow($group, 'controllers/Admin/Acl/setgrouppermissions');
        //
        $data = $this->request->getData(['data']);
        $data = $data['Access'];
        if (isset($data)) {
            foreach ($data as $groupId => $acos) {
                $group->id = $groupId;
                //
                $this->Acl->deny($group, 'controllers');
                foreach ($this->Permissions->getAllPermissions() as $permission => $id) {
                    if ((strpos($permission, '.') > 0) && array_key_exists($permission, $acos)) {
                        $permission = str_replace('.', '/', $permission);
                        $this->Acl->allow($group, 'controllers/' . $permission);
                    } else {
                        $permission = str_replace('.', '/', $permission);
                        $this->Acl->deny($group, 'controllers/' . $permission);
                    }
                }
            }
        }
        //
//        if (isset($this->request->data['Log'])) {
//            foreach ($this->request->data['Log'] as $groupId => $acos) {
//                $group->id = $groupId;
//                //
//                $this->Acl->deny($group, 'controllers', 'log');
//                foreach ($this->Permissions->getAllPermissions() as $permission => $id) {
//                    if ((strpos($permission, '.') > 0) && array_key_exists($permission, $acos)) {
//                        $permission = str_replace('.', '/', $permission);
//                        $this->Acl->allow($group, 'controllers/'.$permission, 'log');
//                    } else {
//                        $permission = str_replace('.', '/', $permission);
//                        $this->Acl->deny($group, 'controllers/'.$permission, 'log');
//                    }
//                }
//            }
//        }
        //
        $this->Flash->success(__('Success'));
        return $this->redirect(array('action' => 'index'));
    }

//    public function statistic() {
//        $this->loadModel('AccessLog');
//        //
//        $download = isset($this->request->data['csv']);
//        unset($this->request->data['csv']);
//        //
//        $conditions['string'] = array(
//        	'AccessLog.aco_alias', 'AccessLog.url', 'AccessLog.request_parameters', 'AccessLog.ip', 'AccessLog.created', 'UserCreated.username',
//        );
//        $conditions['int'] = array(
//        	'AccessLog.id'
//        );
//        //
//        $result = $this->Filter->applyFilter($conditions);
//        //
//        $this->paginate = array_merge($this->paginate, array(
//        	'conditions' => $result['filterData']
//        ));
//        //
//        $this->request->data = $result['filterForm'];
//        $this->set('filter', base64_encode($result['filterStr']));
//        //
//        $this->AccessLog->recursive = 0;
//        if ($download) {
//            $this->paginate = array_merge($this->paginate, array(
//            	'limit' => 100000
//            ));
//        }
//        $result = $this->Paginator->paginate('AccessLog');
//        //
//        if (!$download) {
//            $this->set('accessLogs', $result);
//        } else {
//            $this->autoRender = false;
//            $tempPath = tempnam(sys_get_temp_dir(), 'report_access') . ".csv";
//            $output = fopen($tempPath, 'w+');
//            fputcsv($output, array('ID', 'User', 'Time', 'IP', 'Alias', 'URL', 'Request parameters'), ";");
//            //fputs($output, "\r\n");
//            foreach ($result as $row) {
//                $add = array(
//                    $row['AccessLog']['id'], $row['UserCreated']['username'], $row['AccessLog']['created'], $row['AccessLog']['ip'],
//                    $row['AccessLog']['aco_alias'], $row['AccessLog']['url'], $row['AccessLog']['request_parameters']
//                );
//                fputcsv($output, $add, ";");
//                //fputs($output, "\r\n");
//            }
//            $this->response->file($tempPath, array('download' => true));
//        }
//    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $users = $this->Users->find('all',
            array(
                'fields' => array('Users.id', 'Users.username', 'Users.group_id'),
                'recursive' => -1
            )
        );
        $users->enableHydration(false);
        $users = $users->toArray();

        $groups = $this->Groups->find('list',
            array(
                'fields' => array('Groups.id', 'Groups.name'),
                'order' => array('Groups.name'),
                'recursive' => -1
            )
        )
            ->toArray();

        foreach ($users as $key => $value) {
            $groupId = (int)$value['group_id'];
            if (isset($groups[$groupId]) && !is_array($groups[$groupId])) {
                $groups[$groupId] = array(
                    'name' => $groups[$groupId]
                );
                $groups[$groupId]['Permissions'] = $this->Permissions->getGroupPermissions($groupId);
            }
            $groups[$groupId]['Users'][$value['id']] = $value['username'];
        }
        $allAcos = $this->Permissions->getAllPermissions();

        $allAcosNames = array();
        foreach ($allAcos as $key => $value) {
            $allAcosNames[$key] = $value['id'];
        }
        $allAcosMenu = $this->Utils->explodeTree($allAcosNames,'.');
        $this->set(compact('groups', 'users', 'allAcos', 'allAcosMenu'));
    }
}
