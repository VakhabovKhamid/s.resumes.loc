<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApplicantDocumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApplicantDocumentsTable Test Case
 */
class ApplicantDocumentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApplicantDocumentsTable
     */
    public $ApplicantDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.applicant_documents',
        'app.applicants'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ApplicantDocuments') ? [] : ['className' => ApplicantDocumentsTable::class];
        $this->ApplicantDocuments = TableRegistry::getTableLocator()->get('ApplicantDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApplicantDocuments);

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
