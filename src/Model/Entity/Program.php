<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Program Entity
 *
 * @property int $id
 * @property string $title
 * @property string $price
 * @property string $title_two
 * @property string $description
 * @property string $button_text
 */
class Program extends Entity
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
        'title' => true,
        'price' => true,
        'title_two' => true,
        'description' => true,
        'button_text' => true
    ];
}
