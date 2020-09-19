<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OptionsItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OptionsItemsTable Test Case
 */
class OptionsItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OptionsItemsTable
     */
    public $OptionsItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OptionsItems',
        'app.Options'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OptionsItems') ? [] : ['className' => OptionsItemsTable::class];
        $this->OptionsItems = TableRegistry::getTableLocator()->get('OptionsItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OptionsItems);

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
