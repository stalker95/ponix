<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','view']);
        $this->loadModel('AttributesProducts');
        $this->loadModel('AttributesItems');
        $this->loadModel('Categories');
    }
    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        $data = date("Y-m-d H:i:s");

        if (!isset($_SESSION['visits'])) {
            $_SESSION['visits'] = [];
        }

        $this->viewBuilder()->setLayout('product');



        $product = $this->Products->find()->contain(['AttributesProducts','Categories','Categories.ParentCategories.ParentCategories.ParentCategories','Rewiev'=> [
                                                                     'conditions' => [
                                                                       'Rewiev.status' => 2
            ]
        ],'Rewiev.ParentReview','Producers','Producers.ProducersDiscounts','Discounts','ProductsGallery','ProductsOptions.OptionsItems.Options'])->where(['Products.slug' => $slug])->first();
      if (isset($product['category']['parent_category'])) {
        $parent_category = $this->Categories->find()->where(['id' => $product['category']['parent_category']['id']])->first();
      //  debug($parent_category);
        $this->set(compact('parent_category'));
      }   
        $price_product = $product->price;
        $discount = false;
        $persent_discount = 100;

        if (!empty($product['products_options']) AND isset($product['products_options'])) {
            $price_product = $product['products_options'][0]->value;    
        }

        foreach ($product['discounts'] as $key => $values): 
                $date_compare1= date("Y-m-d H:i:s", strtotime($data));
                // date now
                $date_compare2= date("Y-m-d H:i:s", strtotime($values['end_data']->i18nFormat('YYY-MM-dd')));
                $start_data = date("Y-m-d H:i:s", strtotime($values['start_data']->i18nFormat('YYY-MM-dd')));

                if ($date_compare1 < $date_compare2 AND $date_compare1 > $start_data) {
                    $product_discount = $values['price'];
                    $discount = true;
                    break;
                }


        endforeach; 
         
         if (isset($product_discount)) {
         $persent = $price_product / 100; 
                 $difference = ($price_product - ($product_discount)) / $persent;  
                 $persent_discount = round($difference);
             }

        $attributes_products = $this->AttributesProducts->find()->contain(['AttributesItems'  => [
                                                                     'conditions' => [
                                                                       'AttributesItems.parent_id' => 8
                                    ]]])->where(['AttributesProducts.product_id' => $product->id])->toArray();

        $main_attributes =  $this->AttributesProducts
                                    ->find()
                                    ->contain(['AttributesItems','AttributesItems.ParentAttributesItems' => [
                                                                     'conditions' => [
                                                                       'ParentAttributesItems.id' => 8
                                    ]],
                                        'AttributesItems.AttributesProducts' => [
                                                                     'conditions' => [
                                                                       'AttributesProducts.product_id' => $product->id
                                    ]]])
                                    ->where(['AttributesProducts.product_id' => $product->id])
                                    
                                    ->toArray();

        $option_group = $product->getOptionsGroup($product->id, $persent_discount);
       // debug($option_group);

        $option_group_json = json_encode($option_group);

        $products = $this->Products
                         ->find('all')
                         ->limit(10)
                         ->contain(['ActionsProducts','ActionsProducts.Actions', 'Discounts', 'Rewiev','Wishlists', 'Producers','Producers.ProducersDiscounts', 'Producers.ProducersDiscounts','ProductsOptions.OptionsItems.Options'])
                         ->where(['category_id' => $product->category_id])
                         ->where(['Products.id !=' => $product->id])
                         ->toArray();


        if (empty($product)) {
            return $this->redirect(['controller'=>'main', 'action'=>'indx']);          
        }
      
        $this->set('product', $product);
        $this->set(compact('attributes_products','option_group','option_group_json', 'products', 'main_attributes', 'discount'));
    }

}
