<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OptionsItem Entity
 *
 * @property int $id
 * @property string $name
 * @property int $option_id
 *
 * @property \App\Model\Entity\Option $option
 */
class OptionsItem extends Entity
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
        'option_id' => true,
        'option' => true
    ];
}
