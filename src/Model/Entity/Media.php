<?php
namespace App\Model\Entity;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\Filesystem\Folder;

/**
 * Media Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $file
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $type
 * @property bool|null $active
 */
class Media extends Entity
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
        'file' => true,
        'created' => true,
        'modified' => true,
        'type' => false,
        'active' => false,
        'description' => true,
        'categories' => true,
        'tags' => true
    ];

    // Get playlists by id_user
    public function getPlaylistsId($user_id) {
      $playlists_users= array();
        if (!empty($user_id)):
            foreach ($user_id as $key ) {
            $playlists = \Cake\ORM\TableRegistry::get('playlists');
            $media= \Cake\ORM\TableRegistry::get('media');
            $playlist = $playlists->find('list',['valueField'=>'id'])->where(['user_id' => $key]);
                foreach ($playlist as $key ) {
                    array_push($playlists_users, $key);
                }
            }
            return $playlists_users;
        endif;
    }

    // Delete tags for media in table tags_media
    // Method get two params id tag and id media

    public function deleteMediaTags($tag_id = null,$media_id = null) 
    {

        $this->TagsMedia = TableRegistry::get('tags_media');
        $tags_media=$this->TagsMedia
          ->find('all')
          ->where(['AND' => ['tags_id IN' => $media_id,'media_id' => $tag_id]])
          ->first();
        //var_dump($tags_media);
        $this->TagsMedia->delete($tags_media);

    }

    // Change playlist of media 
    // Method get two params id of Media and id Playlist

    public function ChangePlaylist($id,$playlist_id) 
    {
      $this->PlaylistMedia = TableRegistry::get('playlists_media');
      $rank = 1;
      $playlists_media=$this->PlaylistMedia
        ->find('all')
        ->where(['media_id'=>$id])
        ->first();
        if ($playlists_media != null)
        {
         $this->PlaylistMedia->delete($playlists_media);
         $rank = $playlists_media->rank;
        }
      $new_playlist_media = $this->PlaylistMedia->newEntity();
      $new_playlist_media->media_id = $id;
      $new_playlist_media->playlist_id = $playlist_id;
      $new_playlist_media->rank = $playlist_id;
      $this->PlaylistMedia->save($new_playlist_media);
    }

    public function savePreviewForVideo($upload_file)
    {
      $file=$upload_file;
      $file = str_replace('data:image/png;base64,', '', $file);
      $file = str_replace(' ', '+', $file);
      $filestorage = base64_decode($file);
      file_put_contents("uploads/files/".time().".png", $filestorage);
      $preview=time().".png";    
      return $preview;             
    }

    public function checkExistFile()
    {
      if (!file_exists(WWW_ROOT . 'uploads' . DS . 'files')) {
        if (!mkdir(WWW_ROOT . 'uploads' . DS . 'files', 0755, true)) {
         $this->Flash->admin_error(__('Media directory not found'));
         return;
        }
      }
    }

    public function ChangePreview($file, $media_id, $preview)
    {
       $this->Media = TableRegistry::get('media');
       $mm_dir = new Folder(WWW_ROOT . 'uploads' . DS . 'files', true, 0777);
       $target_path = $mm_dir->pwd() . DS;
       $oldfile = $target_path . $preview;
              if (file_exists($oldfile))
               {
                unlink($oldfile);
               }
              $img = $file;
               if ($img['name']!="") {
                 $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                 $filename = md5(microtime(true)) . '.' . $ext;
                 move_uploaded_file($img['tmp_name'], $target_path . $filename);
                 $this->Media->updateAll(['name' => ""], ['id' => $media_id]);
                 $this->Media->updateAll(['name' => $filename], ['id' => $media_id]);
                }
                    
            
    }

    public function deleteIt($user_id = null)
    {
      $this->Media = TableRegistry::get('media');
      $media = $this->Media->find()->where(['user_id'=>$user_id])->toArray();
      
         if (!empty($media)):
          foreach ($media as $key => $value) {
            $media_p = \Cake\ORM\TableRegistry::get('media');
            $media = $media_p->get($value['id']);
            $media_p->delete($media);

            
          }
         endif; 
    }

    public function insertMediaPlaylist($playlists = null,$media_id = null)
    {
      $this->Playlist = TableRegistry::get('playlists');
      $playlist = $this->Playlist->newEntity();

      if (!empty($playlists)):
          foreach ($playlists as $key => $value) {
           $this->PlaylistMedia = TableRegistry::get('playlists_media');
            $playlists_media=$this->PlaylistMedia->newEntity();
            //  debug($playlists_media);  
            $playlists_media->playlist_id = $value;
            $playlists_media->media_id = $media_id;
            $playlists_media->rank = 1;
            $playlists_media->is_abs = 1;
            $this->PlaylistMedia->save($playlists_media);
          }
         endif; 
    }

    public function getListOfPlaylist($media_id)
    {
      $mass_of_id_playlists = array();
      $this->Playlist = TableRegistry::get('playlists');
      $this->PlaylistsMedia = TableRegistry::get('playlists_media');
       $find_media_playlist = $this->PlaylistsMedia
            ->find()
            ->select(['Playlists__id' => 'Playlists.id',
                      'Playlists__name' => 'Playlists.name',
            ])
            ->where(['media_id '=>$media_id])
            ->join([
                        'Playlists'=>  [
                            'table'      => 'playlists',
                            'type'       => 'LEFT',
                            'conditions' => 'Playlists.id=playlist_id',
             ]])
             ->toArray();

         foreach ($find_media_playlist as $key => $value) {
               array_push($mass_of_id_playlists,$value['Playlists']['id']);
             }    
             return $mass_of_id_playlists;
    }
}
