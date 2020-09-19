<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Logos Controller
 *
 *
 * @method \App\Model\Entity\Logo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogosController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Logos');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $logos = $this->Logos->find()->where(['type'=>1])->toArray();
        $logos_player = $this->Logos->find()->where(['type'=>2])->toArray();
        $this->set(compact('logos'));
        $this->set(compact('logos_player'));
    }

    /**
     * View method
     *
     * @param string|null $id Logo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logo = $this->Logos->get($id, [
            'contain' => []
        ]);

        $this->set('logo', $logo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logo = $this->Logos->newEntity();
        if ($this->request->is('post')) {
            $logo = $this->Logos->patchEntity($logo, $this->request->getData());
            if ($this->Logos->save($logo)) {
                $this->Flash->success(__('The logo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logo could not be saved. Please, try again.'));
        }
        $this->set(compact('logo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Logo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logo = $this->Logos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logo = $this->Logos->patchEntity($logo, $this->request->getData());
            if ($this->Logos->save($logo)) {
             if ($this->request->getData('imgPhoto')['error'] == 0) {
             $mm_dir = new Folder(WWW_ROOT . 'img' . DS . 'logos', true, 0777);
             $target_path = $mm_dir->pwd() . DS;
             $oldfile = $target_path . $logo->image;
                    if ($logo->logo)
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
                        $this->Logos->updateAll(['image' => ""], ['id' => $logo->id]);
                        $this->Logos->updateAll(['image' => $filename], ['id' => $logo->id]);
                    }
                }
                
            }
            $this->Flash->admin_success(__('The logo has been saved.'));
            return $this->redirect(['action' => 'index']);
          }
          else {
            $this->Flash->admin_error(__('The logo could not be saved. Please, try again.'));
         }
        }
        $this->set(compact('logo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Logo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logo = $this->Logos->get($id);
        if ($this->Logos->delete($logo)) {
            $this->Flash->success(__('The logo has been deleted.'));
        } else {
            $this->Flash->error(__('The logo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
