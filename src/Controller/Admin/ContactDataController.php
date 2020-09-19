<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ContactData Controller
 *
 * @property \App\Model\Table\ContactDataTable $ContactData
 *
 * @method \App\Model\Entity\ContactData[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactDataController extends AppController
{
   
    public function edit($id = null)
    {
        $contactData = $this->ContactData->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactData = $this->ContactData->patchEntity($contactData, $this->request->getData());
            if ($this->ContactData->save($contactData)) {
                $this->Flash->admin_success(__('The contact data has been saved.'));

                return $this->redirect(['controller'=>'contacts','action' => 'index']);
            }
            $this->Flash->error(__('The contact data could not be saved. Please, try again.'));
        }
        $this->set(compact('contactData'));
    }

    
}
