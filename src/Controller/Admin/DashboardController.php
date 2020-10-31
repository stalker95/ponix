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
        $this->loadModel('Statistics');
        $this->nav_['dashboard'] = true; 
        $_users_count = $this->Users->find()->toArray();
        $orders = $this->Orders->find()->toArray();

        $month = date('m');
        $year = date('Y');

        $statistics = $this->Statistics->find('all')->where(['year'=>$year])->where(['month'=>$month])->toArray();

        $final = [];

        for ($i=1; $i <=30 ; $i++) { 
            $final[$i] = [];
            $final[$i]['amount'] = 0;
        }

        $total = array_column($orders, 'total');
        $total_orders = 0;

        foreach ($total as $key => $value) {
            $total_orders = $total_orders + $value;
        }

        foreach ($statistics as $key => $value) {
            
                 $final[$value['day']]['amount'] += 1;
            
        }
      //  debug($final);

         $this->set(compact('_users_count','orders', 'final', 'total_orders'));
    }
}
