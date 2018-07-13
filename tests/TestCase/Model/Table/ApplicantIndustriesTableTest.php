<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicantIndustriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicantIndustriesTable Test Case
 */
class ApplicantIndustriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicantIndustriesTable
     */
    public $ApplicantIndustries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applicant_industries',
        'app.applicants',
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
        $config = TableRegistry::getTableLocator()->exists('ApplicantIndustries') ? [] : ['className' => ApplicantIndustriesTable::class];
        $this->ApplicantIndustries = TableRegistry::getTableLocator()->get('ApplicantIndustries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicantIndustries);

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
