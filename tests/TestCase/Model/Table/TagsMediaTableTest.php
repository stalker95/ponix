<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TagsMediaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TagsMediaTable Test Case
 */
class TagsMediaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TagsMediaTable
     */
    public $TagsMedia;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TagsMedia',
        'app.Media',
        'app.Tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TagsMedia') ? [] : ['className' => TagsMediaTable::class];
        $this->TagsMedia = TableRegistry::getTableLocator()->get('TagsMedia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TagsMedia);

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
