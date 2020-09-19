<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActionsProductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActionsProductsTable Test Case
 */
class ActionsProductsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActionsProductsTable
     */
    public $ActionsProducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ActionsProducts',
        'app.Actions',
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
        $config = TableRegistry::getTableLocator()->exists('ActionsProducts') ? [] : ['className' => ActionsProductsTable::class];
        $this->ActionsProducts = TableRegistry::getTableLocator()->get('ActionsProducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActionsProducts);

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
