<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProposesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProposesTable Test Case
 */
class ProposesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProposesTable
     */
    public $Proposes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Proposes',
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
        $config = TableRegistry::getTableLocator()->exists('Proposes') ? [] : ['className' => ProposesTable::class];
        $this->Proposes = TableRegistry::getTableLocator()->get('Proposes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Proposes);

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
