<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DictionaryDistrictsFixture
 *
 */
class DictionaryDistrictsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Уникальный идентификатор', 'autoIncrement' => true, 'precision' => null],
        'region_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Идентификатор справочника "Области"', 'precision' => null, 'autoIncrement' => null],
        'name_uz_c' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Наименование на узбекском кириллица', 'precision' => null, 'fixed' => null],
        'name_uz_l' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Наименование на узбекском латиница', 'precision' => null, 'fixed' => null],
        'name_ru_c' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Наименование на русском кириллица', 'precision' => null, 'fixed' => null],
        'name_en_l' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Наименование на английском латиница', 'precision' => null, 'fixed' => null],
        'name_qr_c' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Наименование на каракалпакском кириллица', 'precision' => null, 'fixed' => null],
        'name_qr_l' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Наименование на каракалпакском латиница', 'precision' => null, 'fixed' => null],
        'is_active' => ['type' => 'string', 'length' => 1, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Признак активности записи (Y-да/N-нет)', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время создания записи', 'precision' => null],
        'created_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем создана запись', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время обновления записи', 'precision' => null],
        'modified_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем обновлена запись', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_dictionary_districts_region_id' => ['type' => 'index', 'columns' => ['region_id'], 'length' => []],
            'fk_dictionary_districts_created_by' => ['type' => 'index', 'columns' => ['created_by'], 'length' => []],
            'fk_dictionary_districts_modified_by' => ['type' => 'index', 'columns' => ['modified_by'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_dictionary_districts_created_by' => ['type' => 'foreign', 'columns' => ['created_by'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_dictionary_districts_modified_by' => ['type' => 'foreign', 'columns' => ['modified_by'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_dictionary_districts_region_id' => ['type' => 'foreign', 'columns' => ['region_id'], 'references' => ['dictionary_regions', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'region_id' => 1,
                'name_uz_c' => 'Lorem ipsum dolor sit amet',
                'name_uz_l' => 'Lorem ipsum dolor sit amet',
                'name_ru_c' => 'Lorem ipsum dolor sit amet',
                'name_en_l' => 'Lorem ipsum dolor sit amet',
                'name_qr_c' => 'Lorem ipsum dolor sit amet',
                'name_qr_l' => 'Lorem ipsum dolor sit amet',
                'is_active' => 'Lorem ipsum dolor sit ame',
                'created' => '2018-07-11 13:26:26',
                'created_by' => 1,
                'modified' => '2018-07-11 13:26:26',
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
