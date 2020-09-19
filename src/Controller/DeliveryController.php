<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Delivery Controller
 *
 *
 * @method \App\Model\Entity\Delivery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliveryController extends AppController
{
     public function initialize()
     {
        parent::initialize();
        $this->Auth->allow(['index']);
        $this->loadComponent('Flash');
        $this->loadModel('Aboutus');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('DeliveryPage');
        $delivery = $this->DeliveryPage->find()->first();;

        $this->set(compact('delivery'));
    }

    /**
     * View method
     *
     * @param string|null $id Delivery id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $delivery = $this->Delivery->get($id, [
            'contain' => []
        ]);

        $this->set('delivery', $delivery);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $delivery = $this->Delivery->newEntity();
        if ($this->request->is('post')) {
            $delivery = $this->Delivery->patchEntity($delivery, $this->request->getData());
            if ($this->Delivery->save($delivery)) {
                $this->Flash->success(__('The delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
        }
        $this->set(compact('delivery'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Delivery id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $delivery = $this->Delivery->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $delivery = $this->Delivery->patchEntity($delivery, $this->request->getData());
            if ($this->Delivery->save($delivery)) {
                $this->Flash->success(__('The delivery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
        }
        $this->set(compact('delivery'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Delivery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $delivery = $this->Delivery->get($id);
        if ($this->Delivery->delete($delivery)) {
            $this->Flash->success(__('The delivery has been deleted.'));
        } else {
            $this->Flash->error(__('The delivery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
