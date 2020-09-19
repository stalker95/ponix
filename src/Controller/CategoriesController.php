<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends AppController
{
     public function initialize()
    {
        
        parent::initialize();
        $this->Auth->allow(['index','view']);
        $this->loadModel('Products');
        $this->loadModel('Attributes');
        $this->loadModel('Producers');
        $this->loadModel('AttributesProducts');
        $this->loadModel('ActionsProducts');
        $this->loadModel('AttributesItems');
        $this->loadModel('Currency');
        $this->nav_['users'] = true;
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentCategories']
        ];
        $categories_main = $this->Categories->find()->contain(['ChildCategories.Products'])->toArray();
        $count = 0;
        foreach ($categories_main as $key => $value) {
            if ($value['parent_id'] == 0) {
            foreach ($value['child_categories'] as $keys => $item) {
                $count = $count + count($item['products']);
            }
            $categories_main[$key]['product_count'] = $count;
            $count = 0;
    }
}
           // debug($categories_main);

            $this->set(compact('categories_main'));

}

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
      $slug = $this->request->params['param1'];
      
        $category = $this->Categories->find()->contain(['ParentCategories','ParentCategories.ParentCategories','ChildCategories'])->where(['Categories.slug' => $slug])->first();
        //debug($category);

         if (!empty($category->child_categories )): 
          $child_categories = $this->Categories->find()->contain(['ChildCategories'])->where(['Categories.parent_id' => $category->id])->order(['Categories.position' => 'ASC'])->toArray();
          $this->set(compact('child_categories'));
        endif;
        $id = $category->id;

        $attributes_items = $this->AttributesItems->newEntity();
        $producersEntity = $this->Producers->newEntity();

        $producers_list = $producersEntity->getAllProducers($id);

        $min_price = 0;
        $current_value_min = 0;
        $selected_values = [];
       
       $this->paginate = [
                'limit' => '9'
            ];

        $products = $this->Paginate(
                    $this->Products
                         ->find()
                         ->contain(['ActionsProducts','ActionsProducts.Actions','Producers','Producers.ProducersDiscounts','Discounts','Rewiev'=> [
                                                                     'conditions' => [
                                                                       'Rewiev.status' => 2
            ]
        ],'Wishlists','ProductsOptions.OptionsItems.Options'])
                         ->where(['category_id' => $category->id]))
                         ->toArray();
                    //     debug($products);

        $max_price = $this->Products->find('all',[
                    'fields' => array('amount' => 'MAX(Products.price)')])->where(['category_id' => $category->id])->toArray();

        $max_price = $max_price[0]['amount'] * 30;
        $current_value_max = $max_price;
        
        $id_products = array_column($products, 'id');
       
        $attributes_to_view = $attributes_items->getListAttributesBeforeFilter($id);
       // debug($attributes_to_view);
        $action = "";
        $action = $this->request->params['param1'];
       // $action['?'] = [];

        if ($this->request->is(['get'])) {
            //    die();
        }
        if ($this->request->is(['get']) AND isset($this->request['?']['_method'])  AND $this->request['?']['_method'] == 'PUT' ) {
          //debug($this->request);
            $values = '';
            foreach ($this->request['?'] as $key => $value) {
              echo "1";
              $values = $values.$key.'='.$value."&";
            }
            $action = $this->request->params['param1']."?".$values;
            //debug($action);
            
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
           // $action['?']['count_display']= $this->request['?']['count_display'];
          //  $action['?']['_method']= $this->request['?']['_method'];

            if ($this->request['?']['sort_by'] == "За спаданням ціни") {
              $action['?']['sort_by'][]= $this->request['?']['sort_by'];

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

            if (!empty($products_attributes)) {
             // debug($products_arrays);
                $producers_list =  $producersEntity->getAllProducersAfterFilter($products_attributes);
            }

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

        $this->viewBuilder()->setLayout('category');

        $this->set('current_value_min', $current_value_min);
        $this->set('current_value_max', $current_value_max);

        $this->set('category', $category);
        $this->set('products', $products);
        $this->set('attributes_to_view', $attributes_to_view);
        $this->set('producers_list', $producers_list);

$this->set('action', $action);
    }

    public function getCurrenctCurs()
    {
        $currency = $this->Currency->find()->first();

    }
}
