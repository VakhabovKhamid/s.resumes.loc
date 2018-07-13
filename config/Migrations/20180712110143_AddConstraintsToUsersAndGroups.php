<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;


class AddConstraintsToUsersAndGroups extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $users = $this->table('users');
        $users->addIndex(['group_id'])->addForeignKey('group_id','groups','id');

        $users->addColumn('created_by','biginteger',[
            'null' => false,
            'signed'=>''
        ]);
        $users->addColumn('modified_by','biginteger',[
            'null' => false,
            'signed'=>''
        ]);
       
        $users->update();

        $groups = $this->table('groups');
        $groups->addColumn('created_by','biginteger',[
            'null' => false,
            'signed'=>''
        ]);
        $groups->addColumn('modified_by','biginteger',[
            'null' => false,
            'signed'=>''
        ]);


        $groups->update();
        
        $updatedAdmin = (TableRegistry::get('users')->query())
            ->update()
            ->set(['created_by'=>1,'modified_by'=>1])
            ->where(['id'=>1])
            ->execute();
        
        $updatedGroup = (TableRegistry::get('groups')->query())
            ->update()
            ->set(['created_by'=>1,'modified_by'=>1])
            ->where(['id'=>1])
            ->execute();
        
        
        // $this->execute("ALTER TABLE users ADD CONSTRAINT FK_users_id_users_created_by FOREIGN KEY(created_by) REFERENCES users(id);");
        // $this->execute("ALTER TABLE users ADD CONSTRAINT FK_users_id_users_modified_by FOREIGN KEY(modified_by) REFERENCES users(id);");

        // $this->execute("ALTER TABLE groups ADD CONSTRAINT FK_users_id_groups_created_by FOREIGN KEY(created_by) REFERENCES users(id);");
        // $this->execute("ALTER TABLE groups ADD CONSTRAINT FK_users_id_groups_modified_by FOREIGN KEY(modified_by) REFERENCES users(id);");

        $users = $this->table('users');
        $users->addIndex(['created_by'])->addForeignKey('created_by', 'users', 'id');
        $users->addIndex(['modified_by'])->addForeignKey('modified_by', 'users', 'id');

        $groups = $this->table('groups');
        $groups->addIndex(['created_by'])->addForeignKey('created_by', 'users', 'id');
        $groups->addIndex(['modified_by'])->addForeignKey('modified_by', 'users', 'id');
        
        $conn = ConnectionManager::get('default');
        $conn->begin();
        $users->update();
        $groups->update();
        $conn->commit();
    }
}