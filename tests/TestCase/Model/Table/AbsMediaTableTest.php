<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbsMediaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbsMediaTable Test Case
 */
class AbsMediaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbsMediaTable
     */
    public $AbsMedia;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AbsMedia',
        'app.Media'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AbsMedia') ? [] : ['className' => AbsMediaTable::class];
        $this->AbsMedia = TableRegistry::getTableLocator()->get('AbsMedia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AbsMedia);

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
