<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeliveryPageTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeliveryPageTable Test Case
 */
class DeliveryPageTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DeliveryPageTable
     */
    public $DeliveryPage;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.DeliveryPage'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DeliveryPage') ? [] : ['className' => DeliveryPageTable::class];
        $this->DeliveryPage = TableRegistry::getTableLocator()->get('DeliveryPage', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DeliveryPage);

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
