<?php
use Migrations\AbstractMigration;

class CreateTokens extends AbstractMigration
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
        $table = $this->table('tokens',['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'biginteger', [
            'limit' => 20,
            'null' => false,
            'autoIncrement' => true,
            'signed' => ''
        ]);
        $table->addColumn('token', 'string', [
            'limit' => 10,
            'null' => false,
        ]);
        $table->addColumn('expire', 'datetime', [
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
        ]);
        $table->addColumn('created_by', 'biginteger', [
            'limit' => 20,
            'null' => false,
            'signed' => ''
        ]);

        $table->addIndex(['created_by'])->addForeignKey('created_by','users','id');

        $table->create();
    }
}
