<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 02.07.18
 * Time: 11:11
 */

namespace App\View\Helper;


use Cake\View\Helper;
use App\Model\Entity\Group;
class PermissionsHelper extends Helper
{

    /**
     * @param array $data
     * @return boolean
     */
    public function check(array $data)
    {
        $session = $this->request->getSession();

        if(!isset($data['controller']) || !isset($data['action'])) {
            throw new \BadMethodCallException('Data array controller and action parameters are missing.');
        }

        return $session->check('Auth.Permissions.'.$data['controller'].'.'.$data['action']);
    }

    public function isGuest()
    {
        $session = $this->request->getSession();
        return $session->read('Auth.User.group_id') === Group::GROUP_GUESTS; 
    }

    public function isAuthorized()
    {
        $session = $this->request->getSession();
        return $session->read('Auth.User');    
    }

}