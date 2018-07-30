<?php
use Migrations\AbstractMigration;

class CreateGroups extends AbstractMigration
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
        $table = $this->table('groups',['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'biginteger',[
            'autoIncrement' => true,
            'signed' => ''
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => false
        ]);
        $table->create();
    }
}
