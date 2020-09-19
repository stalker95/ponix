<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 *
 * @method \App\Model\Entity\Dashboard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Users');
        $this->loadModel('Orders');
        $this->nav_['dashboard'] = true; 
        $_users_count = $this->Users->find()->toArray();
        $orders = $this->Orders->find()->toArray();

         $this->set(compact('_users_count','orders'));
    }
}
