<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TagsMedia Entity
 *
 * @property int $id
 * @property int|null $media_id
 * @property int|null $tags_id
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\Tag $tag
 */
class TagsMedia extends Entity
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
        'media_id' => true,
        'tags_id' => true,
        'media' => true,
        'tag' => true
    ];
}
