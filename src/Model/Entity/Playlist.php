<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Playlist Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $user_id
 * @property \Cake\I18n\FrozenTime|null $category_id
 * @property string|null $city
 * @property string|null $region
 * @property int|null $time
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 */
class Playlist extends Entity
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
        'user_id' => true,
        'city' => true,
        'region' => true,
        'time' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'category_id' => true,
        'theme_id' => true,
    ];
    protected $_hidden = [
        '_joinData'
    ];
   
    // Get last id Playlist 
    // From table playlists_media
    public function getLastIdPlaylist($id= null) 
    {
        $last_id;
        $medias_playlists = \Cake\ORM\TableRegistry::get('playlists_media');
        $medias_playlist = $medias_playlists->find()->where(['playlist_id'=>$id])
        ->limit(1)
        ->order(['id' => 'DESC'])
        ->toArray();
        foreach ($medias_playlist as $key => $value) {
           $last_id=$value['id'];
        }
        return $last_id;
    }
    
    // Set new rank Media of Playlists
    // In table playlists_media
    // Method get id of record in table playlists_media
    // And set new Rank from parament
    public function setNewRankMedia($id = null,$count=null) 
    {

        $playlistss_medias= \Cake\ORM\TableRegistry::get('playlists_media');
         $mediass_playlists = $playlistss_medias->get($id);
         $mediass_playlists->rank=$count; 
        if ($playlistss_medias->save($mediass_playlists)) {
                   var_dump($mediass_playlists);
        }
        
    }
    
    // Set new rank Media of Playlists
    // In table playlists_media
    public function updateRankForMediaPlaylist($counter= null, $id=null) {

         \Cake\ORM\TableRegistry::get('playlists_media')->updateAll(
         array( 'rank' =>$counter ),
         array( 'id' => $id )
         );
    }

    // Get object of Playlist from table playlists
    // With associations (Themes,Categories,Media)
    public function getPlaylistById($id = null) 
    {// Load Files model
        $this->loadModel('Playlist');
        $this->loadModel('Categories');
        $this->loadModel('Users');
        $this->loadModel('Themes');
        $this->loadModel('Media');
        $this->loadModel('Notifications');
       $this->Playlist
        ->find()
        ->select([
            'Playlist.id',
            'Playlist.name',
            'Playlist.city',
            'Playlist.region',
            'Themes__id'       => 'Themes.id',
            'Themes__name'     => 'Themes.name',
            'Categories__id'   => 'Categories.id',
            'Categories__name' => 'Categories.name',
            'Playlist__media'  => 'Playlists_Media.id',
            'Playlist__rank'   => 'Playlists_Media.rank',
            'Playlist__is_abs' => 'Playlists_Media.is_abs',
            'Media__name'      => 'Media.name',
            'Media__id'        => 'Media.id',
            'Media__file'      => 'Media.file',
            'Media__created'   => 'Media.created',
            'Media__type'      => 'Media.type',
            'Media__video'     => 'Media.created',
            'Users__id'        => 'Users.id',
            'Users__name'      => 'Users.firstname',
            'Users__lastname'  => 'Users.lastname'

        ])
        ->join([
                        'Categories'=>  [
                            'table'      => 'categories',
                            'type'       => 'LEFT',
                            'conditions' => 'Categories.id=Playlist.category_id',
                        ]])
        ->join([
                        'Playlists_Media'=>  [
                            'table'      => 'playlists_media',
                            'type'       => 'LEFT',
                            'conditions' => 'Playlists_Media.playlist_id=Playlist.id',
         ]])
        ->join([
                        'Media'=>  [
                            'table'      => 'media',
                            'type'       => 'LEFT',
                            'conditions' => 'Media.id=Playlists_Media.media_id',
                        ]])
        ->join([
                        'Themes'=>  [
                            'table'      => 'themes',
                            'type'       => 'LEFT',
                            'conditions' => 'Playlist.theme_id=Themes.id',
                        ]])
        ->join([
                        'Users'=>  [
                            'table'      => 'users',
                            'type'       => 'LEFT',
                            'conditions' => 'Playlist.user_id=Users.id',
                        ]])
               
                      
        ->order(['Playlists_Media.rank' => 'ASC'])
        ->where(['Playlist.id'=>$id])
        ->toArray();
    }


    public function deleteMediaFromPlaylist($playlist_id = null, $media_id = null)
    {
       $this->PlaylistsMedia = TableRegistry::get('playlists_media');
       $playlists_media = $this->PlaylistsMedia->find('all')->where(['playlist_id'=>$playlist_id])->where(['media_id'=>$media_id])->toArray();
       
       foreach ($playlists_media as $key => $value):
         $play_list_media = $this->PlaylistsMedia->get($value['id']);
         $this->PlaylistsMedia->delete($play_list_media);
       endforeach;
    }
    
}
