<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TopBlockTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TopBlockTable Test Case
 */
class TopBlockTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TopBlockTable
     */
    public $TopBlock;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TopBlock'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TopBlock') ? [] : ['className' => TopBlockTable::class];
        $this->TopBlock = TableRegistry::getTableLocator()->get('TopBlock', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TopBlock);

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
