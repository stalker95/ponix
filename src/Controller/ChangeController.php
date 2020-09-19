<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Change Controller
 *
 *
 * @method \App\Model\Entity\Change[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChangeController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        $this->Auth->allow(['index']);
        $this->loadComponent('Flash');
        $this->loadModel('Aboutus');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Rules');
        $change = $this->Rules->find()->first();

        $this->set(compact('change'));
    }

    /**
     * View method
     *
     * @param string|null $id Change id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $change = $this->Change->get($id, [
            'contain' => []
        ]);

        $this->set('change', $change);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $change = $this->Change->newEntity();
        if ($this->request->is('post')) {
            $change = $this->Change->patchEntity($change, $this->request->getData());
            if ($this->Change->save($change)) {
                $this->Flash->success(__('The change has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The change could not be saved. Please, try again.'));
        }
        $this->set(compact('change'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Change id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $change = $this->Change->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $change = $this->Change->patchEntity($change, $this->request->getData());
            if ($this->Change->save($change)) {
                $this->Flash->success(__('The change has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The change could not be saved. Please, try again.'));
        }
        $this->set(compact('change'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Change id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $change = $this->Change->get($id);
        if ($this->Change->delete($change)) {
            $this->Flash->success(__('The change has been deleted.'));
        } else {
            $this->Flash->error(__('The change could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
