<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Event\Event;

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
        public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['getData', 'unsetCoupon']);
    }
   public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Coupons');
        $this->loadModel('Attributes');
        $this->loadModel('Users');
    }

    public function getData()
    {
      $baseUrl = \Cake\Routing\Router::url('/', true);
      $baseUrl = rtrim($baseUrl, '/').'/';

      $str = file_get_contents($baseUrl.'/currency/get-type-currency');
      $json = json_decode($str, true);
     //debug($json['result']);

      $kurs_dollar = 1;
      $kusr_euro;

      if ($json['result']['type'] == 1) {
        $str = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
         $data = json_decode($str, true);
         $kurs_dollar = $data[0]['buy'];
         $kusr_euro = $data[1]['buy'];
      }
       if ($json['result']['type'] == 2) {
         $kurs_dollar = $json['result']['value_dollar'];
         $kusr_euro = $json['result']['value'];
       }

        $this->loadModel('Coupons');
        $this->loadModel('CouponsProducts');
        $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
       $datas = $this->request->getData();

       $result = $this->Coupons->find()->where(['name' => $datas['data']])->first();
       $discount;
       $total = 0;
       if (!empty($result)) {
            $discount = $result->discount;

            foreach ($_SESSION['cart'] as $key => $value) {
                $product_coupons = $this->CouponsProducts->find()->where(['product_id' => $value['product']->id])->first();

                 $price = $_SESSION['cart'][$key]['one_price'];
                    if ($value['product']['currency_id'] == 2) {
                       $price = ($value['count'] * $value['one_price']) * $kusr_euro;
                    } if  ($value['product']['currency_id'] == 3) {
                        $price = ($value['count'] * $value['one_price'])  * $kurs_dollar;
                     } if  ($value['product']['currency_id'] == 1) {
                        $price = ($value['count'] * $value['one_price']);
                    }

                if (!empty($product_coupons)) {
                  $discount = $product_coupons->discount;
                  $one_persent = $value['one_price'] / 100;
                 
                  $_SESSION['cart'][$key]['one_price'] = $_SESSION['cart'][$key]['one_price'] - ($one_persent * $discount);

                }
            }
            foreach ($_SESSION['cart'] as $key => $value) {
              $price = $_SESSION['cart'][$key]['one_price'];
                    if ($value['product']['currency_id'] == 2) {
                       $price = ($value['count'] * $value['one_price']) * $kusr_euro;
                    } if  ($value['product']['currency_id'] == 3) {
                        $price = ($value['count'] * $value['one_price'])  * $kurs_dollar;
                     } if  ($value['product']['currency_id'] == 1) {
                        $price = ($value['count'] * $value['one_price']);
                    }
              $total = $total + $price;
            }
            $data = array_values($_SESSION['cart']);
            
            $this->response->body(json_encode(array('status'=>true, 'message' => $result->name, 'coupon'=>$result->discount, 'total' => $total,'products' => $data)));
       } else {
            $this->response->body(json_encode(array('status'=>false, 'message' => 'False')));
       }

       
            return $this->response; 
    }

    public function unsetCoupon() {
         $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
        unset($_SESSION['coupon'][0]);
    }
}
