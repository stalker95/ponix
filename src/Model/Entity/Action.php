<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Action Entity
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property \Cake\I18n\FrozenTime $date_end
 * @property int $product_id
 * @property string $background
 */
class Action extends Entity
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
        '*'     => true,
        'title' => true,
        'image' => true,
        'date_end' => true,
        'product_id' => true,
        'background' => true
    ];
}
