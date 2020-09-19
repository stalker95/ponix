<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Actions Controller
 *
 * @property \App\Model\Table\ActionsTable $Actions
 *
 * @method \App\Model\Entity\Action[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActionsController extends AppController
{
    public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('ActionsProducts');
        $this->loadModel('Products');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $actions = $this->paginate($this->Actions->find()->order('position ASC'));
        $this->nav_['actions'] = true; 
        $this->set(compact('actions'));
    }

    /**
     * View method
     *
     * @param string|null $id Action id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $action = $this->Actions->get($id, [
            'contain' => []
        ]);
      
        $this->set('action', $action);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $this->loadModel('Products');
        $this->loadModel('Producers');
        $action = $this->Actions->newEntity();
        $products = $this->Products->find()->toArray();
        $producers = $this->Producers->find()->toArray();


        if ($this->request->is('post')) {
            $producers = $this->request->getData('producers_id');
           // debug($producers);
            if (!empty($producers)) {
            $products_id = $this->Products->find()->where(['producer_id IN ' => $producers])->toArray();
        }
            $action = $this->Actions->patchEntity($action, $this->request->getData());
            $action->slug = str_replace(" ", "-", $action->slug);
            $action->slug = str_replace(" ", "-", $this->request->getData('slug'));
            $action->slug = strtolower($action->slug);
            $action->date_end = date("Y-m-d H:i:s", strtotime($this->request->getData('date_end'))); 
            $action->created = date("Y-m-d H:i:s");   
            if ($this->Actions->save($action)) { 
                 
                 if (!empty($this->request->getData('product_id'))) {
                foreach ($this->request->getData('product_id') as $key => $value) {
                    $action_product = $this->ActionsProducts->newEntity();
                    $action_product->action_id = $action->id;
                    $action_product->products_id = $value;
                    $this->ActionsProducts->save($action_product);
                }
            }
            if (!empty($products_id)) {
                foreach ($products_id as $key => $value) {
                    $action_product = $this->ActionsProducts->newEntity();
                    $action_product->action_id = $action->id;
                    $action_product->products_id = $value['id'];
                    $this->ActionsProducts->save($action_product);
                }
            }

                if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'actions', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Actions->updateAll(['image' => ""], ['id' => $action->id]);    
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $action->image=$filename;
                        $this->Actions->updateAll(['image' => $filename], ['id' => $action->id]);
                    }
                }
                $this->Flash->admin_success(__('Акцію збережно'));

                return $this->redirect(['action' => 'index']);
            }
            debug($action);
            $this->Flash->admin_error(__('Акцію не збережно. Спробуйте пізніше'));
        }
        $this->nav_['actions'] = true; 
        $this->set(compact('action', 'products', 'producers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Action id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $action = $this->Actions->get($id, [
            'contain' => []
        ]);
        $old_picture = $action->image;
        $product = $this->ActionsProducts->find()->contain('products')->where(['action_id' => $action->id])->toArray();
        $products = $this->Products->find()->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $action = $this->Actions->patchEntity($action, $this->request->getData());
            $action->date_end = date("Y-m-d H:i:s", strtotime($this->request->getData('date_end')));
            $action->image = $old_picture;
            if ($this->Actions->save($action)) {
               
               foreach ($product as $key => $value):
                $action_items = $this->ActionsProducts->get($value['id']);
                $this->ActionsProducts->delete($action_items);
               endforeach;
               if (!empty($this->request->getData('product_id'))) {
               foreach ($this->request->getData('product_id') as $key => $value) {
                    $action_product = $this->ActionsProducts->newEntity();
                    $action_product->action_id = $action->id;
                    $action_product->products_id = $value;
                    $this->ActionsProducts->save($action_product);
                }
            }

                if ($this->request->getData('image.error')['error'] == 0) {
                $mm_dir = new Folder(WWW_ROOT . DS . 'actions', true, 0777);
                $target_path = $mm_dir->pwd() . DS;
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $action->image=$filename;
                        $this->Actions->updateAll(['image' => $filename], ['id' => $action->id]);
                    }
                }
                $this->Flash->admin_success(__('Акцію збережено'));

                return $this->redirect(['action' => 'index']);
            }
debug($action);
            $this->Flash->admin_error(__('Акцію не збережено. Спробуйте пізніше'));
        }
        $this->nav_['actions'] = true; 
        $this->set(compact('action','product','products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Action id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $action = $this->Actions->get($id);
        if ($this->Actions->delete($action)) {
             $mm_dir = new Folder(WWW_ROOT  . DS . 'actions', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $action->image;

            $action_product = $this->ActionsProducts->find()->where(['action_id' => $action->id])->toArray();
            foreach ($action_product as $key => $value) {
               $action_product_item = $this->ActionsProducts->get($value['id']);
               $this->ActionsProducts->delete($action_product_item);
            }

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
            $this->Flash->admin_success(__('Акцію видално'));
        } else {
            $this->Flash->admin_error(__('Акцію не видалено. Спробуйте пізніше'));
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
        $action = $this->Actions->get($value);
        $this->Actions->delete($action);  

        $action_product = $this->ActionsProducts->find()->where(['action_id' => $action->id])->toArray();
            foreach ($action_product as $key => $value) {
               $action_product_item = $this->ActionsProducts->get($value['id']);
               $this->ActionsProducts->delete($action_product_item);
            }

         $mm_dir = new Folder(WWW_ROOT  . DS . 'actions', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $action->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
      } 

     $this->Flash->admin_success(__('Акції видалено'));
     return $this->redirect(['action' => 'index']);
    }

}
