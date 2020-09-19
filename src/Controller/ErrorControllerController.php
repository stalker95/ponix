<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ErrorController Controller
 *
 *
 * @method \App\Model\Entity\ErrorController[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ErrorControllerController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $errorController = $this->paginate($this->ErrorController);

        $this->set(compact('errorController'));
    }

    /**
     * View method
     *
     * @param string|null $id Error Controller id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $errorController = $this->ErrorController->get($id, [
            'contain' => []
        ]);

        $this->set('errorController', $errorController);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $errorController = $this->ErrorController->newEntity();
        if ($this->request->is('post')) {
            $errorController = $this->ErrorController->patchEntity($errorController, $this->request->getData());
            if ($this->ErrorController->save($errorController)) {
                $this->Flash->success(__('The error controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The error controller could not be saved. Please, try again.'));
        }
        $this->set(compact('errorController'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Error Controller id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $errorController = $this->ErrorController->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $errorController = $this->ErrorController->patchEntity($errorController, $this->request->getData());
            if ($this->ErrorController->save($errorController)) {
                $this->Flash->success(__('The error controller has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The error controller could not be saved. Please, try again.'));
        }
        $this->set(compact('errorController'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Error Controller id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $errorController = $this->ErrorController->get($id);
        if ($this->ErrorController->delete($errorController)) {
            $this->Flash->success(__('The error controller has been deleted.'));
        } else {
            $this->Flash->error(__('The error controller could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
