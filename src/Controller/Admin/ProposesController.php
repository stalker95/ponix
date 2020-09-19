<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Proposes Controller
 *
 * @property \App\Model\Table\ProposesTable $Proposes
 *
 * @method \App\Model\Entity\Propose[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProposesController extends AppController
{
     public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Products');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products']
        ];
        $proposes = $this->paginate($this->Proposes);
        $products = $this->Products->find()->toArray();
        $this->nav_['proposes'] = true; 

        $this->set(compact('proposes', 'products'));
    }

  

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $propose = $this->Proposes->newEntity();
        if ($this->request->is('post')) {
            $propose = $this->Proposes->patchEntity($propose, $this->request->getData());
            if ($this->Proposes->save($propose)) {
                $this->Flash->admin_success(__('Пропозицію додано'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Пропозицію не збережно. Спробуйте пізніше'));
        }
        $product_id = $this->Proposes->Products->find('list');
        $this->nav_['proposes'] = true; 
        $this->set(compact('propose', 'product_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Propose id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $propose = $this->Proposes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propose = $this->Proposes->patchEntity($propose, $this->request->getData());
            if ($this->Proposes->save($propose)) {
                $this->Flash->admin_success(__('Пропозицію збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Пропозицію не збережено. Спробуйте пізніше'));
        }
        $this->nav_['proposes'] = true; 
        $product_id = $this->Proposes->Products->find('list', ['limit' => 200]);
        $this->set(compact('propose', 'product_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Propose id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propose = $this->Proposes->get($id);
        if ($this->Proposes->delete($propose)) {
            $this->Flash->admin_success(__('Пропозицію видалено'));
        } else {
            $this->Flash->admin_error(__('Пропозицію не видалено'));
        }

        return $this->redirect(['action' => 'index']);
    }
        public function deletechecked() {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $propose = $this->Proposes->get($value);
        $this->Proposes->delete($propose);      
         
      } 

     $this->Flash->admin_success(__('Пропозиції видалено'));
     return $this->redirect(['action' => 'index']);
    }
}
