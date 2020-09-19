<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RewievTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RewievTable Test Case
 */
class RewievTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RewievTable
     */
    public $Rewiev;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Rewiev',
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
        $config = TableRegistry::getTableLocator()->exists('Rewiev') ? [] : ['className' => RewievTable::class];
        $this->Rewiev = TableRegistry::getTableLocator()->get('Rewiev', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rewiev);

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
