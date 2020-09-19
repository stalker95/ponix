<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WishlistTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WishlistTable Test Case
 */
class WishlistTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WishlistTable
     */
    public $Wishlist;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Wishlist',
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
        $config = TableRegistry::getTableLocator()->exists('Wishlist') ? [] : ['className' => WishlistTable::class];
        $this->Wishlist = TableRegistry::getTableLocator()->get('Wishlist', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wishlist);

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
