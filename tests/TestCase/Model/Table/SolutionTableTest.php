<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolutionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolutionTable Test Case
 */
class SolutionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SolutionTable
     */
    public $Solution;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Solution'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Solution') ? [] : ['className' => SolutionTable::class];
        $this->Solution = TableRegistry::getTableLocator()->get('Solution', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Solution);

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
}
