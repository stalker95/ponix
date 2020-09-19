<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 *
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
       
        $this->loadModel('TagsMedia');
        $this->loadModel('Media');
        ini_set('memory_limit', '2048M');
        
    }

    public function index()
    {
        if ($this->user->is_us()):
          return $this->redirect(['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
        endif;
        $tags = $this->paginate($this->Tags);

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => []
        ]);

        $this->set('tag', $tag);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $this->set(compact('tag'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $this->set(compact('tag'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deletetags() {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $tag = $this->Tags->get($value);
        $this->Tags->delete($tag);      
      } 

     $this->Flash->admin_success(__('The Tags has been deleted.'));
     return $this->redirect(['action' => 'index']);
    }

    public function search()
    {
        $this->autoRender = false;
        $media_id= (int)$this->request->getData('media_id', $this->request->getQuery('pageNumber', 1));
        $pageNumber = (int)$this->request->getData('pageNumber', $this->request->getQuery('pageNumber', 1));
        $pageSize =   (int)$this->request->getData('pageSize', $this->request->getQuery('pageSize', 20));
        if ($pageNumber < 1) {
            $pageNumber = 1;
        }
        if ($pageSize < 0) {
            $pageSize = 20;
        }

        $query_find=$this->TagsMedia->find('list',['valueField'=>'tags_id'])->where(['media_id'=>$media_id])->toArray();         
        $query = $this->Tags
            ->find()
            ->select([
                'Tags.id',
                'Tags.name'
            ]);
        if ($query_find) {
            $query->where(['not' => ['Tags.id in' => $query_find]]);
        }
        $query->offset(($pageNumber - 1) * $pageSize)
            ->limit($pageSize);

            if ($this->request->getData('fileName')) {
            $query->where(['Tags.name LIKE \'%'.addslashes($this->request->getData('fileName')).'%\'']);
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

        foreach ($playlists_media as $key => $value) {

        // Fird last count 

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
    
    private function response(array $data = [])
    {
        // if (!headers_sent()) {
        //     header('Content-Type: application/json');
        // }
        return $this->response
            ->withType('json')
            ->withStringBody(
                json_encode($data)
            );
    }

    public function deletechecked($data = null) {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);

     foreach ($ids as  $value) {
      $user = $this->Tags->get($value);
      $playlists_medias = TableRegistry::get('playlists');
      $playlists_media = $playlists_medias->find('all');
      $this->Tags->deleteAll(array('id'=>$value));
  }  
     $this->Flash->admin_success(__('The Tags has been deleted.'));
        return $this->redirect(['action' => 'index']);
    }

    public function searchTags($name = null)
    {
     if ($this->request->is(['patch', 'post', 'put'])) 
     {
        $name = $this->getRequest()->getData('name');
        $tags = $this->Tags->find()->select([])->where([
                'name LIKE'=>'%'.$name.'%',          
        ])->toArray();
          $this->set('tags',$tags);
     }
    }

}
