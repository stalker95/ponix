<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * SocialIcons Controller
 *
 * @property \App\Model\Table\SocialIconsTable $SocialIcons
 *
 * @method \App\Model\Entity\SocialIcon[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SocialIconsController extends AppController
{
    

    /**
     * Edit method
     *
     * @param string|null $id Social Icon id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $socialIcon = $this->SocialIcons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $socialIcon = $this->SocialIcons->patchEntity($socialIcon, $this->request->getData());
            if ($this->SocialIcons->save($socialIcon)) {
                $this->Flash->admin_success(__('The social icon has been saved.'));

                return $this->redirect(['controller'=>'contacts','action' => 'index']);
            }
            $this->Flash->admin_error(__('The social icon could not be saved. Please, try again.'));
        }
        $this->set(compact('socialIcon'));
    }

    
}
