<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','add','quickOrder', 'search', 'authAjax']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->nav_['orders'] = true;   
        $orders = $this->Paginate($this->Orders
                        ->find()
                        ->order('id DESC'))
                        ->toArray();

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['OrdersItems.Products']
        ]);

        $this->set('order', $order);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $this->set(compact('order'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['OrdersItems.Products']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->admin_success(__('Замовленя збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Замовлення не збережено'));
        }
        $this->set(compact('order'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->admin_success(__('Замовлення видалено'));
        } else {
            $this->Flash->admin_error(__('Замовлення не може бути видалено'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function quickOrder()
    {
        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
        $data = $this->request->getData();
      //  debug($data);

        $this->response->body(json_encode(array('status' => 'true')));
    }

    public function search()
    {
      $this->loadModel('Users');
      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $data = $this->request->getData();

      $user = $this->Users->find('all')->where(['mail' => $data['email']])->first();

      if (empty($user)) {
        $this->response->body(json_encode(array('status' => 'false')));
      } else {
        $this->response->body(json_encode(array('status' => 'true')));
      }
      return $this->response;

    }
        public function authAjax()
    {  
       $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
       
        $data = $this->request->getData();
        $email = $data['email'];
        $password = $data['password'];

        $this->autoRender = false;
        if ($email == null OR $email == "") {
            $this->response->body(json_encode(array('status'=>false, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
             return $this->response; 
        }

        $_user = $this->Users->find()->where(['mail' => $email])->first();
        
        if ($_user == false) {
            $this->response->body(json_encode(array('status'=>false, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
            return $this->response;
        }

        if ((new \Cake\Auth\DefaultPasswordHasher)->check($password, $_user->password) == false) {
            $_user = false;
        }
        
        if ($_user == false) {
            $this->response->body(json_encode(array('status'=>false, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
            return $this->response;
        }

            $this->Auth->setUser($_user);
             $this->response->body(json_encode(array('status'=>true, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз', 'user' => $_user)));
            return $this->response;
    }

}
