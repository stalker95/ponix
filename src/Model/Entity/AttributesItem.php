<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;

/**
 * AttributesItem Entity
 *
 * @property int $id
 * @property string $name
 * @property string $parent_id
 *
 * @property \App\Model\Entity\ParentAttributesItem $parent_attributes_item
 * @property \App\Model\Entity\ChildAttributesItem[] $child_attributes_items
 */
class AttributesItem extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'parent_id' => true,
        'parent_attributes_item' => true,
        'child_attributes_items' => true
    ];

    public function getListAttributesBeforeFilter($category_id = null)
    {
       $this->AttributesItems = TableRegistry::get('attributes_items');
        
        $attributes = $this->AttributesItems
                        ->find('all')->contain(['AttributesProducts',
                            'AttributesProducts.Products'
                                => function ($e) use ($category_id) {
                                    $e ->find('all');
                                    $e ->autoFields(true);
                                    $e ->where(['Products.category_id' => $category_id]);
                                    return $e;
                               }
                
      ])->toArray();
        
        $attributes_to_view = [];   
        foreach ($attributes as $key => $value) {
            $attributes_to_view[$value['name']] = [];
            foreach ($value['attributes_products'] as $keys => $item) {
                $attribute_item = [];
                $attribute_item['name'] = $item['value'];
                $attribute_item['attribute_id'] = $item['attribute_id'];
                $attribute_item['count'] = 1;
                if (!isset($attributes_to_view[$value['name']][$attribute_item['name']]))
                {
                    $attributes_to_view[$value['name']][$attribute_item['name']] = $attribute_item ;
                }
                else {
                    $attributes_to_view[$value['name']][$attribute_item['name']]['count'] = $attributes_to_view[$value['name']][$attribute_item['name']]['count'] + 1;
                }
            }
        }
        
        return $attributes_to_view;
    }

    public function getListAttributesAfterFilter($products = null)
    {
       $this->AttributesItems = TableRegistry::get('attributes_items');
        
        $attributes = $this->AttributesItems
                        ->find('all')->contain(['AttributesProducts',
                            'AttributesProducts.Products'
                                => function ($e) use ($category_id) {
                                    $e ->find('all');
                                    $e ->autoFields(true);
                                    $e ->where(['Products.category_id' => $category_id]);
                                    return $e;
                               }
                
      ])->toArray();
        
        $attributes_to_view = [];   
        foreach ($attributes as $key => $value) {
            $attributes_to_view[$value['name']] = [];
            foreach ($value['attributes_products'] as $keys => $item) {
                $attribute_item = [];
                $attribute_item['name'] = $item['value'];
                $attribute_item['attribute_id'] = $item['attribute_id'];
                $attribute_item['count'] = 1;
                if (!isset($attributes_to_view[$value['name']][$attribute_item['name']]))
                {
                    $attributes_to_view[$value['name']][$attribute_item['name']] = $attribute_item ;
                }
                else {
                    $attributes_to_view[$value['name']][$attribute_item['name']]['count'] = $attributes_to_view[$value['name']][$attribute_item['name']]['count'] + 1;
                }
            }
        }
        return $attributes_to_view;
    }

}
