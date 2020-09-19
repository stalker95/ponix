<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PublicsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PublicsTable Test Case
 */
class PublicsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PublicsTable
     */
    public $Publics;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Publics'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Publics') ? [] : ['className' => PublicsTable::class];
        $this->Publics = TableRegistry::getTableLocator()->get('Publics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Publics);

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
