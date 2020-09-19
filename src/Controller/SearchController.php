<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Search Controller
 *
 *
 * @method \App\Model\Entity\Search[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SearchController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','search']);

        $this->loadModel('Products');
        $this->loadModel('Categories');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $name = $this->request->getData('name');
        $min_price = 0;
        $current_value_min = 0;
        $selected_values = [];
       
       $this->paginate = [
                'limit' => '9'
            ];

        $name = $this->request->query['name'];
        $products =  $this->Paginate($this->Products
        ->find('all')
        ->contain(['Actions','Discounts','Rewiev'=> [
                                                                     'conditions' => [
                                                                       'Rewiev.status' => 2
            ]
        ],'ActionsProducts','ActionsProducts.Actions','Producers','Producers.ProducersDiscounts','Wishlists','ProductsOptions.OptionsItems.Options'])
        ->where(['Products.title LIKE' => '%'.$name.'%']))
        ->toArray();

        if (!empty($products)) :

      

        
        
        $id_products = array_column($products, 'id');
 $max_price = $this->Products->find('all',[
                    'fields' => array('amount' => 'MAX(Products.price)')])->where(['id IN ' => $id_products])->toArray();       
       // debug($attributes_to_view);
$max_price = $max_price[0]['amount'] * 30;
        $current_value_max = $max_price;
        if ($this->request->is(['get'])) {
            //    die();
        }
        if ($this->request->is(['get']) AND isset($this->request['?']['_method'])  AND $this->request['?']['_method'] == 'PUT' ) {
           // debug($this->request['?']);
            
            $attibutes_items = [];
            $attributes_names = [];
            $producers = [];
            foreach ($this->request['?'] as $key => $value) {
              //  debug($key);
                if (stristr($key, 'checkbox')) {
                    
                    $item_checkbox = explode('_', $key);
                    $item_checkbox = str_replace('--', '.', $item_checkbox);
                   // debug($item_checkbox);
                    array_push($attibutes_items, $item_checkbox[2]);
                    array_push($attributes_names, str_replace('-', ' ', $item_checkbox[1]));
                }

                if (stristr($key, 'producer')) {
                    $item_checkbox = explode('_', $key);
                    array_push($producers, $item_checkbox[2]);
                }
            }
            $products_attributes = [];        

            if (!empty($attibutes_items) AND !empty($attributes_names)) {
                //debug($attibutes_items);
              //  debug($attributes_names);
            $products_attributes = $this->AttributesProducts
                                        ->find()
                                        ->select(['product_id'])
                                        ->where(['attribute_id IN' => $attibutes_items])
                                        ->where(['value IN' => $attributes_names])
                                        ->toArray();
           // debug(array_column($products_attributes,'product_id'));

            if (count($products_attributes) > 1) {
                $double_array = array_count_values(array_column($products_attributes,'product_id')); 
               $products_arrays = [];
             //  debug($double_array);

               foreach ($double_array as $key => $value) {
                 if ($value >= 1) {
                  array_push($products_arrays, $key);
                 }
               }

            } else {
              $products_arrays = array_column($products_attributes,'product_id');
            }
           
            }

            
            
            $query_for_products = $this->Products
                                        ->find()
                                        ->contain(['Actions','Discounts','Rewiev'=> [
                                                                     'conditions' => [
                                                                       'Rewiev.status' => 2
            ]
        ],'ActionsProducts','ActionsProducts.Actions','Producers','Producers.ProducersDiscounts','Wishlists','ProductsOptions.OptionsItems.Options'])
                                        ->where(['category_id' => $category->id])
                                        ->where(['price * 30 >=' => $this->request['?']['start_price']])
                                        ->where(['price * 30 <=' => $this->request['?']['end_price']]);
         // debug($products_attributes);
            if (!empty($products_attributes)) {
             // debug($products_arrays);
                $query_for_products = $query_for_products->where(['Products.id IN ' => $products_arrays]);
            }

             if (!empty($producers)) {
                $query_for_products = $query_for_products->where(['Products.producer_id  IN ' => $producers]);
            }
            $this->paginate = [
                'limit' => $this->request['?']['count_display']
            ];

            if ($this->request['?']['sort_by'] == "За спаданням ціни") {
                $products = $this->Paginate($query_for_products->order('Products.price DESC'))->toArray();
            }

            if ($this->request['?']['sort_by'] == "За зростанням ціни") {
                $products = $this->Paginate($query_for_products->order('Products.price ASC'))->toArray();
            }

            if ($this->request['?']['sort_by'] == "Акційні") {
                $products_actions = $this->ActionsProducts->find()->toArray();
                $id_products_actions = array_column($products_actions, 'products_id');
                
                $this->set('actions', true);
                $products = $this->Paginate($query_for_products->where(['Products.id IN ' => $id_products_actions]))
                ->toArray();
            }
            //debug($products);

            $products = $this->Paginate($query_for_products)->toArray();

          $data = $this->request->getData();
          $selected_values = $this->request['?'];
        //  debug($attibutes_items);

          
          $min_value  = $this->request['?']['start_price'];
          $max_value  = $this->request['?']['end_price'];
          $this->set('min_price', $min_value);
          $this->set('max_price', $max_value);
          $this->set('selected_values', $selected_values);
          $this->set('count_display', $this->request['?']['count_display']);
           $this->set('sort_by', $this->request['?']['sort_by']);
        }
        else {
        $this->set('selected_values', $selected_values);
        $this->set('max_price', $max_price);
        $this->set('min_price', $min_price);
        }
        $category = $this->Categories->newEntity();

        $this->viewBuilder()->setLayout('category');

        $attributes_to_view = [];
        $this->set('attributes_to_view', $attributes_to_view);

        $this->set('current_value_min', $current_value_min);
        $this->set('current_value_max', $current_value_max);
        $this->set('category', $category);
        
        endif;
        $this->set('products', $products);


    }

    public function search()
    {

        $data = $this->request->getData();

        $name = $data['search'];
        $name = trim($name);

        $title_a = str_replace($name, "%".$name."%", $name);


        $products = $this->Products
        ->find('all')
        ->select(['title','slug','image', 'currency_id', 'price'])
        ->where(['title LIKE' => '%'.$name.'%'])
        ->orWhere(['title LIKE' => '%'.$name.' %'])
        ->orWhere(['title LIKE' => '%'.$name.'  %'])
        ->orWhere(['title LIKE' => $name.'%'])
        ->orWhere(['title LIKE' => $name.' %'])
        ->orWhere(['cod LIKE' => '%'.$name.'%' ])
        ->toArray();

      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $this->response->body(json_encode(array('products' => $products)));

    }

  
}
