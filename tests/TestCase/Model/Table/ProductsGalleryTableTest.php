<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductsGalleryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductsGalleryTable Test Case
 */
class ProductsGalleryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductsGalleryTable
     */
    public $ProductsGallery;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ProductsGallery',
        'app.Products'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ProductsGallery') ? [] : ['className' => ProductsGalleryTable::class];
        $this->ProductsGallery = TableRegistry::getTableLocator()->get('ProductsGallery', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductsGallery);

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
