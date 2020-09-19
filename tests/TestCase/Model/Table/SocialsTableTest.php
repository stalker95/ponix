<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SocialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SocialsTable Test Case
 */
class SocialsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SocialsTable
     */
    public $Socials;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Socials'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Socials') ? [] : ['className' => SocialsTable::class];
        $this->Socials = TableRegistry::getTableLocator()->get('Socials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Socials);

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
