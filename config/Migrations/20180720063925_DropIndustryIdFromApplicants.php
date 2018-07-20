<?php
use Migrations\AbstractMigration;

class DropIndustryIdFromApplicants extends AbstractMigration
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
        $table->dropForeignKey('industry_id')->save();
        $table->removeColumn('industry_id');
        $table->update();
    }

    public function down()
    {
        // $table = $this->table('applicants');
        // if(!$table->hasColumn('industry_id')){
        //     $table->addColumn('industry_id', 'biginteger', [
        //         'null' => false,
        //         'limit' => 20,
        //         'signed' => '',
        //         'comment' => 'Идентификатор справочника "Отрасли"',
        //     ]);
        // }
        // if (!$table->hasForeignKey('industry_id')) {
        //     $table->addIndex(['industry_id'])->addForeignKey('industry_id', 'dictionary_industries', 'id');
        // }
        // $table->update();
    }
}
