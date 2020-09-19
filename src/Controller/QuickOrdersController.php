<?php
namespace App\Controller;

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
        $this->Auth->allow(['index','add','quickOrder']);
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
        $this->loadModel('Settings');
        $this->loadModel('Products');
        $settings = $this->Settings->find()->first();

        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $this->loadModel('QuickOrders');

        $data = $this->request->getData();
      
      $quick_order = $this->QuickOrders->newEntity();

      $quick_order->username = $data['user_name'];
      $quick_order->phone = $data['user_phone'];
      $quick_order->product_id = (int)$data['product_id'];
      $quick_order->date = date("Y-m-d H:i:s");
      $quick_order->status = 0; 

      $product = $this->Products->get($data['product_id']);

       $subject = "Швидке замовлення на сайті http://www.proftorg.in.ua/";
        $text = "Ім'я: ".$data['user_name']." \n Телефон: ".$data['user_phone']." Товар: $product->title";
         $this->sendEmail($settings->email, $subject, $text);

      $this->QuickOrders->save($quick_order);

       if ($this->QuickOrders->save($quick_order)) {
        $this->response->body(json_encode(array('status' => 'true')));
       } else {
       $this->response->body(json_encode(array('status' => $this->QuickOrders->save($quick_order))));
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
            $this->response->body(json_encode(array('status' => $this->QuickOrders->save($quick_order))));
 

    }
}
