<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Content Controller
 *
 *
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TermsController extends AppController
{

   public function initialize()
     {
        parent::initialize();
        $this->loadModel('Titles');
    }
   public function index()
    {
        $terms = $this->paginate($this->Terms);
        $title = $this->Titles->find('all')->where(['id'=>4])->toArray();
        $this->set(compact('terms'));
        $this->set(compact('title'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|void
     */
    public function add()
    {
        $terms = $this->Terms->newEntity();
          if ($this->request->is('post')) {
            $terms = $this->Terms->patchEntity($terms, $this->request->getData());
            if ($this->Terms->save($terms)) {
                $this->Flash->admin_success(__('The Terms has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('The Terms could not be saved. Please, try again.'));
        }
        $this->set(compact('terms'));
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
        $terms = $this->Terms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $terms = $this->Terms->patchEntity($terms, $this->request->getData());
            if ($this->Terms->save($terms)) {
                $this->Flash->admin_success(__('The terms has been saved.'));

                return $this->redirect(['controller'=>'content','action' => 'index']);
            }
            $this->Flash->admin_error(__('The terms could not be saved. Please, try again.'));
        }
        $this->set(compact('terms'));
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
         $terms = $this->Terms->get($id);
         if ($this->Terms->delete($terms)) {
            $this->Flash->admin_success(__('The Terms has been deleted.'));
         } else {
            $this->Flash->admin_error(__('The Terms could not be deleted. Please, try again.'));
         }
         return $this->redirect(['action' => 'index']);
    }

    public function editTitle($id = null)
    {
         $title = $this->Titles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $title = $this->Titles->patchEntity($title, $this->request->getData());
            if ($this->Titles->save($title)) {
                $this->Flash->admin_success(__('The title has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('The title could not be saved. Please, try again.'));
        }
        $this->set(compact('title'));
    }

  
}
