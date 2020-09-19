<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Attributes Controller
 *
 * @property \App\Model\Table\AttributesTable $Attributes
 *
 * @method \App\Model\Entity\Attribute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AttributesController extends AppController
{
    
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
        $attributes = $this->paginate($this->Attributes);
        $this->nav_['attributes'] = true; 

        $this->set(compact('attributes'));
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
        $attribute = $this->Attributes->newEntity();
        if ($this->request->is('post')) {
            $attribute = $this->Attributes->patchEntity($attribute, $this->request->getData());
            if ($this->Attributes->save($attribute)) {
                $this->Flash->admin_success(__('Атрибут додано'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Атрибут ек додано. Спробуйте пізніше'));
        }
        $this->nav_['attributes'] = true; 
        $this->set(compact('attribute','categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Attribute id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $attribute = $this->Attributes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attribute = $this->Attributes->patchEntity($attribute, $this->request->getData());
            if ($this->Attributes->save($attribute)) {
                $this->Flash->admin_success(__('Атрибут змінено.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Атрибут не змінено. Спробуйте пізніше'));
        }
        $this->nav_['attributes'] = true; 
        $this->set(compact('attribute'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attribute id.
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
        $attribute = $this->Attributes->get($id);
        if ($this->Attributes->delete($attribute)) {
            $this->Flash->admin_success(__('Групу атрибутів видалено'));
        } else {
            $this->Flash->admin_error(__('Групу атрибутів не видалено'));
        }

        return $this->redirect(['action' => 'index']);
    }

     public function deletechecked() 
     {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $attribute = $this->Attributes->get($value);
        $this->Attributes->delete($attribute);      
      } 

     $this->Flash->admin_success(__('Атрибути видалено'));
     return $this->redirect(['action' => 'index']);
    }

 public function getListAttributes()
    {
        
        $this->loadModel('AttributesItems');
        $name = $this->request->getQuery('attribute');
        $type = 1;

        $attributes = $this->Attributes->find()->contain('AttributesItems')
        ->where(['Attributes.name LIKE'=>'%'.$name.'%'])
        ->toArray();

        if (empty($attributes)) {
             $attributes = $this->AttributesItems->find()->contain('ParentAttributesItems')
        ->where(['AttributesItems.name  LIKE'=>'%'.$name.'%'])
        ->toArray();
        $type = 2;
        }

         return  $this->response->withType('application/json')
         ->withStringBody(json_encode(
            array('attributes'    => $attributes, 'type' => $type               
              )));
    }
}
