<?php
use Migrations\AbstractMigration;

class AddColumnDocumentSeriaNumberToApplicants extends AbstractMigration
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
        $table = $this->table('applicants');
        $table->addColumn('document_seria_number','string',[
            'null'=>'false',
            'limit'=>9,
            'comment'=>'Серия паспорта',
        ]);
        $table->update();
    }
}
