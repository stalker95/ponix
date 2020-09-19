<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Blog Entity
 *
 * @property int $id
 * @property string $title_page
 * @property string $slug
 * @property string $text
 * @property string $keywords
 * @property string $description
 * @property string $image
 */
class Blog extends Entity
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
        '*' => true,
        'title_page' => true,
        'slug' => true,
        'text' => true,
        'keywords' => true,
        'description' => true,
        'image' => true,
        'title' => true,
    ];
}
