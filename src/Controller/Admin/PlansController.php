<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Plans Controller
 *
 * @property \App\Model\Table\PlansTable $Plans
 *
 * @method \App\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlansController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function initialize()
     {
                parent::initialize();

         $this->loadModel('Programs');
     }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users.Programs', 'Programs']
        ];
        $plans = $this->paginate($this->Plans->find('all')->where(['Plans.status'=>0]));
        $programs = $this->Programs->find('all')->toArray();
        $this->set(compact('plans'));
        $this->set(compact('programs'));
    }

    /**
     * View method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => ['Users', 'Programs']
        ]);

        $this->set('plan', $plan);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $plan = $this->Plans->newEntity();
        if ($this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan could not be saved. Please, try again.'));
        }
        $users = $this->Plans->Users->find('list', ['limit' => 200]);
        $programs = $this->Plans->Programs->find('list', ['limit' => 200]);
        $this->set(compact('plan', 'users', 'programs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan could not be saved. Please, try again.'));
        }
        $users = $this->Plans->Users->find('list', ['limit' => 200]);
        $programs = $this->Plans->Programs->find('list', ['limit' => 200]);
        $this->set(compact('plan', 'users', 'programs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plan = $this->Plans->get($id);
        if ($this->Plans->delete($plan)) {
            $this->Flash->success(__('The plan has been deleted.'));
        } else {
            $this->Flash->error(__('The plan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Confirm method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function confirm($user_id, $plan_id, $new_plan)
    {
    

        $plans = \Cake\ORM\TableRegistry::get('plans');
        $plan = $plans->get($plan_id);
        $plan->status = 1;
        \Cake\ORM\TableRegistry::get('plans')->save($plan); 

        $user = $this->Users->get($user_id);
        //$plan = $this->Plans->get($plan_id);
        $user->program_id = $new_plan;
        \Cake\ORM\TableRegistry::get('users')->save($user);
        
        $subject = "Confirmed Plan ";
        $text = "Hello ".$user['firstname']." ".$user['lastname']." your new tariff plan has been confirmed. ";
        $user->sendEmailToUser($user->mail, $subject, $text);

        $this->Flash->admin_success(__('The plan has been updated.'));
                return $this->redirect(['action' => 'index']);

    }

    /**
     * Cancel method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function Cancel($user_id, $plan_id, $new_plan)
    {
     $plans = \Cake\ORM\TableRegistry::get('plans');
        $plan = $plans->get($plan_id);
        $plan->status = 1;
        \Cake\ORM\TableRegistry::get('plans')->save($plan); 

        $user = $this->Users->get($user_id);
        //$plan = $this->Plans->get($plan_id);
        $user->program_id = $new_plan;
        \Cake\ORM\TableRegistry::get('users')->save($user);
        
        $subject = "Confirmed Plan ";
        $text = "Hello ".$user['firstname']." ".$user['lastname']." your new tariff plan has been rejected. ";
        $user->sendEmailToUser($user->mail, $subject, $text);

        $this->Flash->admin_success(__('The plan has been updated.'));
                return $this->redirect(['action' => 'index']);
    }
}
