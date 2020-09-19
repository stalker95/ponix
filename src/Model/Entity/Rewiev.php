<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rewiev Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $user_name
 * @property string $user_email
 * @property string $rewiev_text
 * @property float $rating
 *
 * @property \App\Model\Entity\Product $product
 */
class Rewiev extends Entity
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
        'user_name' => true,
        'user_email' => true,
        'rewiev_text' => true,
        'rating' => true,
        'product' => true
    ];
}
