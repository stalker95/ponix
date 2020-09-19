<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Socials Controller
 *
 * @property \App\Model\Table\SocialsTable $Socials
 *
 * @method \App\Model\Entity\Social[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SocialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $socials = $this->paginate($this->Socials);
        $this->nav_['socials'] = true;

        $this->set(compact('socials'));
    }

    public function edit($id = null)
    {
        $social = $this->Socials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $social = $this->Socials->patchEntity($social, $this->request->getData());
            if ($this->Socials->save($social)) {
                $this->Flash->admin_success(__('Данні збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->adminerror(__('Данні не збережено'));
        }
        $this->nav_['socials'] = true;
        $this->set(compact('social'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Social id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $social = $this->Socials->get($id);
        if ($this->Socials->delete($social)) {
            $this->Flash->success(__('The social has been deleted.'));
        } else {
            $this->Flash->error(__('The social could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
