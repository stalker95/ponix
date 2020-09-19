<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Options Controller
 *
 * @property \App\Model\Table\OptionsTable $Options
 *
 * @method \App\Model\Entity\Option[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        $this->loadModel('OptionsItems');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $options = $this->paginate($this->Options->find()->order('Options.position DESC'))->toArray();
        $this->nav_['options_group'] = true;
        $this->set(compact('options'));
    }

    /**
     * View method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $option = $this->Options->get($id, [
            'contain' => []
        ]);

        $this->set('option', $option);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $option = $this->Options->newEntity();
        if ($this->request->is('post')) {
            $option = $this->Options->patchEntity($option, $this->request->getData());
            if ($this->Options->save($option)) {

                
                $this->Flash->admin_success(__('Опцію додано'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Опцію не додано. Спробуйте пізніше'));
        }
        $this->nav_['options_group'] = true;
        $this->set(compact('option'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $option = $this->Options->get($id, [
            'contain' => []
        ]);
        $options_items = $this->OptionsItems->find()->where(['option_id' => $option->id])->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $option = $this->Options->patchEntity($option, $this->request->getData());
            if ($this->Options->save($option)) {

                

                $this->Flash->admin_success(__('Зміни збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено'));
        }
        $this->nav_['options_group'] = true;
        $this->set(compact('option','options_items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Option id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $option = $this->Options->get($id);
        $options_items = $this->OptionsItems->find()->where(['option_id' => $option->id])->toArray();
        if ($this->Options->delete($option)) {

            if (!empty($options_items)) {
                    foreach ($options_items as $key => $value) {
                        $option_item = $this->OptionsItems->get($value['id']);
                        $this->OptionsItems->delete($option_item);
                    }
                }

            $this->Flash->admin_success(__('Опцію видалено'));
        } else {
            $this->Flash->admin_error(__('Опцію не видално. Спробуйте пізніше'));
        }

        return $this->redirect(['action' => 'index']);
    }
   public function deletechecked() {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $option = $this->Options->get($value);
        $this->Options->delete($option);      
        $options_items = $this->OptionsItems->find()->where(['option_id' => $option->id])->toArray();
         if (!empty($options_items)) {
                    foreach ($options_items as $key => $value) {
                        $option_item = $this->OptionsItems->get($value['id']);
                        $this->OptionsItems->delete($option_item);
                    }
                }
      } 

     $this->Flash->admin_success(__('Опції видалено'));
     return $this->redirect(['action' => 'index']);
    }

    public function getListOptions()
    {
        $id = $this->request->getQuery('id_option');

        $options = $this->OptionsItems->find()->where(['option_id' => $id])->toArray();
         return  $this->response->withType('application/json')
         ->withStringBody(json_encode(
            array('options'    => $options,                 
              )));
    }

}
