<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicantsFixture
 *
 */
class ApplicantsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Уникальный идентификатор', 'autoIncrement' => true, 'precision' => null],
        'latin_name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Имя на латинице', 'precision' => null, 'fixed' => null],
        'latin_surname' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Фамилия на латинице', 'precision' => null, 'fixed' => null],
        'latin_patronym' => ['type' => 'string', 'length' => 80, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Отчество на латинице', 'precision' => null, 'fixed' => null],
        'sex' => ['type' => 'string', 'length' => 1, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Пол [M/F/X - муж/жен/неопр]', 'precision' => null, 'fixed' => null],
        'birth_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Дата рождения', 'precision' => null],
        'address_country_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'Адрес проживания: идентификатор справочника "Страны"', 'precision' => null, 'autoIncrement' => null],
        'address_region_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Адрес проживания: идентификатор справочника "Области"', 'precision' => null, 'autoIncrement' => null],
        'address_district_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Адрес проживания: идентификатор справочника "Районы"', 'precision' => null, 'autoIncrement' => null],
        'address_extended' => ['type' => 'string', 'length' => 240, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Адрес проживания', 'precision' => null, 'fixed' => null],
        'education_level_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Идентификатор справочника "Cтепени образования"', 'precision' => null, 'autoIncrement' => null],
        'industry_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Идентификатор справочника "Отрасли"', 'precision' => null, 'autoIncrement' => null],
        'professional_skills' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Профессиональные навыки', 'precision' => null, 'fixed' => null],
        'desirable_countries' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Страны желательные к отбытию', 'precision' => null],
        'undesirable_countries' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Страны нежелательные к отбытию', 'precision' => null],
        'is_archive' => ['type' => 'string', 'length' => 1, 'null' => false, 'default' => 'N', 'collate' => 'utf8_bin', 'comment' => 'Признак архивной записи (Y-да/N-нет)', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время создания записи', 'precision' => null],
        'created_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем создана запись', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время обновления записи', 'precision' => null],
        'modified_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем обновлена запись', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_applicants_education_industry_id' => ['type' => 'index', 'columns' => ['industry_id'], 'length' => []],
            'fk_applicants_education_education_level_id' => ['type' => 'index', 'columns' => ['education_level_id'], 'length' => []],
            'fk_applicants_created_by' => ['type' => 'index', 'columns' => ['created_by'], 'length' => []],
            'fk_applicants_modified_by' => ['type' => 'index', 'columns' => ['modified_by'], 'length' => []],
            'fk_applicants_address_country_id' => ['type' => 'index', 'columns' => ['address_country_id'], 'length' => []],
            'fk_applicants_address_region_id' => ['type' => 'index', 'columns' => ['address_region_id'], 'length' => []],
            'fk_applicants_address_district_id' => ['type' => 'index', 'columns' => ['address_district_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_applicants_address_country_id' => ['type' => 'foreign', 'columns' => ['address_country_id'], 'references' => ['dictionary_countries', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicants_address_district_id' => ['type' => 'foreign', 'columns' => ['address_district_id'], 'references' => ['dictionary_districts', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicants_address_region_id' => ['type' => 'foreign', 'columns' => ['address_region_id'], 'references' => ['dictionary_regions', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicants_created_by' => ['type' => 'foreign', 'columns' => ['created_by'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicants_education_education_level_id' => ['type' => 'foreign', 'columns' => ['education_level_id'], 'references' => ['dictionary_education_levels', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicants_education_industry_id' => ['type' => 'foreign', 'columns' => ['industry_id'], 'references' => ['dictionary_industries', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicants_modified_by' => ['type' => 'foreign', 'columns' => ['modified_by'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_bin'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'latin_name' => 'Lorem ipsum dolor sit amet',
                'latin_surname' => 'Lorem ipsum dolor sit amet',
                'latin_patronym' => 'Lorem ipsum dolor sit amet',
                'sex' => 'Lorem ipsum dolor sit ame',
                'birth_date' => '2018-07-11',
                'address_country_id' => 1,
                'address_region_id' => 1,
                'address_district_id' => 1,
                'address_extended' => 'Lorem ipsum dolor sit amet',
                'education_level_id' => 1,
                'industry_id' => 1,
                'professional_skills' => 'Lorem ipsum dolor sit amet',
                'desirable_countries' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'undesirable_countries' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'is_archive' => 'Lorem ipsum dolor sit ame',
                'created' => '2018-07-11 13:26:58',
                'created_by' => 1,
                'modified' => '2018-07-11 13:26:58',
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
