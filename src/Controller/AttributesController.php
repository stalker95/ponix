<?php
namespace App\Controller;

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
        $attributes = $this->paginate($this->Attributes);

        $this->set(compact('attributes'));
    }

    /**
     * View method
     *
     * @param string|null $id Attribute id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attribute = $this->Attributes->get($id, [
            'contain' => []
        ]);

        $this->set('attribute', $attribute);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $attribute = $this->Attributes->newEntity();
        if ($this->request->is('post')) {
            $attribute = $this->Attributes->patchEntity($attribute, $this->request->getData());
            if ($this->Attributes->save($attribute)) {
                $this->Flash->success(__('Атрибут додано '));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Атрибут не додано. Спробуйте пізніше.'));
        }
        $this->set(compact('attribute'));
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
        $attribute = $this->Attributes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attribute = $this->Attributes->patchEntity($attribute, $this->request->getData());
            if ($this->Attributes->save($attribute)) {
                $this->Flash->success(__('Атрибут змінено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Атрибут не змінено. Спробуйте пізніше'));
        }
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
        $this->request->allowMethod(['post', 'delete']);
        $attribute = $this->Attributes->get($id);
        if ($this->Attributes->delete($attribute)) {
            $this->Flash->success(__('The attribute has been deleted.'));
        } else {
            $this->Flash->error(__('The attribute could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
