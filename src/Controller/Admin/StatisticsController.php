<?php
namespace App\Controller\Admin;
use Cake\Filesystem\Folder;
use App\Controller\AppController;

/**
 * Statistic Controller
 *
 *
 * @method \App\Model\Entity\Statistic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatisticsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $statistics = $this->paginate($this->Statistics);

        $this->set(compact('statistics'));
    }

    /**
     * View method
     *
     * @param string|null $id Statistic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statistic = $this->Statistic->get($id, [
            'contain' => []
        ]);

        $this->set('statistic', $statistic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statistic = $this->Statistic->newEntity();
        if ($this->request->is('post')) {
            $statistic = $this->Statistic->patchEntity($statistic, $this->request->getData());
            if ($this->Statistic->save($statistic)) {
                $this->Flash->success(__('The statistic has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The statistic could not be saved. Please, try again.'));
        }
        $this->set(compact('statistic'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Statistic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

       $statistic = $this->Statistics->get($id, [
            'contain' => []
        ]);
        $old_picture = $statistic->image;
         if($this->request->is(['patch', 'post', 'put'])) {
            
             $statistic = $this->Statistics->patchEntity($statistic, $this->request->getData());
             if ($this->request->getData('image')['error'] != 0) {
                $statistic->image=$old_picture;
             }
            if ($this->Statistics->save($statistic)) {
             if ($this->request->getData('image')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . 'img' . DS . 'statistics', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $statistic->image;
                    if ($statistic->image)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }
            
                    $this->Statistics->updateAll(['image' => ""], ['id' => $statistic->id]);    

                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                       $statistic->image=$filename;
                        $this->Statistics->updateAll(['image' => $filename], ['id' => $statistic->id]);
                    }
                }
                $this->Flash->admin_success(__('The Statistic has been updated.'));
                return $this->redirect(['controller'=>'main','action' => 'index']);
            }
        }
        $this->set(compact('statistic'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Statistic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statistic = $this->Statistic->get($id);
        if ($this->Statistic->delete($statistic)) {
            $this->Flash->success(__('The statistic has been deleted.'));
        } else {
            $this->Flash->error(__('The statistic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
