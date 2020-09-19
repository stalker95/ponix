<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property string $description_page
 * @property string $keywords
 * @property string $address
 * @property string $time
 * @property string $locate
 * @property string $email
 * @property string $phones
 */
class Setting extends Entity
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
        '*'    => true,
        'name' => true,
        'logo' => true,
        'description_page' => true,
        'keywords' => true,
        'address' => true,
        'time' => true,
        'locate' => true,
        'email' => true,
        'phones' => true
    ];
}
