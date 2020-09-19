<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MainBlockTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MainBlockTable Test Case
 */
class MainBlockTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MainBlockTable
     */
    public $MainBlock;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MainBlock'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MainBlock') ? [] : ['className' => MainBlockTable::class];
        $this->MainBlock = TableRegistry::getTableLocator()->get('MainBlock', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MainBlock);

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
