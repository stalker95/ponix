<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $firstname
 * @property string $phone
 * @property string $email
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $delivery_id
 * @property int $oplata_id
 * @property string $city
 * @property string $lastname
 */
class Order extends Entity
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
        'firstname' => true,
        'phone' => true,
        'email' => true,
        'user_id' => true,
        'created' => true,
        'delivery_id' => true,
        'oplata_id' => true,
        'city' => true,
        'lastname' => true
    ];
}
