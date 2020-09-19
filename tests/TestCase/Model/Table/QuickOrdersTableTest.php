<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuickOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuickOrdersTable Test Case
 */
class QuickOrdersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\QuickOrdersTable
     */
    public $QuickOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.QuickOrders',
        'app.Products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('QuickOrders') ? [] : ['className' => QuickOrdersTable::class];
        $this->QuickOrders = TableRegistry::getTableLocator()->get('QuickOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuickOrders);

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
