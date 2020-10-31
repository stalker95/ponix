<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Producers Controller
 *
 * @property \App\Model\Table\ProducersTable $Producers
 *
 * @method \App\Model\Entity\Producer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProducersController extends AppController
{
     public function initialize()
    {
        
        parent::initialize();
        $this->Auth->allow(['index','view']);
        $this->loadModel('Products');
        $this->nav_['users'] = true;
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $producers = $this->paginate($this->Producers);

        $this->set(compact('producers'));
    }

    /**
     * View method
     *
     * @param string|null $id Producer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
         $this->paginate = [
                'limit' => '9'
            ];
        $data_today = date('Y-m-d H:i:s');
        $new_date = date('Y-m-d H:i:s', strtotime($data_today));

        $producer = $this->Producers->find()->where(['slug' => $slug])->first();
        $producers_list = $this->Producers->find('all')->toArray();

        $title = $producer->title;
        $description = $producer->description_page;
        $keywords = $producer->keywords;

        $products = $this->Paginate($this->Products->find()
            ->contain(['ActionsProducts.Actions' => [
                                                                     'conditions' => [
                                                                       'Actions.date_end >' => $new_date
            ]],'Producers','Producers.ProducersDiscounts','Discounts','Wishlists','Rewiev'=> [
                                                                     'conditions' => [
                                                                       'Rewiev.status' => 2
            ]
        ],'ProductsOptions.OptionsItems.Options'
        ])->where(['producer_id' => $producer->id]))->toArray();


        //debug($products);
         $min_price = 0;
        $current_value_min = 0;

         $max_price = $this->Products->find('all',[
                    'fields' => array('amount' => 'MAX(Products.price)')])->where(['producer_id' => $producer->id])->toArray();
        $max_price = $max_price[0]['amount'] * 30;
        $current_value_max = $max_price;

         $this->viewBuilder()->setLayout('producer');
         if ($this->request->is(['get']) AND isset($this->request['?']['_method'])  AND $this->request['?']['_method'] == 'PUT' ) {

            $query_for_products = $this->Products
                                        ->find()
                                        ->contain(['Actions','Discounts','Rewiev'=> [
                                                                     'conditions' => [
                                                                       'Rewiev.status' => 2
            ]
        ],'ActionsProducts','ActionsProducts.Actions','Producers','Producers.ProducersDiscounts','ProductsOptions.OptionsItems.Options'])
                                        ->where(['price * 30 >=' => $this->request['?']['start_price']])
                                        ->where(['producer_id' => $producer->id])
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

            $min_value  = $this->request['?']['start_price'];
          $max_value  = $this->request['?']['end_price'];
          $this->set('min_price', $min_value);
          $this->set('max_price', $max_value);
          $this->set('count_display', $this->request['?']['count_display']);
           $this->set('sort_by', $this->request['?']['sort_by']);
          


          } else {
            $this->set('max_price', $max_price);
        $this->set('min_price', $min_price);
          }

        $this->set('producer', $producer);
        $this->set('current_value_min', $current_value_min);
        $this->set('current_value_max', $current_value_max);
        $this->set('products', $products);
        $this->set(compact('current_value_max','producers_list'));
    }
}
