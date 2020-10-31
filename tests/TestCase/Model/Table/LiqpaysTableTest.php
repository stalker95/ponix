<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LiqpaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LiqpaysTable Test Case
 */
class LiqpaysTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LiqpaysTable
     */
    public $Liqpays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Liqpays'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Liqpays') ? [] : ['className' => LiqpaysTable::class];
        $this->Liqpays = TableRegistry::getTableLocator()->get('Liqpays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Liqpays);

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
