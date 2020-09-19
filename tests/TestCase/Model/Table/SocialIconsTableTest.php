<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SocialIconsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SocialIconsTable Test Case
 */
class SocialIconsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SocialIconsTable
     */
    public $SocialIcons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SocialIcons'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SocialIcons') ? [] : ['className' => SocialIconsTable::class];
        $this->SocialIcons = TableRegistry::getTableLocator()->get('SocialIcons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SocialIcons);

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
