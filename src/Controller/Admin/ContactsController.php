<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Contacts Controller
 *
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $contacts = $this->Contacts->find()->first();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contacts = $this->Contacts->patchEntity($contacts, $this->request->getData());
            if ($this->Contacts->save($contacts)) {
                $this->Flash->admin_success(__('Зміни збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте пізніше'));
        }
        $this->nav_['contacts'] = true;
        $this->set(compact('contacts'));
    }

}
