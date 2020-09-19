<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttributesCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttributesCategoriesTable Test Case
 */
class AttributesCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AttributesCategoriesTable
     */
    public $AttributesCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.AttributesCategories',
        'app.Attributes',
        'app.Categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AttributesCategories') ? [] : ['className' => AttributesCategoriesTable::class];
        $this->AttributesCategories = TableRegistry::getTableLocator()->get('AttributesCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AttributesCategories);

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
