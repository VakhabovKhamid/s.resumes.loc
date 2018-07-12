<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DictionaryRegionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DictionaryRegionsTable Test Case
 */
class DictionaryRegionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DictionaryRegionsTable
     */
    public $DictionaryRegions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('DictionaryRegions') ? [] : ['className' => DictionaryRegionsTable::class];
        $this->DictionaryRegions = TableRegistry::getTableLocator()->get('DictionaryRegions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DictionaryRegions);

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
