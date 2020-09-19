<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProducersDiscount Entity
 *
 * @property int $id
 * @property int $producer_id
 * @property float $discount
 *
 * @property \App\Model\Entity\Producer $producer
 */
class ProducersDiscount extends Entity
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
        'producer_id' => true,
        'discount' => true,
        'producer' => true
    ];
}
