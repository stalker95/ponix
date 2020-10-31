<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Liqpays Controller
 *
 * @property \App\Model\Table\LiqpaysTable $Liqpays
 *
 * @method \App\Model\Entity\Liqpay[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LiqpaysController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $liqpays = $this->paginate($this->Liqpays);

        $this->set(compact('liqpays'));
    }

    /**
     * View method
     *
     * @param string|null $id Liqpay id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $liqpay = $this->Liqpays->get($id, [
            'contain' => []
        ]);

        $this->set('liqpay', $liqpay);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $liqpay = $this->Liqpays->newEntity();
        if ($this->request->is('post')) {
            $liqpay = $this->Liqpays->patchEntity($liqpay, $this->request->getData());
            if ($this->Liqpays->save($liqpay)) {
                $this->Flash->success(__('The liqpay has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The liqpay could not be saved. Please, try again.'));
        }
        $this->set(compact('liqpay'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Liqpay id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $liqpay = $this->Liqpays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $liqpay = $this->Liqpays->patchEntity($liqpay, $this->request->getData());
            if ($this->Liqpays->save($liqpay)) {
                $this->Flash->admin_success(__('Зміни збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено'));
        }
        $this->set(compact('liqpay'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Liqpay id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $liqpay = $this->Liqpays->get($id);
        if ($this->Liqpays->delete($liqpay)) {
            $this->Flash->success(__('The liqpay has been deleted.'));
        } else {
            $this->Flash->error(__('The liqpay could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
