<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Script Controller
 *
 *
 * @method \App\Model\Entity\Script[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ScriptController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $script = $this->paginate($this->Script);

        $this->set(compact('script'));
    }

    /**
     * View method
     *
     * @param string|null $id Script id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $script = $this->Script->get($id, [
            'contain' => []
        ]);

        $this->set('script', $script);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $script = $this->Script->newEntity();
        if ($this->request->is('post')) {
            $script = $this->Script->patchEntity($script, $this->request->getData());
            if ($this->Script->save($script)) {
                $this->Flash->success(__('The script has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The script could not be saved. Please, try again.'));
        }
        $this->set(compact('script'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Script id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $script = $this->Script->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $script = $this->Script->patchEntity($script, $this->request->getData());
            if ($this->Script->save($script)) {
                $this->Flash->success(__('The script has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The script could not be saved. Please, try again.'));
        }
        $this->set(compact('script'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Script id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $script = $this->Script->get($id);
        if ($this->Script->delete($script)) {
            $this->Flash->success(__('The script has been deleted.'));
        } else {
            $this->Flash->error(__('The script could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
