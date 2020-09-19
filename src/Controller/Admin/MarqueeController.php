<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
/**
 * Marquee Controller
 *
 *
 * @method \App\Model\Entity\Marquee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MarqueeController extends AppController
{
    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
       
        $this->loadModel('Playlist');
        $this->loadModel('Media');
        $this->loadModel('Themes');
         $this->loadModel('Marque');
        ini_set('memory_limit', '2048M');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $marques = $this->Marque->find('all')->toArray();

        $this->set(compact('marques'));
 
        /*$playlists = $this->Playlist
        ->find('all')
        ->select([
            'Playlist.id',
            'Playlist.name',
        ])
        ->contain(['Media' => function($q) {
           return $q 
                  ->order('rank ASC'); 
        } 
    ])
        
        ->toArray();
        $playlists=array_unique($playlists);
        $playlists = array_map("unserialize", array_unique(array_map("serialize", $playlists)));

        $this->set(compact('playlists')); */

}

    /**
     * View method
     *
     * @param string|null $id Marquee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $marquee = $this->Marquee->get($id, [
            'contain' => []
        ]);

        $this->set('marquee', $marquee);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $marquee = $this->Marquee->newEntity();
        if ($this->request->is('post')) {
            $marquee = $this->Marquee->patchEntity($marquee, $this->request->getData());
            if ($this->Marquee->save($marquee)) {
                $this->Flash->success(__('The marquee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The marquee could not be saved. Please, try again.'));
        }
        $this->set(compact('marquee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Marquee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
       /* $playlist = $this->Playlist
        ->find('all')
        ->select([
            'Playlist.id',
            'Playlist.name',
            'Playlist.theme_id',
            'Playlist__themes'=>'Themes.name'
            
        ])
        ->contain(['Media' => function($q) {
           return $q 
           ->order('rank ASC'); 
        } 
       ])
        
        ->contain('Themes')
        ->where(['Playlist.id'=>$id])
        ->toArray();

        $videos= array();
        $file;
         foreach ($playlist as $key => $value) {
          
             foreach ($value->media as $key => $values) {
             if ($values['type']=="video") {
                array_push($videos, $values['file']);
             }
           }
       }
        foreach ($playlist as $key => $value) {
          foreach ($value->media as $key => $values) {
             $file=$values['file'];
            break;
          }}

        if ($this->request->is(['patch', 'post', 'put'])) {
             $playlist = $this->Playlist->get($id);
            $playlist = $this->Playlist->patchEntity($playlist, $this->request->getData());
            $playlist->theme_id=$this->request->getData('themes');
            if ($this->Playlist->save($playlist)) {
                $this->Flash->success(__('The marquee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The marquee could not be saved. Please, try again.'));
        }
                $playlist=array_unique($playlist);
        $playlist = array_map("unserialize", array_unique(array_map("serialize", $playlist)));
                $themes=$this->Themes->find('list',['keyField' => 'id', 'keyValue' => 'name']);

        $this->set(compact('themes'));      
        $this->set(compact('playlist'));
        $this->set(compact('videos'));
        $this->set(compact('file')); */

        $marques = $this->Marque->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $marques = $this->Marque->patchEntity($marques, $this->request->getData());

            if ($this->Marque->save($marques)) {
                if ($this->request->getData('imgPhoto')['error'] == 0) {
             $mm_dir = new Folder(WWW_ROOT . 'uploads' . DS . 'logo', true, 0777);
             $target_path = $mm_dir->pwd() . DS;
             $oldfile = $target_path . $marques->logo;
                    if ($marques->logo)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }
                if ($this->request->getData('imgPhoto')['error'] == 0) {
                    $img = $this->request->getData('imgPhoto');
                  
                    if ($img['name']!="") {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                         $this->Marque->updateAll(['logo' => ""], ['id' => $marques->id]);
                        $this->Marque->updateAll(['logo' => $filename], ['id' => $marques->id]);

                    }
                    
                }
            }
            $this->Flash->admin_success(__('The marquee has been saved.'));
                  return $this->redirect(['action' => 'index']);

    }
    else {
        $this->Flash->admin_error(__('The marquee could not be saved.'));
                  return $this->redirect(['action' => 'index']);
    }
}
}

    /**
     * Delete method
     *
     * @param string|null $id Marquee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $marquee = $this->Marquee->get($id);
        if ($this->Marquee->delete($marquee)) {
            $this->Flash->success(__('The marquee has been deleted.'));
        } else {
            $this->Flash->error(__('The marquee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
