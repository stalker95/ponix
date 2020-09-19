<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Discount Entity
 *
 * @property int $id
 * @property float $price
 * @property \Cake\I18n\FrozenTime $start_data
 * @property \Cake\I18n\FrozenTime $end_data
 * @property int $product_id
 *
 * @property \App\Model\Entity\Product $product
 */
class Discount extends Entity
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
        'price' => true,
        'start_data' => true,
        'end_data' => true,
        'product_id' => true,
        'product' => true
    ];
}
