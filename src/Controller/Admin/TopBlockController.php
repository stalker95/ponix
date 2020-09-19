<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * TopBlock Controller
 *
 *
 * @method \App\Model\Entity\TopBlock[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class TopBlockController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        $this->loadModel('TopBlock');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $topBlock = $this->paginate($this->TopBlock);

        $this->set(compact('topBlock'));
    }

    /**
     * View method
     *
     * @param string|null $id Top Block id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $topBlock = $this->TopBlock->get($id, [
            'contain' => []
        ]);

        $this->set('topBlock', $topBlock);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $topBlock = $this->TopBlock->newEntity();
        if ($this->request->is('post')) {
            $topBlock = $this->TopBlock->patchEntity($topBlock, $this->request->getData());
            if ($this->TopBlock->save($topBlock)) {
                $this->Flash->admin_success(__('The top block has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('The top block could not be saved. Please, try again.'));
        }
        $this->set(compact('topBlock'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Top Block id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $topBlock = $this->TopBlock->get($id, [
            'contain' => []
        ]);
        $old_picture=$topBlock->image;
        if($this->request->is(['patch', 'post', 'put'])) {
            
             $topBlock = $this->TopBlock->patchEntity($topBlock, $this->request->getData());
             if ($this->request->getData('image')['error'] != 0) {
                $topBlock->image=$old_picture;
             }
            if ($this->TopBlock->save($topBlock)) {
             if ($this->request->getData('image')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . 'img' . DS . 'home-top-bg', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $topBlock->image;
                    if ($topBlock->image)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }
            
                    $this->TopBlock->updateAll(['image' => ""], ['id' => $topBlock->id]);    

                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                       $topBlock->image=$filename;
                        $this->TopBlock->updateAll(['image' => $filename], ['id' => $topBlock->id]);
                        
                    }
                }
                $this->Flash->admin_success(__('The Top Block has been updated.'));
                        return $this->redirect(['controller'=>'main','action' => 'index']);
            }
                

        }
        $this->set(compact('topBlock'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Top Block id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $topBlock = $this->TopBlock->get($id);
        if ($this->TopBlock->delete($topBlock)) {
            $this->Flash->success(__('The top block has been deleted.'));
        } else {
            $this->Flash->error(__('The top block could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
