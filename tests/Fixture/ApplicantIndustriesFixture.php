<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicantIndustriesFixture
 *
 */
class ApplicantIndustriesFixture extends TestFixture
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
        'dictionary_industry_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Идентификатор справочника "Отрасли"', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время создания записи', 'precision' => null],
        'created_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем создана запись', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время обновления записи', 'precision' => null],
        'modified_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем обновлена запись', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
                'dictionary_industry_id' => 1,
                'created' => '2018-07-13 10:28:59',
                'created_by' => 1,
                'modified' => '2018-07-13 10:28:59',
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
