<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProducersDiscountsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProducersDiscountsTable Test Case
 */
class ProducersDiscountsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProducersDiscountsTable
     */
    public $ProducersDiscounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProducersDiscounts',
        'app.Producers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProducersDiscounts') ? [] : ['className' => ProducersDiscountsTable::class];
        $this->ProducersDiscounts = TableRegistry::getTableLocator()->get('ProducersDiscounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProducersDiscounts);

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
