<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicantDesirableCountriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicantDesirableCountriesTable Test Case
 */
class ApplicantDesirableCountriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicantDesirableCountriesTable
     */
    public $ApplicantDesirableCountries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applicant_desirable_countries',
        'app.applicants',
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
        $config = TableRegistry::getTableLocator()->exists('ApplicantDesirableCountries') ? [] : ['className' => ApplicantDesirableCountriesTable::class];
        $this->ApplicantDesirableCountries = TableRegistry::getTableLocator()->get('ApplicantDesirableCountries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicantDesirableCountries);

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
