<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Compares Controller
 *
 *
 * @method \App\Model\Entity\Compare[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComparesController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','add', 'remove', 'delete', 'deleteAllCategory']);
        $this->loadModel('Categories');
        $this->loadModel('Products');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
         $slug = $this->request->params['param1'];
$list_of_compares = [];
         if (!isset($_SESSION['compares']) OR empty($_SESSION['compares'])) {
          return $this->redirect(['controller' => 'main', 'action' => 'index']);
         }
         if (isset($_SESSION['compares'])) {
            $compares_items = $this->Products
                                    ->find()
                                    ->contain(['Categories'])
                                    ->where(['Products.id IN ' => $_SESSION['compares']])
                                    ->toArray();
            
            $list_of_compares = [];

            foreach ($compares_items as $key => $value) {
                if (!isset($list_of_compares[$value['category']->name])) {

                $list_of_compares[$value['category']->name] = [];
                $list_of_compares[$value['category']->name]['count'] = 1;
                $list_of_compares[$value['category']->name]['slug'] = $value['category']->slug;
                $list_of_compares[$value['category']->name]['products'][] = $value['id'];
                $list_of_compares[$value['category']->name]['product'] = $value['id'];
                } else {
                    $list_of_compares[$value['category']->name]['count'] += 1;
                    $list_of_compares[$value['category']->name]['products'][] = $value['id'];
                }
            }
            $this->set(compact('list_of_compares'));
        }
         $category = $this->Categories->find()->where(['slug' => $slug])->first();
        
        if (!isset($list_of_compares[$category->name])) {
          return $this->redirect(['controller' => 'main', 'action' => 'index']);
        }
         $need_list = $list_of_compares[$category->name];

         $products = $this->Products
                          ->find()
                          ->contain(['ActionsProducts','Wishlists','ActionsProducts.Actions','Producers.ProducersDiscounts','Discounts','AttributesProducts.AttributesItems'=> [
                                                                     'sort' => [
                                                                       'AttributesItems.name' => 'ASC'
                                                                     ],
                                                                     'conditions' => [
                                                                       'AttributesItems.parent_id' => 8
                          ]]])
                          ->where(['Products.id IN ' => $need_list['products']])->toArray();
      //  debug($products);
         $attributes_list = [];
         $attributes_list_two = [];
          foreach ($products[0]['attributes_products'] as $key => $value): 
           $attributes_list[$key][]= $value['attributes_item']['name']; 
         endforeach; 

         foreach ($products as $key => $value) {
           foreach ($value['attributes_products'] as $key_two => $item) {
            $attributes_list_two[$value['id']][] = $item['attributes_item']['name'];
           }
         }

     //   debug($attributes_list);

        $attributes_list_same = [];

        foreach ($attributes_list_two as $key => $value) {
          foreach($value as $item) {
            $attributes_list_same[] = $item;
          }
          }
        
      //  debug($attributes_list_same);
        $last_array = array_values($attributes_list_same);
       // debug($last_array);
        $new_last_array = array_count_values($last_array);
       // debug($new_last_array);
        $new_last = [];

        if (count($products) > 1) {

        foreach ($new_last_array as $key => $value) {
         if ($value > 1) {
          $new_last[] = $key;
         }
        }
      } else {
        $new_last = array_keys($new_last_array);
      }
       // debug($new_last);

       //  debug($attributes_list);
       //  debug($products);


            
          // debug($item);

          // $products[$key]['new_attribute'][] = $item['attributes_item']['name'];
 //debug($products[$key]['new_attribute'][$keys]);
 //debug($attributes_list[$keys]);
 //debug($item['attributes_item']['name']);

       

      // debug($products);
         $this->set(compact('category'));
         $this->set(compact('products'));
         $this->set(compact('attributes_list', 'attributes_list_same', 'new_last'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function delete($id = null)
    {
      $data = $this->request->getData();
     // debug($this->request->getData());
      $key = array_search($id, $_SESSION['compares']);
      unset($_SESSION['compares'][$key]);
      $this->redirect($this->referer());
    }
    public function add()
    {
      $data = $this->request->getData();
      $id_product = $data['id_product'];
      if (session_status() == PHP_SESSION_NONE) {


      session_start();
    }
 
      if (!isset($_SESSION['compares'])) {
        $_SESSION['compares'] = [];
      }
      $this->loadModel('Compares');

      if (!in_array($data['id_product'], $_SESSION['compares'])) {
        array_push($_SESSION['compares'], $data['id_product']);
        $compare = $this->Compares->newEntity();
        if (isset($this->user->firstname)) {
            $compare = $this->Compares->newEntity();
            $compare->user_id = $this->user->id;
            $compare->product_id = $data['id_product'];
            $compare->created = date("Y-m-d H:i:s");
            $this->Compares->save($compare);
        }
      } 

      $product = $this->Products->get($data['id_product']);

      $category = $this->Categories->get($product->category_id);

      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $list_of_compares = [];

       if (isset($_SESSION['compares']) AND !empty($_SESSION['compares'])) {
            $compares_items = $this->Products
                                    ->find()
                                    ->contain(['Categories'])
                                    ->where(['Products.id IN ' => $_SESSION['compares']])
                                    ->toArray();
            
            $list_of_compares = [];

            foreach ($compares_items as $key => $value) {
                if (!isset($list_of_compares[$value['category']->name])) {

                $list_of_compares[$value['category']->name] = [];
                $list_of_compares[$value['category']->name]['count'] = 1;
                $list_of_compares[$value['category']->name]['slug'] = $value['category']->slug;
                $list_of_compares[$value['category']->name]['category_name'] = $value['category']->title;
                $list_of_compares[$value['category']->name]['products'][] = $value['id'];
                $list_of_compares[$value['category']->name]['product'] = $value['id'];
                } else {
                    $list_of_compares[$value['category']->name]['count'] += 1;
                    $list_of_compares[$value['category']->name]['products'][] = $value['id'];
                }
            }
        }

      $this->response->body(json_encode(array('result' => $data, 'category' => $category->slug, 'list_of_compares' => array_values($list_of_compares))));
    }

    public function remove()
    {
      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $this->loadModel('Products');
      $this->loadModel('Categories');
      
      $data = $this->request->getData();
     // debug($_SESSION['compares']);

      $key = array_search($data['key'], $_SESSION['compares']);
      unset($_SESSION['compares'][$key]);
      $product = $this->Products->get($data['key']);

      $category = $this->Categories->get($product->category_id);

      $products = $this->Products->find()->where(['category_id' => $product->category_id])->toArray();

      foreach ($products as $keys => $value) {
        $key_two = array_search($value['id'], $_SESSION['compares']);
        if (!empty($key_two)) {
          unset($_SESSION['compares'][$key_two]);
        }
      }
      


      unset($_SESSION['compares'][$key]);
      $this->response->body(json_encode(array('result' => $_SESSION['compares'])));
    }

    public function deleteAllCategory($slug = null)
    {
        $this->loadModel('Products');
      $this->loadModel('Categories');
      
     // debug($_SESSION['compares']);


      $category = $this->Categories->find()->where(['slug' => $slug])->first();

      $products = $this->Products->find()->where(['category_id' => $category->category_id])->toArray();

      foreach ($products as $keys => $value) {
        $key_two = array_search($value['id'], $_SESSION['compares']);
        if (!empty($key_two)) {
          unset($_SESSION['compares'][$key_two]);
        }
      }
      $this->redirect($this->referer());
    }

}
