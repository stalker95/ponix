<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * QuickOrders Controller
 *
 * @property \App\Model\Table\QuickOrdersTable $QuickOrders
 *
 * @method \App\Model\Entity\QuickOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuickOrdersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','add','quickOrder', 'changeNotes']);
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
        $quickOrders = $this->paginate($this->QuickOrders);
        $this->nav_['quick_orders'] = true;

        $this->set(compact('quickOrders'));
    }

    /**
     * View method
     *
     * @param string|null $id Quick Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $quickOrder = $this->QuickOrders->get($id, [
            'contain' => ['Products']
        ]);

        $this->set('quickOrder', $quickOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $quickOrder = $this->QuickOrders->newEntity();
        if ($this->request->is('post')) {
            $quickOrder = $this->QuickOrders->patchEntity($quickOrder, $this->request->getData());
            if ($this->QuickOrders->save($quickOrder)) {
                $this->Flash->success(__('The quick order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quick order could not be saved. Please, try again.'));
        }
        $products = $this->QuickOrders->Products->find('list', ['limit' => 200]);
        $this->set(compact('quickOrder', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Quick Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $quickOrder = $this->QuickOrders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $quickOrder = $this->QuickOrders->patchEntity($quickOrder, $this->request->getData());
            if ($this->QuickOrders->save($quickOrder)) {
                $this->Flash->success(__('The quick order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The quick order could not be saved. Please, try again.'));
        }
        $products = $this->QuickOrders->Products->find('list', ['limit' => 200]);
        $this->set(compact('quickOrder', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Quick Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $quickOrder = $this->QuickOrders->get($id);
        if ($this->QuickOrders->delete($quickOrder)) {
            $this->Flash->success(__('The quick order has been deleted.'));
        } else {
            $this->Flash->error(__('The quick order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function quickOrder()
    {
        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $this->loadModel('QuickOrders');

        $data = $this->request->getData();
      
      $quick_order = $this->QuickOrders->newEntity();

      $quick_order->username = $data['user_name'];
      $quick_order->phone = $data['user_phone'];
      $quick_order->product_id = $data['product_id'];

      $this->QuickOrders->save($quick_order);

        $this->response->body(json_encode(array('status' => 'true')));
    }

    public function checkOrder()
    {
        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
        $data = $this->request->getData();
        //debug($data);
        $record = $this->QuickOrders->get($data['id_product']);
        $record->status = 1;

        if ($this->QuickOrders->save($record)) {
           $this->response->body(json_encode(array('status' => 'true')));
        }
    }
        public function deletechecked() {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $category = $this->QuickOrders->get($value);
        $this->QuickOrders->delete($category);      
         
      } 

     $this->Flash->admin_success(__('Швидкі замовлення видалено'));
     return $this->redirect(['action' => 'index']);
    }

    public function changeOrder()
    {
        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
        $data = $this->request->getData();
        //debug($data);
        $record = $this->QuickOrders->get($data['id_order']);
        $record->status = $data['status'];

        debug($record);

        if ($this->QuickOrders->save($record)) {
           $this->response->body(json_encode(array('status' => 'true')));
        }
    }

    public function changeNotes()
    {

      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $this->loadModel('QuickOrders');

      $data = $this->request->getData();

      $id = $data['id'];

      $quick_order = $this->QuickOrders->get($id);

      $quick_order->notes = $data['text'];
      $this->QuickOrders->save($quick_order);
            $this->response->body(json_encode(array('status' => $quick_order)));
 

    }


}
