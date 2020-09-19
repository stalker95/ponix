<?php
namespace App\Controller\Admin;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Dashboard Controller
 *
 *
 * @method \App\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeeController extends AppController
{


    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Playlist');
        $this->loadModel('Programs');
        $this->loadModel('Users');
        $this->loadModel('Media');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    
    public function index()
    {
        if ($this->user->is_abs()):
         $query =$this->Users->find()->contain(['Programs'])->where(['is_admin'=> 1 ]);
        else :
            $query =$this->Users->find()->contain(['Programs'])->where(['user_id'=>$this->user->id]);
        endif;
         
         $this->set('users',$query);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|void
     */

    public function add() {
         $_user = $this->Users->newEntity();
         if ($this->request->is('post')) {
         $_user = $this->Users->patchEntity($_user, $this->request->getData()); 
         $_user->password=$this->getRequest()->getData('new_password');       
         $_user->set('is_admin',1);
         $_user->active = 1;
         if ($this->Users->save($_user)) {
            $_user->createPlayListUser();
            $_user->setHimPlayListABSFiles($_user->id);
            $this->Flash->admin_success(__('The new user has been saved.'));
               return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('The user could not be saved. Please, try again.'));
        }
        $programs = $this->Programs->find('all')->toArray();
        $this->set(compact('_user'));
        $this->set(compact('programs'));
    }

    /**
     * Edit method
     *
     * @return \Cake\Http\Response|void
     */

    public function edit($id= null) {
      if (!is_numeric($id) OR  !$this->Users->exists(['id' => $id])) {

        $this->Flash->admin_error(__('User not found'));
        return $this->redirect(['action' => 'index']);
      }
      $user = $this->Users->get($id, [
            'contain' => ['Parent','Programs']
        ]);
      $old_password=$user->new_password;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->request->getData()=="new_password") {
                $user->password=$old_password;
            }
            $user->allow_delete = $this->request->getData('allow_delete');
            $user->allow_write = $this->request->getData('allow_write');
            $user->allow_edit = $this->request->getData('allow_edit');

            if ($this->Users->save($user)) {
                if ($user->active)
                {
                    $user->sendNotificationEmail($user->mail);
                }
                $this->Flash->admin_success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('The user could not be saved. Please, try again.'));
        }
        $programs = $this->Programs->find('all')->where(['id NOT IN'=>$user->program['id']])->toArray();
        $this->set('_user',$user);
        $this->set('programs',$programs);
    }
    
    /**
     * Edit method
     *
     * @return \Cake\Http\Response|void
     */

    public function show($id=null) {
         $user = $this->Users->get($id);
         var_dump($user);
    }

   /**
     * Delete method
     *
     * @return \Cake\Http\Response|void
     */
   
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $_user = $this->Users->get($id);
        $media = $this->Media->newEntity();
        if ($this->Users->delete($_user)) {

            // Delete him subUsers
            $_user->deleteHimSubUsers($_user->id);
            $media->deleteIt($_user->id);
            $this->Flash->admin_success(__('The Users has been deleted.'));
        } else {
            $this->Flash->admin_error(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete checked  method
     *
     * @return \Cake\Http\Response|void
     */

    public function deletechecked($data = null) 
    {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
     // All secected US
     foreach ($ids as  $value) {
      $user = $this->Users->get($value);
      $this->Users->delete($user);   

      // Delete him subUsers
       $user->deleteHimSubUsers($user->id);

     }  
     $this->Flash->admin_success(__('The Users has been deleted.'));
        return $this->redirect(['action' => 'index']);
     }

    /**
     * Search  method
     *
     * @return \Cake\Http\Response|void
     */

    public function search($name = null)
    {
     if ($this->request->is(['patch', 'post', 'put'])) 
     {
        
        $name = $this->getRequest()->getData('name');
        $users = $this->Users->find()->select([])->where([
            'is_admin'=>'1',
            'or' => [
                'firstname LIKE'=>'%'.$name.'%',
                'lastname LIKE'=>'%'.$name.'%'
            ]
        ])->toArray();
          $this->set('users',$users);
     }
    }
}
