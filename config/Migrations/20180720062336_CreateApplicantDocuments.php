<?php
use Migrations\AbstractMigration;

class CreateApplicantDocuments extends AbstractMigration
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
        $table = $this->table('applicant_documents',['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'biginteger', [
            'signed'=>'',
            'null'=>false,
            'autoIncrement'=>true,
            'limit'=>20,
            'comment'=>'Уникальный идентификатор'
        ]);
        $table->addColumn('applicant_id', 'biginteger', [
            'signed'=>'',
            'null'=>false,
            'limit'=>20,
            'comment'=>'Идентификатор реестра "Соискатели"'
        ]);
        $table->addColumn('anchor','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Группировка файлов'
        ]);
        $table->addColumn('name','string',[
            'limit'=>120,
            'null'=>false,
            'comment'=>'Наименование при загрузке'
        ]);
        $table->addColumn('path','string',[
            'limit'=>240,
            'null'=>false,
            'comment'=>'Относительный путь до файла'
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => false,
            'comment'=>'Время создания записи'
        ]);
        $table->addColumn('modified', 'datetime', [
            'null' => false,
            'comment'=>'Время обновления записи'
        ]);
        $table->addColumn('created_by', 'biginteger', [
            'limit' => 20,
            'null' => false,
            'signed' => '',
            'comment'=>'Кем создана запись'
        ]);
        $table->addColumn('modified_by', 'biginteger', [
            'limit' => 20,
            'null' => false,
            'signed' => '',
            'comment'=>'Кем обновлена запись',
        ]);
        $table->addIndex(['created_by'])->addForeignKey('created_by','users','id');
        $table->addIndex(['modified_by'])->addForeignKey('modified_by','users','id');
        $table->addIndex(['applicant_id'])->addForeignKey('applicant_id','applicants','id');
        $table->create();
    }
}
