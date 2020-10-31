<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Liqpay Entity
 *
 * @property int $id
 * @property int $public_key
 * @property int $private_key
 */
class Liqpay extends Entity
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
        'public_key' => true,
        'private_key' => true
    ];
}
