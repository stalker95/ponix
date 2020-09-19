<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * AbsMedia Controller
 *
 * @property \App\Model\Table\AbsMediaTable $AbsMedia
 *
 * @method \App\Model\Entity\AbsMedia[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AbsMediaController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Media');
        $this->loadModel('AbsMedia');
        $this->loadModel('Categories');

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if ($this->user->is_us()):
          return $this->redirect(['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
        endif;
        $absMedia = $this->AbsMedia->find('all')->contain(['Media','Media.Users'])->toArray();
        //debug($absMedia);
        $this->set(compact('absMedia'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $absMedia = $this->AbsMedia->newEntity();
        if ($this->request->is('post')) {
            $absMedia = $this->AbsMedia->patchEntity($absMedia, $this->request->getData());
            if ($this->AbsMedia->save($absMedia)) {
                $this->Flash->success(__('The abs media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abs media could not be saved. Please, try again.'));
        }
        $media = $this->AbsMedia->Media->find('list', ['limit' => 200]);
        $this->set(compact('absMedia', 'media'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Abs Media id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        $absMedia = $this->AbsMedia->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $absMedia = $this->AbsMedia->patchEntity($absMedia, $this->request->getData());
            if ($this->AbsMedia->save($absMedia)) {
                $this->Flash->success(__('The abs media has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The abs media could not be saved. Please, try again.'));
        }
        $media = $this->AbsMedia->Media->find('list', ['limit' => 200]);
        $this->set(compact('absMedia', 'media'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Abs Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $absMedia = $this->AbsMedia->get($id);
        if ($this->AbsMedia->delete($absMedia)) {

            $absMedia->deleteMediaFromPlaylist($absMedia->media_id);
            $this->Flash->admin_success(__('The abs media has been deleted.'));
        } else {
            $this->Flash->admin_error(__('The abs media could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Search method
     *
     * @param string|null $id Abs Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function search()
    {
         $pageNumber = (int)$this->request->getData('pageNumber', $this->request->getQuery('pageNumber', 1));
        $pageSize =   (int)$this->request->getData('pageSize', $this->request->getQuery('pageSize', 20));
        $this->autoRender = false;
        if ($pageNumber < 1) {
            $pageNumber = 1;
        }
        if ($pageSize < 0) {
            $pageSize = 20;
        }

        $query_find=$this->AbsMedia->find('list',['valueField'=>'media_id'])->toArray();         
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

    /**
     * Responce method
     *
     * @param string|null $id Abs Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    private function response(array $data = [])
    {
        
        return $this->response
            ->withType('json')
            ->withStringBody(
                json_encode($data)
            );
    }

    /**
     * Insert Media in Abs Playlist method
     *
     * @param string|null $id Abs Media id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function insertMediaInABSPlaylist() 
    {

       $this->autoRender = false;
       $media=$this->request->getData('media', $this->request->getQuery('media'));
       foreach ($media as $key => $value): 
         $absMedia = $this->AbsMedia->newEntity();
         $absMedia->media_id = $value;
          if ($this->AbsMedia->save($absMedia))
           {
            $absMedia->insertMediaInPlaylist($absMedia->media_id);
           } 
       endforeach;
       
    }

}
