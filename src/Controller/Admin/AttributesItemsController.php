<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * AttributesItems Controller
 *
 * @property \App\Model\Table\AttributesItemsTable $AttributesItems
 *
 * @method \App\Model\Entity\AttributesItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AttributesItemsController extends AppController
{
       public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Attributes');
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

        $this->paginate = [
            'contain' => ['ParentAttributesItems']
        ];
        $attributesItems = $this->paginate($this->AttributesItems->find()->order('AttributesItems.id DESC'));
         $this->nav_['attributes_item'] = true; 

        $this->set(compact('attributesItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Attributes Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attributesItem = $this->AttributesItems->get($id, [
            'contain' => ['ParentAttributesItems', 'ChildAttributesItems']
        ]);

        $this->set('attributesItem', $attributesItem);
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
        $attributesItem = $this->AttributesItems->newEntity();
        if ($this->request->is('post')) {
            $attributesItem = $this->AttributesItems->patchEntity($attributesItem, $this->request->getData());
            if ($this->AttributesItems->save($attributesItem)) {
                $this->Flash->admin_success(__('Атрибут додано'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Атрибут не може бути збережений. Спробуйте пізніше'));
        }
        $this->nav_['attributes_item'] = true; 
        $attributesList = $this->Attributes->find('all')->toArray();
        $this->set(compact('attributesItem', 'attributesList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Attributes Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $attributesItem = $this->AttributesItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attributesItem = $this->AttributesItems->patchEntity($attributesItem, $this->request->getData());
            if ($this->AttributesItems->save($attributesItem)) {
                $this->Flash->admin_success(__('Атрибут збережений '));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admni_error(__('The attributes item could not be saved. Please, try again.'));
        }
        $parentAttributesItems = $this->AttributesItems->ParentAttributesItems->find('list', ['limit' => 200]);
        $parent_id = $this->Attributes->find('list')->toArray();
        $this->set(compact('attributesItem', 'parentAttributesItems', 'parent_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attributes Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $this->request->allowMethod(['post', 'delete']);
        $attributesItem = $this->AttributesItems->get($id);
        if ($this->AttributesItems->delete($attributesItem)) {
            $this->Flash->admin_success(__('Атрибут видалено'));
        } else {
            $this->Flash->admin_error(__('Атрибут не видалено. Спробуйте пізніше'));
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
        $category = $this->AttributesItems->get($value);
        $this->AttributesItems->delete($category);      
      } 

     $this->Flash->admin_success(__('Атрибути видалено'));
     return $this->redirect(['action' => 'index']);
    }
}
