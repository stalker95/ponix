<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * PublicOfferta Controller
 *
 *
 * @method \App\Model\Entity\PublicOffertum[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PublicOffertaController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','add','quickOrder', 'search', 'authAjax']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Publicss');
        $publicOfferta = $this->Publicss->find()->first();

        $this->set(compact('publicOfferta'));
    }

    /**
     * View method
     *
     * @param string|null $id Public Offertum id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $publicOffertum = $this->PublicOfferta->get($id, [
            'contain' => []
        ]);

        $this->set('publicOffertum', $publicOffertum);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $publicOffertum = $this->PublicOfferta->newEntity();
        if ($this->request->is('post')) {
            $publicOffertum = $this->PublicOfferta->patchEntity($publicOffertum, $this->request->getData());
            if ($this->PublicOfferta->save($publicOffertum)) {
                $this->Flash->success(__('The public offertum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The public offertum could not be saved. Please, try again.'));
        }
        $this->set(compact('publicOffertum'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Public Offertum id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $publicOffertum = $this->PublicOfferta->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $publicOffertum = $this->PublicOfferta->patchEntity($publicOffertum, $this->request->getData());
            if ($this->PublicOfferta->save($publicOffertum)) {
                $this->Flash->success(__('The public offertum has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The public offertum could not be saved. Please, try again.'));
        }
        $this->set(compact('publicOffertum'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Public Offertum id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $publicOffertum = $this->PublicOfferta->get($id);
        if ($this->PublicOfferta->delete($publicOffertum)) {
            $this->Flash->success(__('The public offertum has been deleted.'));
        } else {
            $this->Flash->error(__('The public offertum could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
