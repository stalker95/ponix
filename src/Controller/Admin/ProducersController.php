<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Producers Controller
 *
 * @property \App\Model\Table\ProducersTable $Producers
 *
 * @method \App\Model\Entity\Producer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProducersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $producers = $this->paginate($this->Producers);
        
        $this->nav_['producers'] = true; 
        $this->set(compact('producers'));
    }

    /**
     * View method
     *
     * @param string|null $id Producer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $producer = $this->Producers->get($id, [
            'contain' => []
        ]);

        $this->set('producer', $producer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         if (!file_exists(WWW_ROOT  . DS . 'producers')) {
        if (!mkdir(WWW_ROOT  . DS . 'producers', 0755, true)) {
         $this->Flash->admin_error(__('Директорію не знайдено'));
         return;
        }
      }

        $producer = $this->Producers->newEntity();
        if ($this->request->is('post')) {


            $producer = $this->Producers->patchEntity($producer, $this->request->getData());
             if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'producers', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Producers->updateAll(['image' => ""], ['id' => $producer->id]);    
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $producer->image=$filename;
                        $this->Producers->updateAll(['image' => $filename], ['id' => $producer->id]);
                    }
                }
            if ($this->Producers->save($producer)) {

                $this->Flash->admin_success(__('Виробника додано '));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admni_error(__('Виробника не додано спробуйте пізніше'));
        }
        $this->nav_['producers'] = true;
        $this->set(compact('producer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Producer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $producer = $this->Producers->get($id, [
            'contain' => []
        ]);
        $old_picture = $producer->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $producer = $this->Producers->patchEntity($producer, $this->request->getData());
            $producer->image = $old_picture;
             if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'producers', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $oldfile = $target_path . $producer->image;
            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $producer->image=$filename;
                        $this->Producers->updateAll(['image' => $filename], ['id' => $producer->id]);
                    }
                }
            if ($this->Producers->save($producer)) {
                $this->Flash->admin_success(__('Виробник збережений'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Виробник не збережений спробуйте пізніше '));
        }
        $this->nav_['producers'] = true;
        $this->set(compact('producer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Producer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producer = $this->Producers->get($id);
        if ($this->Producers->delete($producer)) {

         $mm_dir = new Folder(WWW_ROOT  . DS . 'producers', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $producer->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
            $this->Flash->admin_success(__('Виробник видалений'));
        } else {
            $this->Flash->admin_error(__('Виробник не видалений. Спробуйте пізніше.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function deletechecked() 
    {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $producer = $this->Producers->get($value);
        $this->Producers->delete($producer);      

         $mm_dir = new Folder(WWW_ROOT  . DS . 'producers', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $producer->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
      } 
     $this->Flash->admin_success(__('Виробників видалено'));
     return $this->redirect(['action' => 'index']);
    }
}
