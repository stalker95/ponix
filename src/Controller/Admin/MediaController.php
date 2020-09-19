<?php
namespace App\Controller\Admin;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
/**
 * MediaController Controller
 *
 *
 * @method \App\Model\Entity\MediaController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MediaController extends AppController
{
    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Files');
        $this->loadModel('Playlist');
        $this->loadModel('Categories');
        $this->loadModel('PlaylistsMedia');
        $this->loadModel('Media');
        $this->loadModel('Tags');
        ini_set('memory_limit', '2048M');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
         $uploadData = '';
         $medias  = $this->Media->find('all');
         $user_id = $this->Auth->user('id');
         $_user   = $this->Users->find()->where(['id'=> $user_id ])->first();
         $this->set('uploadData', $uploadData);
         $this->set('medias',$medias);
         $this->set("_user",$_user);
         

    }

    /**
     * View method
     *
     * @param string|null $id Media Controller id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $media_entity= $this->Media->newEntity();
        $media = $this->Media
        ->find()
        ->select([
           'Media.id',
           'Media.name',
           'Media.file',
           'Media.type',
           'Media.active',
           'Media.description',
           'Media.video',

           'Users__firstname' => 'Users.firstname',
           'Users__lastname' => 'Users.lastname',
           'Playlists_Media__id' => 'Playlists_Media.id',
           'Playlists_Media__playlist_id' => 'Playlists_Media.playlist_id',
           'Playlists__id' => 'Playlists.id',
           'Playlists__name' => 'Playlists.name',
           

        ])
        ->join([
                        'Playlists_Media'=>  [
                            'table'      => 'playlists_media',
                            'type'       => 'LEFT',
                            'conditions' => 'Playlists_Media.media_id=Media.id',
         ]])
        ->join([
                        'Playlists'=>  [
                            'table'      => 'playlists',
                            'type'       => 'LEFT',
                            'conditions' => 'Playlists.id=Playlists_Media.playlist_id',
         ]])
       
       ->where(['Media.id'=>$id])
       ->contain('Tags')
       ->contain('Users')
       ->toArray();
        
        $find_media_playlist = $this->PlaylistsMedia
            ->find()
            ->select(['Playlists__id' => 'Playlists.id',
                      'Playlists__name' => 'Playlists.name',
            ])
            ->where(['PlaylistsMedia.media_id '=>$media[0]['id']])
            ->join([
                        'Playlists'=>  [
                            'table'      => 'playlists',
                            'type'       => 'LEFT',
                            'conditions' => 'Playlists.id=PlaylistsMedia.playlist_id',
             ]])
             ->toArray();

$mass = $media_entity->getListOfPlaylist($media[0]['id']);
//debug($mass);
        if (!empty($media[0]['Playlists']['id']))
         {
           // var_dump($media[0]['Playlists_Media']['id']);
          $other_playlists = $this->Playlist
            ->find('list', ['keyField' => 'id', 'keyValue' => 'name'])
            ->where(['id NOT IN'=>$mass])
            ->toArray();
            $this->set("other_playlists", $other_playlists);
         }
         else {
           $other_playlists = $this->Playlist
             ->find('list', ['keyField' => 'id', 'keyValue' => 'name'])
             ->toArray();
             $this->set("other_playlists", $other_playlists);
         }
        //debug($other_playlists);
        $this->set("find_media_playlist", $find_media_playlist);
         if ($this->request->is(['patch', 'post', 'put'])) {
             $media = $this->Media->get($id);
            $media = $this->Media->patchEntity($media, $this->request->getData());
            $media->description=$this->request->getData('Media.0.description');
            $mm_dir = new Folder(WWW_ROOT . 'uploads' . DS . 'files', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $file=$this->request->getData('media.0.Media.name');

            if ($this->request->getData('other_playlists')) {  
               $media->insertMediaPlaylist($this->request->getData('other_playlists'),$id);
            }


         
            
            if ($this->Media->save($media)) {

                // Change Preview for media
                if (!empty($this->request->getData('imgPhoto'))) {
                            $media->ChangePreview($this->request->getData('imgPhoto'),$media->id,$media->name);
                }

                $this->Flash->admin_success(__('The media  has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->admin_error(__('We have problem '));
            }
         }
        $this->set('media', $media);
    }


    

    /**
     * Edit method
     *
     * @param string|null $id Media Controller id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {   
        $media = $this->Media->get($key);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $uploadPath = 'uploads/files/';
            $uploadFile = $uploadPath.$value['name'];
            rename($media->file,$this->request->getData('Media[0][name]'));
             $media->name=$value['name'];
             $media->file=$uploadFile;
             $mm_dir = new Folder(WWW_ROOT . 'files' . DS . 'uploads', true, 0777);
             $target_path = $mm_dir->pwd() . DS;
             $media = $this->Media->get($id['id'][$i]);
             $oldfile = $target_path . $media->name;

            if ($this->Media->save($media)) {
                return $this->redirect(['action' => 'index']);
            }
            
        }
       
    }


   /**
     * Upload files method
     *
     * @param string|null $id Media Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

public function uploadfile() {
            $media = $this->Media->newEntity();
        
        if ($this->request->is('post')) {

            $media->checkExistFile();
            if ($this->request->getData('file.error') == 0) {
                $fileName = time().str_replace(" ", "", $this->request->getData('file.name'));
                $uploadPath = 'uploads/files/';
                $uploadFile = $uploadPath.$fileName;
                $ext = mime_content_type($this->request->getData('file.tmp_name'));
                $extention_of_file = pathinfo($fileName);
                $type;
                $preview;
                $uploadedVideo;

                // Array  extentions of files 

                $list_extention_pictures = array('image/png','image/jpeg','image/gif');
                $list_extention_videos=array('video/quicktime','video/mp4','video/x-msvideo','video/wav','video/x-sgi-movie');
                $list_extention_audios = array('audio/mpeg','audio/x-wav','audio/mpeg');
                
                // Check extentions of uploaded files 

                if (!in_array($ext, $list_extention_pictures) AND !in_array($ext, $list_extention_videos) AND !in_array($ext, $list_extention_audios)) 
                 {
                    $this->Flash->admin_error(__('Extention of file is not supported'));
                    return;
                 }

                 // Create preview for video 
                if (!empty($this->request->getData('thumb'))) {
                  $preview=$media->savePreviewForVideo($this->request->getData('thumb'));
                }
                 
                 // Check if file is proto

                 if (in_array($ext, $list_extention_pictures)) 
                 {
                    $file_name = \Cake\Utility\Security::hash($fileName,'sha1', true).".".$extention_of_file['extension'];
                    $type='image';
                    $uploadedVideo="";
                    $fileName= $file_name;
                    $uploadFile= $file_name;
                 }

                 // Check if file is video

                 if (in_array($ext, $list_extention_videos)) 
                 {
                    $type='video';
                    $uploadedVideo=$fileName;  
                    $uploadFile = \Cake\Utility\Security::hash($fileName,'sha1', true).".".$extention_of_file['extension'];
                    $fileName = $preview;
                 }

                 // Check if file is audio

                 if (in_array($ext, $list_extention_audios)) 
                 {
                    $type='audio';
                    $fileName="default_audio.png";
                    $uploadFile = \Cake\Utility\Security::hash($fileName,'sha1', true).".".$extention_of_file['extension'];
                    $uploadedVideo = "";
                 }

                 // Save file

                if(move_uploaded_file($this->request->getData('file.tmp_name'), WWW_ROOT . 'uploads' . DS . 'files'. DS . $uploadFile)) {
                   
                   $media = $this->Media->patchEntity($media, $this->request->getData(),  ['associated' => ['Tags']]);
                    $media->id_category=$this->request->getData("Categories");
                    $user_id=$this->Auth->user('id');
                    $media->name = $fileName;
                    $media->file = $uploadFile; 
                    $media->video = \Cake\Utility\Security::hash($fileName,'sha1', true).".".$extention_of_file['extension'];
                    $media->user_id = $user_id;
                    $media->type = $type;
                    $media->video = $uploadedVideo;
                    $media->active = true;
                    
                    if ($this->user->is_abs()):
                        $media->is_abs = 1;
                    endif;  
                      $user = $this->Users->newEntity();

                    if ($this->Media->save($media)) {
                      if (!empty($this->request->getData('Users'))) {

                        // Get list Playlist of selected users
                        $mass_playlists=$user->getListPlaylists($this->request->getData('Users'));

                        // Insert playlist with media
                        $user->insert_media_in_playlist($mass_playlists, $media->id);
                        }
                        
                            $this->Flash->admin_success(__('File is uploaded.'));
                            return $this->redirect(['action' => 'index']);
                    }else{
                        $this->Flash->admin_error(__('Unable to upload file, please try again.'));
                    }
                }else{
                    $this->Flash->admin_error(__('Unable to upload file, please try again.'));
                }
            }else{
                $this->Flash->admin_error(__('Please choose a file to upload.'));
            }
        }   
        $users =$this->Users->find('list', ['keyField' => 'id', 'valueField' => 'firstname'])->where(['is_admin' => 1]);
        $categories=$this->Categories->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $tags=$this->Media->Tags->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $this->set('users',$users);
        $this->set('categories',$categories);
        $this->set('media',$media);
        $this->set('tags',$tags);
}


  
    /**
     * Delete method
     *
     * @param string|null $id Media Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {       
        $id=$this->request->getData();
        $length=count($id['id']);
        $this->request->allowMethod(['post', 'delete']);
        $mm_dir = new Folder(WWW_ROOT . 'uploads' . DS . 'files', true, 0777);
        $target_path = $mm_dir->pwd() . DS;

        for ($i=0; $i < $length; $i++) {
            $media = $this->Media->get($id['id'][$i]);

                    $oldfile = $target_path . $media->name;
                    if ($media->name)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }

                    $oldfile = $target_path . $media->file;
                    if ($media->name)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }
            $this->Media->delete($media);
        }
        $this->autoRender = false;
        $medias =json_encode(array($this->Media->find('all')));
        $this->response->withType('json');
        $this->response->withStringBody($medias);
        return $this->response;
    }

 


public function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}


public function uploadpicture() {
        $media = $this->Media->newEntity();
        $users =$this->Users->find('list', ['keyField' => 'id', 'valueField' => 'firstname'])->where(['is_admin' => 1]);
        $categories=$this->Categories->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $tags=$this->Media->Tags->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $this->set('users',$users);
        $this->set('categories',$categories);
        $this->set('media',$media);
        $this->set('tags',$tags);
     }

     
     public function uploadvideo() {
        $media = $this->Media->newEntity();
        $users =$this->Users->find('list', ['keyField' => 'id', 'valueField' => 'firstname'])->where(['is_admin' => 1]);
        $categories=$this->Categories->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $tags=$this->Media->Tags->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $this->set('users',$users);
        $this->set('categories',$categories);
        $this->set('media',$media);
        $this->set('tags',$tags);
     }

     public function uploadaudio() {
        $media = $this->Media->newEntity();
        $users =$this->Users->find('list', ['keyField' => 'id', 'valueField' => 'firstname'])->where(['is_admin' => 1]);
        $categories=$this->Categories->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $tags=$this->Media->Tags->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $this->set('users',$users);
        $this->set('categories',$categories);
        $this->set('media',$media);
        $this->set('tags',$tags);
     }




    public function search()
    {
        $this->autoRender = false;
        $playlist_id= (int)$this->request->getData('playlistid', $this->request->getQuery('pageNumber', 1));
        $pageNumber = (int)$this->request->getData('pageNumber', $this->request->getQuery('pageNumber', 1));
        $pageSize =   (int)$this->request->getData('pageSize', $this->request->getQuery('pageSize', 20));
        if ($pageNumber < 1) {
            $pageNumber = 1;
        }
        if ($pageSize < 0) {
            $pageSize = 20;
        }

        $query_find=$this->PlaylistsMedia->find('list',['valueField'=>'media_id'])->where(['playlist_id'=>$playlist_id])->toArray();         
        $query = $this->Media
            ->find()
            ->select([
                'Media.id',
                'Media.name',
                'Media.file',
                'Media.type',
                'Media.video',
                'Media__category' => 'Categories.name'
            ])->join([
                        'Categories'=>  [
                            'table'      => 'categories',
                            'type'       => 'LEFT',
                            'conditions' => 'Categories.id=Media.id_category',
            ]])
            
            

            ->where(['active'=>1]);
        if ($query_find) {
            $query->where(['not' => ['Media.id in' => $query_find]]);
        }
        $query->offset(($pageNumber - 1) * $pageSize)
            ->limit($pageSize);

        if ($this->request->getData('fileName')) {
            $query->where(['Media.name LIKE \'%'.addslashes($this->request->getData('fileName')).'%\'']);
        }

        if ($this->request->getData('fileType')) {
            $query->where(['IF(Media.type = \'video\', Media.video, Media.file) LIKE \'%.'.addslashes($this->request->getData('fileType')).'\'']);
        }

        $rows = $query->toArray();
        foreach ($rows as &$row) {
            $row['extension'] = strtolower(
                ($row['type'] == 'video') ? pathinfo($row['video'], PATHINFO_EXTENSION) : pathinfo($row['file'], PATHINFO_EXTENSION)
            );
        }
        unset($row);

        return $this->response([
            'status' => 'ok',
            'result' => $rows,
            'nbRows' => $query->count()
        ]);
    }

    private function response(array $data = [])
    {
        
        return $this->response
            ->withType('json')
            ->withStringBody(
                json_encode($data)
            );
    }
    public function rename($data =null) {
        debug($this->request->data);
    }

    public function insertTagsInMedia() {
        $this->autoRender = false;
        $tags = $this->request->getData('tag_ids', $this->request->getQuery('tag_ids'));
        $media_id=$this->request->getData('media_id', $this->request->getQuery('media_id'));
        $media = $this->Media->get($media_id);
        foreach ($tags as $key) {
        $m = $this->Tags->get($key);
        $this->Media->Tags->link($media, [$m]);
      }
    }

    public function deleteTagsMedia() {

        $media = $this->Media->newEntity();
        $tag_id=(int)$this->request->getData('tag_id', $this->request->getQuery('tag_id', 1));
        $media_id=(int)$this->request->getData('media_id', $this->request->getQuery('media_id', 1));

        $media->deleteMediaTags($tag_id,$media_id);
        return $this->response([
            'status' => 'ok',
        ]);

    }
}
        
