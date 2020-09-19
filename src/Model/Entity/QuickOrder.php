<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * QuickOrder Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $username
 * @property string $phone
 *
 * @property \App\Model\Entity\Product $product
 */
class QuickOrder extends Entity
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
        'product_id' => true,
        'username' => true,
        'phone' => true,
    ];
}
