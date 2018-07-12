<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DictionaryIndustriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DictionaryIndustriesTable Test Case
 */
class DictionaryIndustriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DictionaryIndustriesTable
     */
    public $DictionaryIndustries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dictionary_industries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DictionaryIndustries') ? [] : ['className' => DictionaryIndustriesTable::class];
        $this->DictionaryIndustries = TableRegistry::getTableLocator()->get('DictionaryIndustries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DictionaryIndustries);

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
