<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Programs Controller
 *
 * @property \App\Model\Table\ProgramsTable $Programs
 *
 * @method \App\Model\Entity\Program[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProgramsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $programs = $this->paginate($this->Programs);

        $this->set(compact('programs'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $program = $this->Programs->newEntity();
        if ($this->request->is('post')) {
            $program = $this->Programs->patchEntity($program, $this->request->getData());
            if ($this->Programs->save($program)) {
                $this->Flash->admin_success(__('The program has been saved.'));

                return $this->redirect(['controller'=>'main','action' => 'index']);
            }
            $this->Flash->admin_error(__('The program could not be saved. Please, try again.'));
        }
        $this->set(compact('program'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Program id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $program = $this->Programs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $program = $this->Programs->patchEntity($program, $this->request->getData());
            if ($this->Programs->save($program)) {
                $this->Flash->admin_success(__('The program has been saved.'));

                return $this->redirect(['controller'=>'main','action' => 'index']);
            }
            $this->Flash->admin_error(__('The program could not be saved. Please, try again.'));
        }
        $this->set(compact('program'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Program id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $program = $this->Programs->get($id);
        if ($this->Programs->delete($program)) {
            $this->Flash->admin_success(__('The program has been deleted.'));
        } else {
            $this->Flash->admin_error(__('The program could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller'=>'main','action' => 'index']);
    }
}
