<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductsOption Entity
 *
 * @property int $id
 * @property int $options_items_id
 * @property int $product_id
 * @property int $value
 *
 * @property \App\Model\Entity\OptionsItem $options_item
 * @property \App\Model\Entity\Product $product
 */
class ProductsOption extends Entity
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
        'options_items_id' => true,
        'product_id' => true,
        'value' => true,
        'options_item' => true,
        'product' => true
    ];
}
