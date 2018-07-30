<?php
use Migrations\AbstractMigration;

class CreateApplicants extends AbstractMigration
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
        $table = $this->table('applicants',['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id','biginteger',[
            'signed'=>'',
            'null'=>false,
            'autoIncrement'=>true,
            'limit'=>20,
            'comment'=>'Уникальный идентификатор'
        ]);
        $table->addColumn('latin_name','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Имя на латинице'
        ]);
        $table->addColumn('latin_surname','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Фамилия на латинице'
        ]);
        $table->addColumn('latin_patronym','string',[
            'limit'=>80,
            'null'=>false,
            'comment'=>'Отчество на латинице'
        ]);
        $table->addColumn('sex','string',[
            'limit'=>1,
            'null'=>true,
            'default'=>null,
            'comment'=>'Пол [M/F/X - муж/жен/неопр]'
        ]);
        $table->addColumn('birth_date','date',[
            'null'=>false,
            'comment'=>'Дата рождения'
        ]);
        $table->addColumn('address_country_id','biginteger',[
            'null'=>true,
            'default'=>null,
            'limit'=>20,
            'signed'=>'',
            'comment'=>'Адрес проживания: идентификатор справочника "Страны"'
        ]);
        $table->addColumn('address_region_id','biginteger',[
            'null'=>false,
            'limit'=>20,
            'signed'=>'',
            'comment'=>'Адрес проживания: идентификатор справочника "Области"'
        ]);
        $table->addColumn('address_district_id','biginteger',[
            'null'=>false,
            'limit'=>20,
            'signed'=>'',
            'comment'=>'Адрес проживания: идентификатор справочника "Районы"'
        ]);
        $table->addColumn('address_extended','string',[
            'limit'=>240,
            'null'=>true,
            'default'=>null,
            'comment'=>'Адрес проживания'
        ]);
        $table->addColumn('education_level_id','biginteger',[
            'null'=>false,
            'limit'=>20,
            'signed'=>'',
            'comment'=>'Идентификатор справочника "Cтепени образования"'
        ]);
        $table->addColumn('industry_id','biginteger',[
            'null'=>false,
            'limit'=>20,
            'signed'=>'',
            'comment'=>'Идентификатор справочника "Отрасли"'
        ]);
        /* JSON */
        $table->addColumn('professional_skills','json',[
            'null'=>false,
            'limit'=>80,
            'comment'=>'Профессиональные навыки'
        ]);
        /* JSON */

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
        $table->addColumn('is_archive','string',[
            'limit'=>1,
            'null'=>false,
            'default'=>'N',
            'comment'=>'Признак архивной записи (Y-да/N-нет)'
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

        $table->addIndex(['address_country_id'])->addForeignKey('address_country_id','dictionary_countries','id');
        $table->addIndex(['address_district_id'])->addForeignKey('address_district_id','dictionary_districts','id');
        $table->addIndex(['address_region_id'])->addForeignKey('address_region_id','dictionary_regions','id');
        $table->addIndex(['education_level_id'])->addForeignKey('education_level_id','dictionary_education_levels','id');
        $table->addIndex(['industry_id'])->addForeignKey('industry_id','dictionary_industries','id');

        $table->create();
    }
}
