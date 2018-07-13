<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicantUndesirableCountriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicantUndesirableCountriesTable Test Case
 */
class ApplicantUndesirableCountriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicantUndesirableCountriesTable
     */
    public $ApplicantUndesirableCountries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applicant_undesirable_countries',
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
        $config = TableRegistry::getTableLocator()->exists('ApplicantUndesirableCountries') ? [] : ['className' => ApplicantUndesirableCountriesTable::class];
        $this->ApplicantUndesirableCountries = TableRegistry::getTableLocator()->get('ApplicantUndesirableCountries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicantUndesirableCountries);

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
