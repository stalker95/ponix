<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersPhonesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersPhonesTable Test Case
 */
class UsersPhonesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersPhonesTable
     */
    public $UsersPhones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UsersPhones',
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
        $config = TableRegistry::getTableLocator()->exists('UsersPhones') ? [] : ['className' => UsersPhonesTable::class];
        $this->UsersPhones = TableRegistry::getTableLocator()->get('UsersPhones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersPhones);

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
