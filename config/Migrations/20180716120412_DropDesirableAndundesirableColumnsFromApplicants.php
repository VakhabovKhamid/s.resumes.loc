<?php
use Migrations\AbstractMigration;

class DropDesirableAndundesirableColumnsFromApplicants extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $table = $this->table('applicants');
        $table->removeColumn('desirable_countries');
        $table->removeColumn('undesirable_countries');
        $table->update();
    }

    public function down()
    {
        $table = $this->table('applicants');
        $table->addColumn('desirable_countries','json',[
            'null'=>true,
            'default'=>null,
            'comment'=>'Страны желательные к отбытию'
        ]);
        /* JSON */

        $table->addColumn('undesirable_countries','json',[
            'null'=>true,
            'default'=>null,
            'comment'=>'Страны нежелательные к отбытию'
        ]);

        $table->update();
    }
}
