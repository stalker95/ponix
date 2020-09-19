<?php
namespace App\Controller\Admin;
use Cake\Filesystem\Folder;
use App\Controller\AppController;

/**
 * Solution Controller
 *
 * @property \App\Model\Table\SolutionTable $Solution
 *
 * @method \App\Model\Entity\Solution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SolutionController extends AppController
{

    public function initialize()
     {
        parent::initialize();
       
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $solution = $this->paginate($this->Solution);

        $this->set(compact('solution'));
    }

    /**
     * View method
     *
     * @param string|null $id Solution id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $solution = $this->Solution->get($id, [
            'contain' => []
        ]);

        $this->set('solution', $solution);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $solution = $this->Solution->newEntity();
        if ($this->request->is('post')) {
            $solution = $this->Solution->patchEntity($solution, $this->request->getData());
            if ($this->Solution->save($solution)) {
                $this->Flash->success(__('The solution has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The solution could not be saved. Please, try again.'));
        }
        $this->set(compact('solution'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Solution id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $solution = $this->Solution->get($id, [
            'contain' => []
        ]);
        $old_picture = $solution->image;
         if($this->request->is(['patch', 'post', 'put'])) {
            
             $solution = $this->Solution->patchEntity($solution, $this->request->getData());
             if ($this->request->getData('image')['error'] != 0) {
                $solution->image=$old_picture;
             }
            if ($this->Solution->save($solution)) {
             if ($this->request->getData('image')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . 'img' . DS . 'home-top-bg', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $solution->image;
                    if ($solution->image)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }
            
                    $this->Solution->updateAll(['image' => ""], ['id' => $solution->id]);    

                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                       $solution->image=$filename;
                        $this->Solution->updateAll(['image' => $filename], ['id' => $solution->id]);
                        
                    }
                }
                $this->Flash->admin_success(__('The Solution has been updated.'));
                return $this->redirect(['controller'=>'main','action' => 'index']);
            }
                

        }
        $this->set(compact('solution'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Solution id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $solution = $this->Solution->get($id);
        if ($this->Solution->delete($solution)) {
            $this->Flash->success(__('The solution has been deleted.'));
        } else {
            $this->Flash->error(__('The solution could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
