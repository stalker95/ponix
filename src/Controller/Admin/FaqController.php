<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Content Controller
 *
 *
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FaqController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        $this->loadModel('Titles');
    }
   public function index()
    {
        $faq = $this->paginate($this->Faq);
        $title = $this->Titles->find('all')->where(['id'=>3])->toArray();
        $this->set(compact('faq'));
        $this->set(compact('title'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|void
     */
    public function add()
    {
        $faq = $this->Faq->newEntity();
          if ($this->request->is('post')) {
            $faq = $this->Faq->patchEntity($faq, $this->request->getData());
            if ($this->Faq->save($faq)) {
                $this->Flash->admin_success(__('The Faq has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('The Faq could not be saved. Please, try again.'));
        }
        $this->set(compact('faq'));
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
        $faq = $this->Faq->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $this->Faq->patchEntity($faq, $this->request->getData());
            if ($this->Faq->save($faq)) {
                $this->Flash->admin_success(__('The faq has been saved.'));

                return $this->redirect(['controller'=>'faq','action' => 'index']);
            }
            $this->Flash->admin_error(__('The faq could not be saved. Please, try again.'));
        }
        $this->set(compact('faq'));
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
         $faq = $this->Faq->get($id);
         if ($this->Faq->delete($faq)) {
            $this->Flash->admin_success(__('The Faq has been deleted.'));
         } else {
            $this->Flash->admin_error(__('The Faq could not be deleted. Please, try again.'));
         }
         return $this->redirect(['controller'=>'content','action' => 'index']);
    }

  
}
