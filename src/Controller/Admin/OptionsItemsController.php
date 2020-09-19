<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * OptionsItems Controller
 *
 * @property \App\Model\Table\OptionsItemsTable $OptionsItems
 *
 * @method \App\Model\Entity\OptionsItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionsItemsController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        $this->loadModel('Options');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Options']
        ];
        $optionsItems = $this->paginate($this->OptionsItems->find()->order('OptionsItems.id DESC'));
        
        $this->nav_['options'] = true;
        $this->set(compact('optionsItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Options Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $optionsItem = $this->OptionsItems->get($id, [
            'contain' => ['Options', 'Products', 'ProductsOptions']
        ]);

        $this->set('optionsItem', $optionsItem);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $optionsItem = $this->OptionsItems->newEntity();
        $options = $this->Options->find()->toArray();
        if ($this->request->is('post')) {
            $optionsItem = $this->OptionsItems->patchEntity($optionsItem, $this->request->getData());
            if ($this->OptionsItems->save($optionsItem)) {
                $this->Flash->admin_success(__('Опцію додано'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Опцію не можна зберегти'));
        }

        $this->nav_['options'] = true;
        $products = $this->OptionsItems->Products->find('list', ['limit' => 200]);
        $this->set(compact('optionsItem', 'options', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Options Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $optionsItem = $this->OptionsItems->get($id, [
            'contain' => []
        ]);
        $parent_option = $this->Options->find()->where(['id' => $optionsItem->option_id])->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $optionsItem = $this->OptionsItems->patchEntity($optionsItem, $this->request->getData());
            if ($this->OptionsItems->save($optionsItem)) {
                $this->Flash->admin_success(__('Опцію змінено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Опцію не змінено'));
        }

       $this->nav_['options'] = true;
        $options = $this->Options->find()->toArray();
        $this->set(compact('optionsItem', 'options', 'products', 'parent_option'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Options Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $optionsItem = $this->OptionsItems->get($id);
        if ($this->OptionsItems->delete($optionsItem)) {
            $this->Flash->admin_success(__('Опцію видалено.'));
        } else {
            $this->Flash->admin_error(__('Опцію не може бути видалено.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function deletechecked() 
    {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $option = $this->OptionsItems->get($value);
        $this->OptionsItems->delete($option);      
      } 

     $this->Flash->admin_success(__('Опції видалено'));
     return $this->redirect(['action' => 'index']);
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

    public function copyElement($id = null)
    {
        
            $Optionsitems = $this->OptionsItems->get($id);

            $newOptionItem = $this->OptionsItems->newEntity();
            $newOptionItem->name = $Optionsitems->name;
            $newOptionItem->option_id = $Optionsitems->option_id;

            if ($this->OptionsItems->save($newOptionItem)) {
                //debug($newOptionItem);
                 $this->Flash->admin_success(__('Опцію скопійовано'));
     return $this->redirect(['action' => 'index']);
            } else {
               // debug($newOptionItem);
            }
        }
    
}
