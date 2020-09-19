<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlaylistsMediaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlaylistsMediaTable Test Case
 */
class PlaylistsMediaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlaylistsMediaTable
     */
    public $PlaylistsMedia;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PlaylistsMedia',
        'app.Playlists',
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
        $config = TableRegistry::getTableLocator()->exists('PlaylistsMedia') ? [] : ['className' => PlaylistsMediaTable::class];
        $this->PlaylistsMedia = TableRegistry::getTableLocator()->get('PlaylistsMedia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlaylistsMedia);

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
