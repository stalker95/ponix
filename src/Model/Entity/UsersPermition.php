<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersPermition Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $name_permition
 * @property int $id_permition
 *
 * @property \App\Model\Entity\User $user
 */
class UsersPermition extends Entity
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
        'user_id' => true,
        'name_permition' => true,
        'id_permition' => true,
        'user' => true,
        'status' => true,
    ];
}
