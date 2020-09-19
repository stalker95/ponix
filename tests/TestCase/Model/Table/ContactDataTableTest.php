<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContactDataTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactDataTable Test Case
 */
class ContactDataTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContactDataTable
     */
    public $ContactData;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ContactData'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ContactData') ? [] : ['className' => ContactDataTable::class];
        $this->ContactData = TableRegistry::getTableLocator()->get('ContactData', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactData);

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
