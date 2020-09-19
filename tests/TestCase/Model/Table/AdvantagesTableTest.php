<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdvantagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdvantagesTable Test Case
 */
class AdvantagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AdvantagesTable
     */
    public $Advantages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Advantages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Advantages') ? [] : ['className' => AdvantagesTable::class];
        $this->Advantages = TableRegistry::getTableLocator()->get('Advantages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Advantages);

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
