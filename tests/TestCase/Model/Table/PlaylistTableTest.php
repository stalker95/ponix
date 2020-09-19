<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlaylistTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlaylistTable Test Case
 */
class PlaylistTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlaylistTable
     */
    public $Playlist;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Playlist',
        'app.Users',
        'app.Categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Playlist') ? [] : ['className' => PlaylistTable::class];
        $this->Playlist = TableRegistry::getTableLocator()->get('Playlist', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Playlist);

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
