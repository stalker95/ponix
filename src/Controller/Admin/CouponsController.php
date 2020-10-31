<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Category Controller
 *
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CouponsController   extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Coupons');
        $this->loadModel('Attributes');
        $this->loadModel('Users');
    }

    public function index()
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $coupons = $this->paginate($this->Coupons->find('all'));

        $this->nav_['coupons'] = true; 
        $this->set('coupons', $coupons);   
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $coupon   = $this->Coupons->newEntity();

        if ($this->request->is('post')) {
            $coupon = $this->Coupons->patchEntity($coupon, $this->request->getData());
            if ($this->Coupons->save($coupon)) {
                $this->Flash->admin_success(__('Купон додано'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Купон не додано. Спробуйте ще раз '));
        }

        $this->nav_['coupons'] = true; 
        $this->set(compact('coupon'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $coupon = $this->Coupons->get($id);
       
        if ($this->request->is(['patch', 'post', 'put'])) {
             $coupon = $this->Coupons->patchEntity($coupon, $this->request->getData());
            if ($this->Coupons->save($coupon)) {

            $this->Flash->admin_success(__('Купон змінено'));
        } else {
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте ще раз'));

        }

            return $this->redirect(['action' => 'index']);
        } else {
        }
        
         $this->nav_['coupons'] = true; 
        $this->set(compact('coupon'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $this->request->allowMethod(['post', 'delete']);
        $coupon = $this->Coupons->get($id);
        if ($this->Coupons->delete($coupon)) {
           
            $this->Flash->admin_success(__('Купон видалено'));
        } else {
            $this->Flash->admin_error(__('Купон не видалено . Спробуйте ще раз'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deletechecked() {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $coupon = $this->Coupons->get($value);
        $this->Coupons->delete($coupon);      
        
      } 

     $this->Flash->admin_success(__('Купони видалено'));
     return $this->redirect(['action' => 'index']);
    }

     public function search($name = null)
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
     if ($this->request->is(['patch', 'post', 'put'])) 
     {
        $name = $this->getRequest()->getData('name');
        $categories = $this->Categories->find()->select([])->where([
                'name LIKE'=>'%'.$name.'%',          
        ])->toArray();
          $this->set('categories',$categories);
     }
    }

    public function getListCoupons()
    {
        
        $this->loadModel('Coupons');

        $attributes = $this->Coupons->find()->toArray();

         return  $this->response->withType('application/json')
         ->withStringBody(json_encode(
            array('attributes'    => $attributes)));
    }
}
