<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AbsMedia Entity
 *
 * @property int $id
 * @property int $media_id
 *
 * @property \App\Model\Entity\Media $media
 */
class AbsMedia extends Entity
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
        'media' => true
    ];

    /**
     * Delete Media abs  method
     *
     * @param string|null $id Abs Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function deleteMediaFromPlaylist($media_id = null)
    {
        $mediass_playlists = \Cake\ORM\TableRegistry::get('playlists_media');
        $mediass_playlist = $mediass_playlists->find('all')->where(['AND' => ['media_id IN' => $media_id,'is_abs' => 1]])->toArray();
         if (!empty($mediass_playlist)):
            foreach ($mediass_playlist as $key => $value) {
                $media_p = \Cake\ORM\TableRegistry::get('playlists_media');
                $media = $media_p->get($value['id']);  
              $media_p->delete($media);
            }
         endif;
    }

    public function insertMediaInPlaylist($media_id = null)
    {
        $playlists = \Cake\ORM\TableRegistry::get('playlists');
        $playlist = $playlists->find('all')->toArray();
         if (!empty($playlist)):
            foreach ($playlist as $key => $value) :
                $playlists_table = \Cake\ORM\TableRegistry::get('playlists_media');
                $playlists_t = $playlists_table->newEntity();
                $playlists_t->media_id = $media_id;
                $playlists_t->playlist_id = $value['id'];
                $playlists_table->save($playlists_t);
            endforeach;
         endif;
    }
}
