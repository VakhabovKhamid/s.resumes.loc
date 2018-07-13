<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\ORM\Table;

class AddAdminUser extends AbstractMigration
{
    public function up() 
    {
        $groupsTbl = TableRegistry::get('groups');
        $group = $groupsTbl->newEntity();
        $group->id = 1;
        $group->name = 'Administrator';
        $group->created = new Date();
        $group->modified = new Date();

        $usersTbl = TableRegistry::get('users');
        $user = $usersTbl->newEntity();
        $user->id = 1;
        $user->username = 'admin';
        $user->password = '$2y$10$M.bqnHyEtqxPYydliKnXP.o1KCwEWr9M5YSt6aijzcws74Tz.YGmK';
        $user->group_id = 1;
        $user->created = new Date();
        $user->modified = new Date();

        $groupsTbl->save($group);
        $usersTbl->save($user);
    }

    public function down() 
    {
        $groupsTbl = TableRegistry::get('groups');
        $usersTbl = TableRegistry::get('users');
        $usersTbl->deleteAll(['id'=>1]);
        $groupsTbl->deleteAll(['id'=>1]);
    }
}
