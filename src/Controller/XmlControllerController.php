<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * XmlController Controller
 *
 *
 * @method \App\Model\Entity\XmlController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class XmlControllerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $xmlController = $this->paginate($this->XmlController);

        $this->set(compact('xmlController'));
    }

    /**
     * View method
     *
     * @param string|null $id Xml Controller id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $xmlController = $this->XmlController->get($id, [
            'contain' => []
        ]);

        $this->set('xmlController', $xmlController);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $xmlController = $this->XmlController->newEntity();
        if ($this->request->is('post')) {
            $xmlController = $this->XmlController->patchEntity($xmlController, $this->request->getData());
            if ($this->XmlController->save($xmlController)) {
                $this->Flash->success(__('The xml controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xml controller could not be saved. Please, try again.'));
        }
        $this->set(compact('xmlController'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Xml Controller id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $xmlController = $this->XmlController->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $xmlController = $this->XmlController->patchEntity($xmlController, $this->request->getData());
            if ($this->XmlController->save($xmlController)) {
                $this->Flash->success(__('The xml controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The xml controller could not be saved. Please, try again.'));
        }
        $this->set(compact('xmlController'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Xml Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $xmlController = $this->XmlController->get($id);
        if ($this->XmlController->delete($xmlController)) {
            $this->Flash->success(__('The xml controller has been deleted.'));
        } else {
            $this->Flash->error(__('The xml controller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
