<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Actions Controller
 *
 * @property \App\Model\Table\ActionsTable $Actions
 *
 * @method \App\Model\Entity\Action[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActionsController extends AppController
{
    public function initialize()
    {
        
        parent::initialize();
        $this->Auth->allow(['view','index']);
        $this->loadModel('Products');
        $this->loadModel('ActionsProducts');
        $this->nav_['users'] = true;
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $data_today = date('Y-m-d H:i:s');
        $new_date = date('Y-m-d H:i:s', strtotime($data_today));

        $_monthsList = array(
            ".01." => "Січня",
            ".02." => "Лютого",
            ".03." => "Березня",
            ".04." => "Квітня",
            ".05." => "Травня",
            ".06." => "Червня",
            ".07." => "Липня",
            ".08." => "Серпня",
            ".09." => "Вересня",
            ".10." => "Жовтня",
            ".11." => "Листопада",
            ".12." => "Грудня"
        );

        $actions = $this->paginate($this->Actions->find()->where(['Actions.date_end >' => $new_date]))->toArray();

        //debug($actions);


        foreach ($actions as $key => $value):
         $datetime1 = date_create($value['date_end']); 
         $datetime2 = date_create($data_today); 
  
         // calculates the difference between DateTime objects 
         $interval = date_diff($datetime2, $datetime1); 
         $_mD = date(".m.", strtotime($value['date_end']));
         $value['month_end']   = $_monthsList[$_mD];
         $value['day_end'] = date('j', strtotime($value['date_end']));

         $_mD = date(".m.", strtotime($value['created']));
         $value['month_begin'] = $_monthsList[$_mD];
         $value['day_begin'] = date('j', strtotime($value['created']));
         $difference = (int)$interval->format('%R%a');

         $value['days_left'] = $difference;
         endforeach;

        $this->set(compact('actions'));
    }

    /**
     * View method
     *
     * @param string|null $id Action id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $action = $this->Actions->find()->where(['slug' => $slug])->first();
        $actions_products = $this->ActionsProducts->find()->select('products_id')->where(['action_id' => $action->id])->toArray();
       // debug($actions_products);
         $this->paginate = [
                'limit' => '9'
            ];
        $id_products = array_column((array)$actions_products, 'products_id');
       // debug($id_products);

        if (!empty($id_products)):

        

        $max_price = $this->Products->find('all',[
                    'fields' => array('amount' => 'MAX(Products.price)')])->where(['id IN ' => $id_products])->toArray();

        endif;

        //$products = [];
        
        $min_price = 0;
        $current_value_min = 0;
        
        
        if (isset($max_price)):
            $max_price = $max_price[0]['amount'] * 30;
            $current_value_max = $max_price;
        else: 
            $max_price = 0;
            $current_value_max = 0;
        endif;
        

       if ($this->request->is(['get']) AND isset($this->request['?']['_method'])  ) {
        $action = $this->Actions->find()->where(['slug' => $slug])->first();
                $actions_products = $this->ActionsProducts->find()->select('products_id')->where(['action_id' => $action->id])->toArray();
       
$id_products = array_column((array)$actions_products, 'products_id');
           if (!empty($id_products)):
            $query_for_products = $this->Products
                                        ->find()
                                        ->contain(['Actions','Discounts','Rewiev','ActionsProducts','ActionsProducts.Actions'])
                                        ->where(['price * 30 >=' => $this->request['?']['start_price']])
                                        ->where(['id IN ' => $id_products])
                                        ->where(['price * 30 <=' => $this->request['?']['end_price']]);
            $this->paginate = [
                'limit' => $this->request['?']['count_display']
            ];
            if ($this->request['?']['sort_by'] == "За спаданням ціни") {
                $products = $this->Paginate($query_for_products->order('price DESC'))->toArray();
            }

            if ($this->request['?']['sort_by'] == "За зростанням ціни") {
                $products = $this->Paginate($query_for_products->order('price ASC'))->toArray();
            }

            if ($this->request['?']['sort_by'] == "Акційні") {
                $this->loadModel('ActionsProducts');
                $products_actions = $this->ActionsProducts->find()->toArray();
                $id_products_actions = array_column($products_actions, 'products_id');
                
                $this->set('actions', true);
                $products = $this->Paginate($query_for_products->where(['id IN ' => $id_products_actions]))
                ->toArray();
            }

            $products = $this->Paginate($query_for_products)->toArray();
            $this->set('products', $products);
        else:
            $products = [];
        endif;

            $min_value  = $this->request['?']['start_price'];
          $max_value  = $this->request['?']['end_price'];
          $this->set('min_price', $min_value);
          $this->set('max_price', $max_value);
          $this->set('count_display', $this->request['?']['count_display']);
           $this->set('sort_by', $this->request['?']['sort_by']);
          


       }
       else {

if (!empty($id_products)):

  //  debug($id_products);

        $products = $this->Paginate($this->Products->find()->contain(['Rewiev','Discounts','Actions'])->where(['id IN ' => $id_products]))->toArray();
       // debug($products);
        $this->set(compact('products'));

        $max_price = $this->Products->find('all',[
                    'fields' => array('amount' => 'MAX(Products.price)')])->where(['id IN ' => $id_products])->toArray();
        endif;

         if (isset($max_price)){
            $max_price = $max_price[0]['amount'] * 30;
            $current_value_max = $max_price;
        } else {
            $max_price = 0;
            $current_value_max = 0;
        }
                  $this->set('max_price', $max_price);
        $this->set('min_price', $min_price);
        $this->set('current_value_min', $current_value_min);
        $this->set('current_value_max', $current_value_max);
       }


        $this->set('current_value_min', $current_value_min);
        $this->set('current_value_max', $current_value_max);

       // debug($action);

        $this->set('action', $action);
        //$this->set('max_price', $max_price);
        //$this->set('products', $products);
    }

}
