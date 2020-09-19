<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Managers Controller
 *
 *
 * @method \App\Model\Entity\Manager[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManagersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
       $this->loadModel('Users');
      
       if ($this->user->is_admin() OR $this->user->is_abs()) {
       $users  = $this->paginate($this->Users->find()->where(['is_admin' => 1,'is_admin' => 2,'is_admin' => 3]))->toArray();
       }
       $this->nav_['managers'] = true; 
       $this->set(compact('users'));
    }

    public function add()
    {
        $this->loadModel('Users');

        $_user = $this->Users->newEntity();
         if ($this->request->is('post')) {
         $_user = $this->Users->patchEntity($_user, $this->request->getData()); 

         if ($this->Users->save($_user)) {

            $this->Flash->admin_success(__('Менеджера додано'));
            return $this->redirect(['action' => 'index']);
            } else {
            $this->Flash->admin_error(__('Менеджера не додано. '));
            return $this->redirect(['action' => 'index']);
            
         }
         
     }
        $this->nav_['managers'] = true;
        $this->set(compact('_user'));
    }

    public function edit($id= null) {
      $this->loadModel('Users');
      if (!is_numeric($id) OR  !$this->Users->exists(['id' => $id])) {
        $this->Flash->admin_error(__('Користувача не знайденео'));
        return $this->redirect(['action' => 'index']);
      }
      
      $_user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
           if (!empty($this->request->getData('new_password'))) {
            $_user->password = $this->request->getData('new_password');
           }
            if ($this->Users->save($_user)) {
                $this->Flash->admin_success(__('Данні змінено'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Данні не змінено. Спробуйте пізніше'));
        }
        $this->set('_user',$_user);
        $this->nav_['managers'] = true; 
    }

    public function deletechecked() {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $_user = $this->Users->get($value);
        $this->Users->delete($_user);      
         
      } 

     $this->Flash->admin_success(__('Менеджерів видалено'));
     return $this->redirect(['action' => 'index']);
    }


 
}
