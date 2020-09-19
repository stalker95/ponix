<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Dashboard Controller
 *
 *
 * @method \App\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubusersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    
    public function index()
    {
        // Check admin role .
        // Id admin role is ABS the find all subUS

        if ($this->user->is_abs()):
            $query =$this->Users->find()->where(['Users.is_admin'=> 0 ])->contain(['Parent']);
        endif;

        // IF admin role is US . Then find all subUsers to this US

        if ($this->user->is_us()):
            $query =$this->Users->find()->where(['Users.parent_id'=> $this->user->id ])->contain(['Parent']);
        endif;
      $this->set('users',$query);

    }

    public function add() {
         $_user = $this->Users->newEntity();

         if ($this->request->is('post')) {
           
         $_user = $this->Users->patchEntity($_user, $this->request->getData());
         $_user->set('is_admin', 0);
         $_user->password = $this->request->getData('new_password');
         $_user->active = 1;
         $_user->set('token', "");
         if ($this->user->is_abs()):
            $_user->set('parent_id',(int)$this->request->getData('users'));
        endif;

         if ($this->user->is_us()):
            $_user->set('parent_id',(int)$this->user->id);
        endif; 


         if ($this->Users->save($_user)) {
            $this->Flash->admin_success(__('The new user has been saved.'));
            return $this->redirect(['action' => 'index']);
         }
            $this->Flash->admin_error(__('The user could not be saved. Please, try again.'));
        }
        $users=$this->Users->find('list', ['keyField' => 'id','valueField' => 'firstname'])->where(['is_admin' => 1]);
        
        $this->set('_user',$_user);
        $this->set('users',$users);
    }

    public function edit($id= null) {

      // Check if exist users .
        
      if (is_numeric($id) && $this->Users->exists(['id' => $id])) {
        $user = $this->Users->get($id, [
            'contain' => ['Parent']
        ]);
        //debug($user);
      }

      else {
        $this->Flash->error(__('User not found'));
        return $this->redirect(['action' => 'index']);
      }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->request->getData()=="new_password") {
                $user->password=$old_password;
            }
            $user->parent_id=$this->request->getData('Parent');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $Parent = $this->Users->find('all')->where(['is_admin' => 1])->toArray();
        //var_dump($Parent);
        $this->set('Parents',$Parent);
        $this->set('_user',$user);
    }

    public function show($id=null) {
         $user = $this->Users->get($id);
         var_dump($user);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The Users has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function deletesubus($data = null) {

     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);

     foreach ($ids as  $value) {
      $user = $this->Users->get($value);
      $this->Users->delete($user);    
     }  
     $this->Flash->admin_success(__('The Users has been deleted.'));
        return $this->redirect(['action' => 'index']);

    
    }
    public function search($name = null)
    {
     if ($this->request->is(['patch', 'post', 'put'])) 
     {
        $name = $this->getRequest()->getData('name');
        $users = $this->Users->find()->select([])->where([
            'is_admin'=>'0',
            'or' => [
                'firstname LIKE'=>'%'.$name.'%',
                'lastname LIKE'=>'%'.$name.'%'
            ]
        ])->toArray();
          $this->set('users',$users);
     }
    }
}
