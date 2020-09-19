<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WishlistsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WishlistsTable Test Case
 */
class WishlistsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WishlistsTable
     */
    public $Wishlists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Wishlists',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('Wishlists') ? [] : ['className' => WishlistsTable::class];
        $this->Wishlists = TableRegistry::getTableLocator()->get('Wishlists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wishlists);

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
