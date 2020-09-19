<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ProducersDiscounts Controller
 *
 * @property \App\Model\Table\ProducersDiscountsTable $ProducersDiscounts
 *
 * @method \App\Model\Entity\ProducersDiscount[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProducersDiscountsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Producers']
        ];
        $producersDiscounts = $this->paginate($this->ProducersDiscounts);
        $this->nav_['producers_discounts'] = true;

        $this->set(compact('producersDiscounts'));
    }

    /**
     * View method
     *
     * @param string|null $id Producers Discount id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $producersDiscount = $this->ProducersDiscounts->get($id, [
            'contain' => ['Producers']
        ]);

        $this->set('producersDiscount', $producersDiscount);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Producers');
        $producer_id = $this->Producers->find('list')->order('name ASC');
        $producersDiscount = $this->ProducersDiscounts->newEntity();
        if ($this->request->is('post')) {
            $producersDiscount = $this->ProducersDiscounts->patchEntity($producersDiscount, $this->request->getData());
            if ($this->ProducersDiscounts->save($producersDiscount)) {
                $this->Flash->admin_success(__('Знижку збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Знижку не збережено'));
        }
        $this->set(compact('producersDiscount', 'producer_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Producers Discount id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Producers');
        $producersDiscount = $this->ProducersDiscounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $producersDiscount = $this->ProducersDiscounts->patchEntity($producersDiscount, $this->request->getData());
            if ($this->ProducersDiscounts->save($producersDiscount)) {
                $this->Flash->success(__('The producers discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The producers discount could not be saved. Please, try again.'));
        }
        $producer_id = $this->Producers->find('list')->order('name ASC');
        $this->set(compact('producersDiscount', 'producer_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Producers Discount id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producersDiscount = $this->ProducersDiscounts->get($id);
        if ($this->ProducersDiscounts->delete($producersDiscount)) {
            $this->Flash->success(__('Знижку видалено'));
        } else {
            $this->Flash->error(__('Знижку не видалено'));
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
        $producersDiscount = $this->ProducersDiscounts->get($value);
        $this->ProducersDiscounts->delete($producersDiscount);      
         
      } 

     $this->Flash->admin_success(__('Знижки видалено'));
     return $this->redirect(['action' => 'index']);
    }
}
