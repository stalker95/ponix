<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactFormTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactFormTable Test Case
 */
class ContactFormTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactFormTable
     */
    public $ContactForm;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ContactForm'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactForm') ? [] : ['className' => ContactFormTable::class];
        $this->ContactForm = TableRegistry::getTableLocator()->get('ContactForm', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactForm);

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
