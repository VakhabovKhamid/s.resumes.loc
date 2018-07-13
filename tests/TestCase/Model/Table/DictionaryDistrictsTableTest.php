<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DictionaryDistrictsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DictionaryDistrictsTable Test Case
 */
class DictionaryDistrictsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DictionaryDistrictsTable
     */
    public $DictionaryDistricts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dictionary_districts',
        'app.dictionary_regions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DictionaryDistricts') ? [] : ['className' => DictionaryDistrictsTable::class];
        $this->DictionaryDistricts = TableRegistry::getTableLocator()->get('DictionaryDistricts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DictionaryDistricts);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
