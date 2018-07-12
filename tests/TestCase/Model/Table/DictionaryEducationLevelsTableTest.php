<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DictionaryEducationLevelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DictionaryEducationLevelsTable Test Case
 */
class DictionaryEducationLevelsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DictionaryEducationLevelsTable
     */
    public $DictionaryEducationLevels;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dictionary_education_levels'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DictionaryEducationLevels') ? [] : ['className' => DictionaryEducationLevelsTable::class];
        $this->DictionaryEducationLevels = TableRegistry::getTableLocator()->get('DictionaryEducationLevels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DictionaryEducationLevels);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
