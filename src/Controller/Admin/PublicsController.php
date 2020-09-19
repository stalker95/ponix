<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Publics Controller
 *
 * @property \App\Model\Table\PublicsTable $Publics
 *
 * @method \App\Model\Entity\Public[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PublicsController extends AppController
{
    public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Publicss');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function index()
    {
        $publics = $this->Publicss->find()->first();
         if ($this->request->is(['patch', 'post', 'put'])) {
            $publics = $this->Publicss->patchEntity($publics, $this->request->getData());
            if ($this->Publicss->save($publics)) {
                $this->Flash->admin_success(__('Зміни збережено'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте пізніше'));
        }
        $this->nav_['publics'] = true;
         $this->set(compact('publics'));
        
    }

}
