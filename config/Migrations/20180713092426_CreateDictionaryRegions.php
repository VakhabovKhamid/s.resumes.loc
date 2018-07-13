<?php
use Migrations\AbstractMigration;

class CreateDictionaryRegions extends AbstractMigration
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
        /* dictionary_regions */

        $table = $this->table('dictionary_regions',['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id','biginteger',[
            'signed'=>'',
            'null'=>false,
            'autoIncrement'=>true,
            'limit'=>20,
            'comment'=>'Уникальный идентификатор'
        ]);
        $table->addColumn('name_uz_c','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Наименование на узбекском кириллица'
        ]);
        $table->addColumn('name_uz_l','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Наименование на узбекском латиница',
        ]);
        $table->addColumn('name_ru_c','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Наименование на русском кириллица',
        ]);
        $table->addColumn('name_en_l','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Наименование на английском латиница',
        ]);
        $table->addColumn('name_qr_c','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Наименование на каракалпакском кириллица',
        ]);
        $table->addColumn('name_qr_l','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Наименование на каракалпакском латиница',
        ]);
        $table->addColumn('is_active','string',[
            'limit'=>1,
            'null'=>false,
            'comment'=>'Признак активности записи (Y-да/N-нет)'
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
            'signed' => ''
        ]);
        $table->addColumn('modified_by', 'biginteger', [
            'limit' => 20,
            'null' => false,
            'signed' => ''
        ]);
        $table->addIndex(['created_by'])->addForeignKey('created_by','users','id');
        $table->addIndex(['modified_by'])->addForeignKey('modified_by','users','id');
        $table->create();
    }
}
