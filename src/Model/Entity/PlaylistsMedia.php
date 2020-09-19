<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlaylistsMedia Entity
 *
 * @property int $id
 * @property int|null $playlist_id
 * @property int|null $media_id
 * @property int|null $rank
 *
 * @property \App\Model\Entity\Playlist $playlist
 * @property \App\Model\Entity\Media $media
 */
class PlaylistsMedia extends Entity
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
        'playlist_id' => true,
        'media_id' => true,
        'is_abs' => true,
        'rank' => true,
        'playlist' => true,
        'media' => true,
    ];
}
