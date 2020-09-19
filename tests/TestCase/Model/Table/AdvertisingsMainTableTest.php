<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdvertisingsMainTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdvertisingsMainTable Test Case
 */
class AdvertisingsMainTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AdvertisingsMainTable
     */
    public $AdvertisingsMain;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AdvertisingsMain'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AdvertisingsMain') ? [] : ['className' => AdvertisingsMainTable::class];
        $this->AdvertisingsMain = TableRegistry::getTableLocator()->get('AdvertisingsMain', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AdvertisingsMain);

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
