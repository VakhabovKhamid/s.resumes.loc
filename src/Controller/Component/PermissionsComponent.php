<?php
namespace App\Controller\Component;

use App\Model\Entity\Group;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\I18n\I18n;


/**
 * @author I-Iomer
 * @copyright 2013
 */

class PermissionsComponent extends Component {

    const ROOT_ACO = 'controllers';
    public $Session;

    public $components = array(
        'Acl',
        'Session'
    );

    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        parent::__construct($registry, $config);
        $this->Session = $config['Session'];
    }

    function getAllPermissions() {

        $acoRows = $this->Acl->Aco->find('children', [
                'for' => 1,
                'fields' => ['Acos.id', 'Acos.parent_id', 'Acos.alias'],
            ])
            ->enableHydration(false)
            ->toArray();

        foreach($acoRows as $aco) {

            if (!empty($aco['parent_id']) && $aco['parent_id'] == 1) {
                $aco['parent_id'] = null;
            }
            $acos[$aco['id']] = array(
                'parent_id' => $aco['parent_id'],
                'alias' => $aco['alias'],
                'title' => $aco['alias']
            );
        }

        $result = array();
        foreach($acos as $acoId => $aco) {
            $acoPath = '';
            if (!empty($aco['parent_id'])) {

                //If acos's parent has parent
                if(!empty($acos[$aco['parent_id']]['parent_id'])) {
                    $result[$acos[$acos[$aco['parent_id']]['parent_id']]['alias'] . '.' . $acos[$aco['parent_id']]['alias'] . '.' . $aco['alias']] = array(
                        'id' => $acoId,
                        'title' => $aco['title']
                    );
                } else {
                    $result[$acos[$aco['parent_id']]['alias'] . '.' . $aco['alias']] = array(
                        'id' => $acoId,
                        'title' => $aco['title']
                    );
                }

            } else {
                $result[$aco['alias']] = array(
                    'id' => $acoId,
                    'title' => $aco['title']
                );
            }
        }
        ksort($result);
        return $result;
    }

    function getGroupPermissions($groupId) {

        $aro = $this->Acl->Aro->find('all', array(
                'conditions' => array(
                    'Aros.model' => 'Groups',
                    'Aros.foreign_key' => $groupId,
                ),
            ))
            ->enableHydration(false)
            ->first();

        $permissions = $this->Acl->adapter()->Permission->find('all', array(
                'fields' => array(
                    'Permissions.id',
                    'Permissions._create','Permissions._read','Permissions._update','Permissions._delete',
                    //'Permission._log',
                    'Aco.parent_id','Aco.alias','AcoParent.parent_id','AcoParent.alias','AcoParentParent.alias'
                ),
                'conditions' => array(
                    'Permissions.aro_id' => $aro['id'],
                ),
                'join' => array(
                    array(
                        'table' => 'acos',
                        'alias' => 'Aco',
                        'type' => 'left',
                        'conditions' => 'Permissions.aco_id = Aco.id'
                    ),
                    array(
                        'table' => 'acos',
                        'alias' => 'AcoParent',
                        'type' => 'left',
                        'conditions' => 'AcoParent.id = Aco.parent_id'
                    ),
                    array(
                        'table' => 'acos',
                        'alias' => 'AcoParentParent',
                        'type' => 'left',
                        'conditions' => 'AcoParentParent.id = AcoParent.parent_id'
                    )
                )
            ))
            ->enableHydration(false)
            ->toArray();

        $result = array();

        foreach($permissions as $permission) {
            if (isset($permission['id'])) {
                // Access information
                if ($permission['_create'] == 1 && $permission['_read'] == 1 &&
                    $permission['_update'] == 1 && $permission['_delete'] == 1) {
                    //
                    if(!empty($permission['AcoParent']['parent_id']) && $permission['AcoParentParent']['alias'] != self::ROOT_ACO) {
                        $aclPath = $permission['AcoParentParent']['alias'].'.'.$permission['AcoParent']['alias'].'.'.$permission['Aco']['alias'];
                    }
                    elseif (!empty($permission['Aco']['parent_id'])) {
                        $aclPath = $permission['AcoParent']['alias'].'.'.$permission['Aco']['alias'];
                    } else {
                        $aclPath = $permission['Aco']['alias'];
                    }
                    $result[$aclPath] = false;
                }
            }
        }
        return $result;
    }

    function setAuthGroupPermissions($groupId) {
        $this->Session->delete('Auth.Permissions');
        //
        $result = $this->getGroupPermissions($groupId);
        foreach ($result as $key => $value) {
            $this->Session->write('Auth.Permissions.'.$key, $value);
        }
    }

    public function isGuest(\Cake\Controller\Component\AuthComponent $auth)
    {
        return $auth->user() && $auth->user('group_id') === Group::GROUP_GUESTS;
    }

}

?>