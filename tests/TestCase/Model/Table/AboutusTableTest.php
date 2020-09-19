<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AboutusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AboutusTable Test Case
 */
class AboutusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AboutusTable
     */
    public $Aboutus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Aboutus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Aboutus') ? [] : ['className' => AboutusTable::class];
        $this->Aboutus = TableRegistry::getTableLocator()->get('Aboutus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Aboutus);

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
