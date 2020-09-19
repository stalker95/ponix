<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * About Controller
 *
 *
 * @method \App\Model\Entity\About[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AboutController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $about = $this->paginate($this->About);

        $this->set(compact('about'));
    }

    /**
     * View method
     *
     * @param string|null $id About id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $about = $this->About->get($id, [
            'contain' => []
        ]);

        $this->set('about', $about);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $about = $this->About->newEntity();
        if ($this->request->is('post')) {
            $about = $this->About->patchEntity($about, $this->request->getData());
            if ($this->About->save($about)) {
                $this->Flash->success(__('The about has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The about could not be saved. Please, try again.'));
        }
        $this->set(compact('about'));
    }

    /**
     * Edit method
     *
     * @param string|null $id About id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        $about = $this->About->get($id, [
            'contain' => []
        ]);
         $old_picture=$about->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $about = $this->About->patchEntity($about, $this->request->getData());
            if ($this->request->getData('image')['error'] != 0) {
                $about->image=$old_picture;
            }
            if ($this->About->save($about)) {
                if ($this->request->getData('image')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . 'img' . DS . 'about', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $about->image;
                    if ($about->image)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }
            
                    $this->About->updateAll(['image' => ""], ['id' => $about->id]);    

                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                       $about->image=$filename;
                        $this->About->updateAll(['image' => $filename], ['id' => $about->id]);
                        
                    }
                }
                $this->Flash->admin_success(__('The about has been saved.'));

                return $this->redirect(['controller'=>'main','action' => 'index']);
            }
            $this->Flash->error(__('The about could not be saved. Please, try again.'));
        }
        $this->set(compact('about'));
    }

    /**
     * Delete method
     *
     * @param string|null $id About id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $about = $this->About->get($id);
        if ($this->About->delete($about)) {
            $this->Flash->success(__('The about has been deleted.'));
        } else {
            $this->Flash->error(__('The about could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
