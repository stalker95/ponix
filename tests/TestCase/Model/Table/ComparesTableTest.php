<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComparesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComparesTable Test Case
 */
class ComparesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComparesTable
     */
    public $Compares;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Compares',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('Compares') ? [] : ['className' => ComparesTable::class];
        $this->Compares = TableRegistry::getTableLocator()->get('Compares', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Compares);

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
