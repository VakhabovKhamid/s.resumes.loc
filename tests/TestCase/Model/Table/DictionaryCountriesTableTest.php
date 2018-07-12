<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DictionaryCountriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DictionaryCountriesTable Test Case
 */
class DictionaryCountriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DictionaryCountriesTable
     */
    public $DictionaryCountries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dictionary_countries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DictionaryCountries') ? [] : ['className' => DictionaryCountriesTable::class];
        $this->DictionaryCountries = TableRegistry::getTableLocator()->get('DictionaryCountries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DictionaryCountries);

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
