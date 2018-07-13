<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicantDocumentsFixture
 *
 */
class ApplicantDocumentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Уникальный идентификатор', 'autoIncrement' => true, 'precision' => null],
        'applicant_id' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Идентификатор реестра "Работники"', 'precision' => null, 'autoIncrement' => null],
        'anchor' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Группировка файлов', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 120, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Наименование при загрузке', 'precision' => null, 'fixed' => null],
        'path' => ['type' => 'string', 'length' => 240, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => 'Относительный путь до файла', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время создания записи', 'precision' => null],
        'created_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем создана запись', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => 'Время обновления записи', 'precision' => null],
        'modified_by' => ['type' => 'biginteger', 'length' => 18, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'Кем обновлена запись', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_applicant_documents_application_id' => ['type' => 'index', 'columns' => ['applicant_id'], 'length' => []],
            'fk_applicant_documents_created_by' => ['type' => 'index', 'columns' => ['created_by'], 'length' => []],
            'fk_applicant_documents_modified_by' => ['type' => 'index', 'columns' => ['modified_by'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_applicant_documents_applicant_id' => ['type' => 'foreign', 'columns' => ['applicant_id'], 'references' => ['applicants', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicant_documents_created_by' => ['type' => 'foreign', 'columns' => ['created_by'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_applicant_documents_modified_by' => ['type' => 'foreign', 'columns' => ['modified_by'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'anchor' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'path' => 'Lorem ipsum dolor sit amet',
                'created' => '2018-07-11 13:27:11',
                'created_by' => 1,
                'modified' => '2018-07-11 13:27:11',
                'modified_by' => 1
            ],
        ];
        parent::init();
    }
}
