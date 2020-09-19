<?php
namespace App\Controller\Admin;
use Cake\ORM\TableRegistry;

use App\Controller\AppController;

/**
 * PlayListController Controller
 *
 *
 * @method \App\Model\Entity\PlayListController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlaylistController extends AppController
{
    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Playlist');
        $this->loadModel('Categories');
        $this->loadModel('Users');
        $this->loadModel('Themes');
        $this->loadModel('Media');
        $this->loadModel('Notifications');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
if ($this->user->is_abs()):
        $playlists = $this->paginate($this->Playlist, [
            'contain' => ['Categories']
        ]);
  else :
      
            $playlists = $this->Playlist->find()->where(['user_id'=>$this->user->id])->contain(['Categories']);
        endif;
        $this->set(compact('playlists'));
    }

    /**
     * View method
     *
     * @param string|null $id Play List Controller id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $playListController = $this->PlayListController->get($id, [
            'contain' => []
        ]);

        $this->set('playListController', $playListController);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $Playlist = $this->Playlist->newEntity();
        if ($this->request->is('post')) {
          // Find unique user for add playlist
           $user_id=$this->getRequest()->getData('Users.0.user_id'); 
           $check_user=$this->Playlist->find('all')->where(['user_id'=> $user_id ])->first(); 
           
           if ($check_user) {
             $this->Flash->admin_error(__('Has been PlayLists with the same US'));
             return $this->redirect(['action' => 'add']);
           }
            $Playlist = $this->Playlist->patchEntity($Playlist, $this->request->getData());
            $Playlist->category_id=$this->getRequest()->getData('Categories.0.category_id'); 
            $Playlist->user_id=$this->getRequest()->getData('Users.0.user_id'); 
            if ($this->Playlist->save($Playlist)) {
                $this->Flash->admin_success(__('The play list controller has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The play list controller could not be saved. Please, try again.'));
        }
        $users=$this->Users->find('list',['keyField' => 'id', 'valueField' => 'lastname'])->where(['is_admin'=> 1 ]);
        $themes=$this->Themes->find('list',['keyField' => 'id', 'valueField' => 'name']);
        $categories=$this->Categories->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $this->set(compact('categories','users'));
        $this->set(compact('themes'));
        $this->set(compact('Playlist'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Play List Controller id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

         $count=$this->Playlist->find('all')->contain('Media')->where(['id'=> $id ])->count();       
        if ($this->request->is(['patch', 'post', 'put'])) {
            $Playlist = $this->Playlist->get($id);
            $Playlist = $this->Playlist->patchEntity($Playlist, $this->request->getData());
            $Playlist->category_id=$this->getRequest()->getData('Playlist.0.Categories');
            $Playlist->name=$this->getRequest()->getData('Playlist.0.name');
            $Playlist->city=$this->getRequest()->getData('Playlist.0.city');
            $Playlist->region=$this->getRequest()->getData('Playlist.0.region');
            $Playlist->theme_id=$this->getRequest()->getData('Playlist.0.Themes');
            //$Playlist->user_id = $this->getRequest()->getData('user_id');
            if ($this->Playlist->save($Playlist)) {
                $this->Flash->admin_success(__('The play list controller has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            else {
$this->Flash->error(__('The play list controller could not be saved. Please, try again.'));
            }
        }
        $Playlist = $this->Playlist
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
        
        


        $categories=$this->Categories->find('list', ['keyField' => 'id', 'keyValue' => 'name']);
        $themes=$this->Themes->find('list',['keyField' => 'id', 'keyValue' => 'name'])->toarray();
        $users=$this->Users->find('all')->where(['is_admin'=>'1'])->toarray();
        $this->set('categories',$categories);   
        $this->set('themes',$themes);   
        $this->set('Playlist',$Playlist);
        $this->set('count',$count);
        $this->set('users',$users);

        $user_id = $this->Auth->user('id');
        $_user   = $this->Users->find()->where(['id'=> $user_id ])->first();
        $this->set('_user',$_user);
    }

    /**
     * Delete method
     *
     * @param string|null $id Play List Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $Playlist = $this->Playlist->get($id);
        if ($this->Playlist->delete($Playlist)) {
            $this->Flash->admin_success(__('The play list controller has been deleted.'));
        } else {
            $this->Flash->admin_error(__('The play list controller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Change position method
     *
     * @param string|null $id Play List Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function rename($data = null)
    {
      
     $Playlist = $this->Playlist->newEntity();

     // Get List of Id table Playlists_media 

     $order=$this->request->getData('order', []);
     $counter=1;
     foreach ($order as $key => $value) {
         // Update rank for table Play_lists_media
         $Playlist->updateRankForMediaPlaylist($counter,$key);
         $counter++;
     }

         
     }
    public function deleteMedia() {
     
      $id;
     foreach ($this->request->getData() as $key => $value) {
         $id=$value[0];
     }
         $this->request->allowMethod(['post', 'delete']);

        $playlists_medias = TableRegistry::get('playlists_media');
        $playlists_media = $playlists_medias->get($id);
        if ($playlists_medias->delete($playlists_media)) {
           $this->response->body($playlists_medias);
           return $this->response;
        }

        return $this->redirect(['action' => 'index']);
    }


    public function insertMediaInPlaylist() {
        $this->autoRender = false;
        $id=(int)$this->request->getData('id', $this->request->getQuery('id', 1));
        $media=$this->request->getData('media', $this->request->getQuery('media'));
        
        $playlists_medias = TableRegistry::get('playlists_media');
        $playlists_media = $playlists_medias->find()->where(['playlist_id'=>$id])
        ->limit(1)
        ->order(['rank' => 'DESC'])
        ->toArray();
        
        $last_id;
        $count = 0;
        foreach ($playlists_media as $key => $value) {

        // Find last rank in playlist 

           $count=$value['rank'];
        }
        
        // Add Associated Data in Table Playlists_media 

        $Playlist = $this->Playlist->get($id);
        $name_playlist=$Playlist->name;
        foreach ($media as $key) {
        $m = $this->Media->get($key);
        $this->Playlist->Media->link($Playlist, [$m]);
        $count++;
        
        // Get last id from table playlists_media
        $last_id=$Playlist->getLastIdPlaylist($id);
        
        $notification= $this->Notifications->newEntity();  
        $notification->insertNotification_New_Media_Playlist($this->user,$name_playlist,1);
        // Set new rank for added Media in Playlist
         $Playlist->setNewRankMedia($last_id,$count);
        }
    }
     public function deletechecked($data = null) {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);

     foreach ($ids as  $value) {
      $playlist = $this->Playlist->get($value);
      $this->Playlist->delete($playlist);    
     }  

      $this->Flash->admin_success(__('The Playlists  has been deleted.'));
      return $this->redirect(['action' => 'index']);
    }

    public function search($name = null)
    {
     if ($this->request->is(['patch', 'post', 'put'])) 
     {
        $name = $this->getRequest()->getData('name');
        $playlists = $this->Playlist->find()->select([])->where([
                'name LIKE'=>'%'.$name.'%',          
        ])->toArray();
          $this->set('playlists',$playlists);
     }
    }


    public function deleteMediaFromPlaylist()
    {

        $playlist = $this->Playlist->newEntity();
        $playlist->deleteMediaFromPlaylist($this->request->getData('playlist_id', $this->request->getQuery('playlist_id')),$this->request->getData('media_id', $this->request->getQuery('media_id')));
    }

       
}
