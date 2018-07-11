<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 02.07.18
 * Time: 11:45
 */

namespace App\Model\Behavior;


use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;

class AuditUserBehavior extends Behavior
{
    public function audit(Entity $entity)
    {

        if(!$entity->isNew()) {
            $entity->created_by = $entity->getOriginal('created_by');
            $entity->created = $entity->getOriginal('created');
        }
    }

    public function beforeSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->audit($entity);
    }
}