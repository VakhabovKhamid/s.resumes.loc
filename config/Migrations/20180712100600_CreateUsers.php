<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users',['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'biginteger',[
            'autoIncrement' => true,
            'signed' => ''
        ]);
        $table->addColumn('username', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('group_id', 'biginteger', [
            'null' => false,
            'signed' => ''
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => false,
        ]);
        $table->addIndex([
            'username',
        ], [
            'name' => 'UNIQUE_USERNAME',
            'unique' => true,
        ]);
        $table->addPrimaryKey(['id']);
        $table->create();
    }
}
