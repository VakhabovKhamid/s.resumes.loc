<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicantUndesirableCountriesFixture
 *
 */
class ApplicantUndesirableCountriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Уникальный идентификатор', 'autoIncrement' => true, 'precision' => null],
        'applicant_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Идентификатор реестра "Соискатели"', 'precision' => null, 'autoIncrement' => null],
        'dictionary_country_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Идентификатор справочника "Страны"', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время создания записи', 'precision' => null],
        'created_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем создана запись', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время обновления записи', 'precision' => null],
        'modified_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем обновлена запись', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_applicant_undesirable_countries_applicant_id' => ['type' => 'index', 'columns' => ['applicant_id'], 'length' => []],
            'fk_applicant_undesirable_countries_dictionary_country_id' => ['type' => 'index', 'columns' => ['dictionary_country_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_applicant_undesirable_countries_applicant_id' => ['type' => 'foreign', 'columns' => ['applicant_id'], 'references' => ['applicants', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicant_undesirable_countries_dictionary_country_id' => ['type' => 'foreign', 'columns' => ['dictionary_country_id'], 'references' => ['dictionary_countries', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'applicant_id' => 1,
                'dictionary_country_id' => 1,
                'created' => '2018-07-13 10:29:06',
                'created_by' => 1,
                'modified' => '2018-07-13 10:29:06',
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
