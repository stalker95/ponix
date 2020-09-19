<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersPermitionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersPermitionsTable Test Case
 */
class UsersPermitionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersPermitionsTable
     */
    public $UsersPermitions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UsersPermitions',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UsersPermitions') ? [] : ['className' => UsersPermitionsTable::class];
        $this->UsersPermitions = TableRegistry::getTableLocator()->get('UsersPermitions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersPermitions);

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
