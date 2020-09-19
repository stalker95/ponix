<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * UsersPermitions Controller
 *
 * @property \App\Model\Table\UsersPermitionsTable $UsersPermitions
 *
 * @method \App\Model\Entity\UsersPermition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersPermitionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Users');

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if ($this->user->is_us()):
          return $this->redirect(['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
        endif;
        $usersPermitions = $this->UsersPermitions->find('all')->where(['UsersPermitions.status'=>0])->contain(['Users'])->toArray();

        $this->set(compact('usersPermitions'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Permition id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersPermition = $this->UsersPermitions->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('usersPermition', $usersPermition);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersPermition = $this->UsersPermitions->newEntity();
        if ($this->request->is('post')) {
            $usersPermition = $this->UsersPermitions->patchEntity($usersPermition, $this->request->getData());
            if ($this->UsersPermitions->save($usersPermition)) {
                $this->Flash->success(__('The users permition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users permition could not be saved. Please, try again.'));
        }
        $users = $this->UsersPermitions->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersPermition', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Permition id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersPermition = $this->UsersPermitions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersPermition = $this->UsersPermitions->patchEntity($usersPermition, $this->request->getData());
            if ($this->UsersPermitions->save($usersPermition)) {
                $this->Flash->success(__('The users permition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users permition could not be saved. Please, try again.'));
        }
        $users = $this->UsersPermitions->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersPermition', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Permition id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersPermition = $this->UsersPermitions->get($id);
        if ($this->UsersPermitions->delete($usersPermition)) {
            $this->Flash->success(__('The users permition has been deleted.'));
        } else {
            $this->Flash->error(__('The users permition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function confirm($id = null, $user_id = null)
    {
        $usersPermition = $this->UsersPermitions->get($id);
        $usersPermition->status = 1;
        
        $_user = $this->Users->get($user_id);
        if ($this->UsersPermitions->save($usersPermition)) {
            $subject = "Change Permitions";
            $text = "Hello ".$_user->firstname." ".$_user->lastname." your new permition has been confirmed.";
            $_user->setNewPermitionUser($_user,$usersPermition->id_permition,$usersPermition->name_permition,$usersPermition->new_value);
                $this->Flash->success(__('The users permition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
    }

    public function cancel($id = null, $user_id = null)
    {
        $usersPermition = $this->UsersPermitions->get($id);
        $usersPermition->status = 1;
        
        $_user = $this->Users->get($user_id);
        if ($this->UsersPermitions->save($usersPermition)) {

            $subject = "Change Permitions";
            $text = "Hello ".$_user->firstname." ".$_user->lastname." your new permition has been rejected.";
            $_user->sendEmailToUser($_user->mail,$subject,$text);
                $this->Flash->success(__('The users permition has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
    }

    public function confirmAll($ids= null )
    {

     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);

      $permitions = $this->UsersPermitions->find()->where(["id in "=>$ids])->toArray();
      $count = count($permitions);

      for ($i=0;$i<$count;$i++)
      {
        $permitions[$i]->status = 1;
        $this->UsersPermitions->save($permitions[$i]);
        $_user = $this->Users->get($permitions[$i]->user_id);
        $_user->setNewPermitionUser($_user,$permitions[$i]->id_permition,$permitions[$i]->name_permition,$permitions[$i]->new_value);
      }

      $this->Flash->admin_success(__('The Users Permitions has been saved.'));
      return $this->redirect(['action' => 'index']);

    }

    public function cancelAll($ids= null )
    {

     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);

      $permitions = $this->UsersPermitions->find()->where(["id in "=>$ids])->toArray();
      $count = count($permitions);

      for ($i=0;$i<$count;$i++)
      {
        $permitions[$i]->status = 1;
        $this->UsersPermitions->save($permitions[$i]);
        $_user = $this->Users->get($permitions[$i]->user_id);
            $subject = "Change Permitions";
            $text = "Hello ".$_user->firstname." ".$_user->lastname." your new permition has been rejected.";
            $_user->sendEmailToUser($_user->mail,$subject,$text);
      }

      $this->Flash->admin_success(__('The Users Permitions has been saved.'));
      return $this->redirect(['action' => 'index']);

    }
}
