<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeoTable Test Case
 */
class SeoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeoTable
     */
    public $Seo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Seo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Seo') ? [] : ['className' => SeoTable::class];
        $this->Seo = TableRegistry::getTableLocator()->get('Seo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Seo);

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
