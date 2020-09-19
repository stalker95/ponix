<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','add','quickOrder', 'search', 'authAjax', 'updateOrder', 'getData', 'getDataParts']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
      header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
      $this->viewBuilder()->setLayout('order');
      if ($this->Auth->user('id')) {
        $id = $this->Auth->user('id');

       $_user = $this->Users->get($id);
      
      if (!empty($_user)) {
       $this->set(compact('_user'));
      }
    }
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);

        $this->set('order', $order);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Settings');
        $this->loadModel('Orders');
        $this->loadModel('OrdersItems');
        $this->loadModel('Products');
        $settings = $this->Settings->find()->first();
      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $datas = $this->request->getData();
      $subject = "Замовлення";

      $_user = $this->Users->find()->where(['mail' => $datas['user_email']])->first();
      
      $dostavka = "";
      if ($datas['type_delivery'] == 1) {
        $dostavka = "Самовивіз";
      }

      if ($datas['type_delivery'] == 2) {
        $dostavka = "Нова пошта: ". $datas['adress_delivery_new'];
      }

      if ($datas['type_delivery'] == 3) {
        $dostavka = "МІстЕкспрес: ". $datas['adress_delivery_mist'];
      }

      if ($datas['type_delivery'] == 4) {
        $dostavka = "Інтайм: ". $datas['adress_delivery_in'];
      }

      if ($datas['type_delivery'] == 5) {
        $dostavka = "Делівері: ". $datas['adress_delivery_del'];
      }

      if ($datas['type_radio'] == 1) {
        $oplata = "Готівкою";
      }
      if ($datas['type_radio'] == 2) {
        $oplata = "Visa або MasterCard";
      }
      if ($datas['type_radio'] == 3) {
        $oplata = "LiqPay";
      }

      if ($datas['type_radio'] == 4) {
        $oplata = "Наложений платіж";
      }

      if ($datas['type_radio'] == 5) {
        $oplata = "Безготівковий розрахунок";
      }

       
      $otrumuvach = "";
      if ($datas['type_user_delivery'] != 1) {
        $otrumuvach = "Отримувач:<br> Ім'я: ". $datas['user_delivery_name']."<br>".
                      "Прізвище: ". $datas['user_delivery_surname']."<br>".
                      "Телефон: ". $datas['user_delivery_phone']."<br>".
                      "По батькові: ". $datas['user_delivery_second'];
      }

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

       //debug($kurs_dollar);
      // debug($kusr_euro);

      $order = $this->Orders->newEntity();
      $order->username = $datas['user_name'];
      $order->phone = $datas['user_mobile'];
      $order->email = $datas['user_email'];
      $order->created = date("Y-m-d H:i:s");

      if (!empty($_user)) {
        $order->user_id = $_user->id;
      }
      $order->oplata_id = $datas['type_radio'];
      $order->delivery_id = $datas['type_delivery'];
      $order->city = $datas['user_city'];
      $array_count = array_column($_SESSION['cart'], 'count');
    //  debug(array_sum($array_count));
      $order->amount = array_sum($array_count);
      $order->dostavka = $dostavka;
      $order->otrumuvach = $otrumuvach;
      $this->Orders->save($order);
      
      $textfirst = 
            "Ім'я: ".$datas['user_name']."<br>
             Email:".$datas['user_email']."<br>
             Телефон:".$datas['user_mobile']."<br>
             Місто:".$datas['user_city']."<br>
             Оплата:".$oplata."<br>
             Доставка:".$dostavka."<br>
             ".$otrumuvach."<br>
      ";
     // debug($data);

      $table = "<table style='width:100%;border:1px solid #000;text-align:center;'>
                 <thead style='border:1px solid #000;'>
                  <th style='border-right:1px solid #000; border-bottom:1px solid #000;'>Товар</th>
                  <th style='border-bottom:1px solid #000; border-bottom:1px solid #000;'>Кількість</th>
                  <th style='border-bottom:1px solid #000; border-bottom:1px solid #000;'>Опції</th>
                  <th style='border-bottom:1px solid #000; border-bottom:1px solid #000;'>Ціна</th>
                 </thead>
                 <tbody style='border:1px solid #000;'>
      ";
      
      $total = 0;
      foreach ($_SESSION['cart'] as $key => $value) {
        $price = 0;
        if ($value['product']['currency_id'] == 2) {
            $price = (($value['count'] * $value['one_price']) + (array_sum($value['array_option_value']) * $value['count'])) * $kusr_euro;
        } if  ($value['product']['currency_id'] == 3) {
             $price = (($value['count'] * $value['one_price']) + (array_sum($value['array_option_value']) * $value['count'])) * $kurs_dollar;
         } if  ($value['product']['currency_id'] == 1) {
            $price = (($value['count'] * $value['one_price']) + (array_sum($value['array_option_value']) * $value['count']));
        }

        $options = ""; 
        
        if (!empty($value['array_options_name'])) :

         foreach ($value['array_options_name'] as $key => $item) {
           $options = $options.$item.": ".$value['array_option_value'][$key].";";
         }

        endif;

        $ordersItems = $this->OrdersItems->newEntity();
        $ordersItems->order_id = $order->id;
        $ordersItems->options = implode(' ', $value['array_options_name']);
        $ordersItems->amount = $value['count'];

         $ordersItems->summa = $price;
        //$ordersItems->summa = ($value['count'] * $value['product']['price']) + (array_sum($value['array_option_value']) * $value['count']);
        $ordersItems->currency_id = $value['product']['currency_id'];
        $ordersItems->product_id = $value['product']['id'];

        $change_count = $this->Products->get($value['product']['id']);

      //  $change_count->
        $this->OrdersItems->save($ordersItems);
         $table  = $table."<tr><td style='border-right:1px solid #000;'><a href='http://" . $_SERVER['SERVER_NAME']."/products/".$value['product']['slug']."'>".$value['product']['title']."</a></td>
         <td>".$value['count']."</td>
         <td>".$options."</td>
         <td>".$price."</td></tr>";
        
        $total = $total + $price;
        
      }

      $table = $table."</tbody></table><br>". "
                          <p style='text-align: right;'>Підсумок : <strong>".$total."</strong></p>
                       ";
      $order->total = $total;
      $this->Orders->save($order);
       
       $final = $textfirst.$table;
       if ( $order->oplata_id != 2 OR  $order->oplata_id !=3 ) {
     $this->sendEmail($settings->email, $subject, $final);
   }
      $this->response->body(json_encode(array('status' => 'true','order'=> $order->id,'total' => $total, 'amount' => array_sum(array_column($_SESSION['cart'], 'count')) )));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $this->set(compact('order'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function quickOrder()
    {
        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
        $data = $this->request->getData();
      //  debug($data);

        $this->response->body(json_encode(array('status' => 'true')));
    }

    public function search()
    {
      $this->loadModel('Users');
      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $data = $this->request->getData();

      $user = $this->Users->find('all')->where(['mail' => $data['email']])->first();

      if (empty($user)) {
        $this->response->body(json_encode(array('status' => 'false')));
      } else {
        $this->response->body(json_encode(array('status' => 'true')));
      }
      return $this->response;

    }
        public function authAjax()
    {  
       $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
       
        $data = $this->request->getData();
        $email = $data['email'];
        $password = $data['password'];

        $this->autoRender = false;
        if ($email == null OR $email == "") {
            $this->response->body(json_encode(array('status'=>false, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
             return $this->response; 
        }

        $_user = $this->Users->find()->where(['mail' => $email])->first();
        
        if ($_user == false) {
            $this->response->body(json_encode(array('status'=>false, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
            return $this->response;
        }

        if ((new \Cake\Auth\DefaultPasswordHasher)->check($password, $_user->password) == false) {
            $_user = false;
        }
        
        if ($_user == false) {
            $this->response->body(json_encode(array('status'=>false, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
            return $this->response;
        }

            $this->Auth->setUser($_user);
             $this->response->body(json_encode(array('status'=>true, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз', 'user' => $_user)));
            return $this->response;
    }

    public function getData()
    {
      $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
        $datas = $this->request->getData();
        $this->response->body(json_encode(array('data' => $datas)));

      $public_key = 'i99809630945';
      $private_key = 'P1fteazv2CkeNBGGRwSb68hudidNAKG4pGPgsvbX';

      $json_string = '{"public_key":"'.$public_key.'","version":"3","action":"pay","amount":"'.round($datas['json_string']['total']).'","currency":"UAH","description":"Оплата замовлення №00'.$datas['json_string']['order'].'","order_id":"00'.$datas['json_string']['order'].'"}';

      $json_string_base64 = base64_encode($json_string);
      $private_key_base64 = base64_encode($private_key);

      $sign_string = $private_key.$json_string_base64.$private_key;
      //echo $sign_string;
    
      $signature = base64_encode(sha1($sign_string, true));


      $this->response->body(json_encode(array('signature' => $signature, 'data' => $json_string_base64)));

    }

    public function getDataParts()
    {

       $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
       $datas = $this->request->getData();  
       $string = 'password + storeId + orderId + withoutFloatingPoint(amount) + partsCount + merchantType + responseUrl + redirectUrl + products_string + password';

       $password = '66a0dcbee82c4bd9b262cd5fe6f37547';
       $storeId  = 'BDCF7CE5E48F497DB45A';
       $amount   = '400';
       $partsCount = '2';
       $merchantType = 'PP';
       $responseUrl = '';
       $redirectUrl = '';
       $products_string  = '';

       $string = $password.$storeId.$orderId.$amount.$partsCount.$merchantType.$responseUrl.$redirectUrl.$products_string.$password;
       
       $signature = base64_encode(sha1($string, true));


      $this->response->body(json_encode(array('signature' => $signature, 'data' => $json_string_base64)));

    }


    public function updateOrder()
    {
      $this->loadModel('Settings');
        $this->loadModel('Orders');
        $this->loadModel('OrdersItems');
        $settings = $this->Settings->find()->first();

       $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
        $datas = $this->request->getData();
        
        $this->loadModel('Orders');
        
        $id = substr($datas['data_id'], 2);
        $order =  $this->Orders->get($id);
        
        
        
        $oplata = "";
        if ($order->oplata_id == 1) {
        $oplata = "Готівкою";
      }
      if ($order->oplata_id == 2) {
        $oplata = "Visa або MasterCard";
      }
      if ($order->oplata_id == 3) {
        $oplata = "LiqPay";
      }

      if ($order->oplata_id == 4) {
        $oplata = "Наложений платіж";
      }

      if ($order->oplata_id == 5) {
        $oplata = "Безготівковий розрахунок";
      }

      $dostavka = "";
      if ($order->delivery_id == 1) {
        $dostavka = "Самовивіз";
      }

      if ($order->delivery_id == 2) {
        $dostavka = "Нова пошта: ". $order['adress_delivery'];
      }

      if ($order->delivery_id == 3) {
        $dostavka = "МІстЕкспрес: ". $order['adress_delivery'];
      }

      if ($order->delivery_id == 4) {
        $dostavka = "Інтайм: ". $order['adress_delivery'];
      }

      if ($order->delivery_id == 5) {
        $dostavka = "Делівері: ". $order['adress_delivery'];
      }

      $textfirst = 
            "Ім'я: ".$order->username."<br>
             Email:".$order->email."<br>
             Телефон:".$order->phone."<br>
             Місто:".$order->city."<br>
             Оплата:".$oplata."<br>
             Доставка:".$order->dostavka."<br>
             Отримувач:".$order->otrumuvach."<br>
             Статус: Оплачено<br>
      ";
     // debug($data);

      $table = "<table style='width:100%;border:1px solid #000;text-align:center;'>
                 <thead style='border:1px solid #000;'>
                  <th style='border-right:1px solid #000; border-bottom:1px solid #000;'>Товар</th>
                  <th style='border-bottom:1px solid #000; border-bottom:1px solid #000;'>Кількість</th>
                  <th style='border-bottom:1px solid #000; border-bottom:1px solid #000;'>Опції</th>
                  <th style='border-bottom:1px solid #000; border-bottom:1px solid #000;'>Ціна</th>
                 </thead>
                 <tbody style='border:1px solid #000;'>
      ";
      
      $total = 0;
      foreach ($_SESSION['cart'] as $key => $value) {
        $price = 0;
        if ($value['product']['currency_id'] == 2) {
            $price = (($value['count'] * $value['one_price']) + (array_sum($value['array_option_value']) * $value['count'])) * $kusr_euro;
        } if  ($value['product']['currency_id'] == 3) {
             $price = (($value['count'] * $value['one_price']) + (array_sum($value['array_option_value']) * $value['count'])) * $kurs_dollar;
         } if  ($value['product']['currency_id'] == 1) {
            $price = (($value['count'] * $value['one_price']) + (array_sum($value['array_option_value']) * $value['count']));
        }

        $options = ""; 
        
        if (!empty($value['array_options_name'])) :

         foreach ($value['array_options_name'] as $key => $item) {
           $options = $options.$item.": ".$value['array_option_value'][$key].";";
         }

        endif;

         $table  = $table."<tr><td style='border-right:1px solid #000;'><a href='http://" . $_SERVER['SERVER_NAME']."/products/".$value['product']['slug']."'>".$value['product']['title']."</a></td>
         <td>".$value['count']."</td>
         <td>".$options."</td>
         <td>".$price."</td></tr>";
        
        $total = $total + $price;


      $table = $table."</tbody></table><br>". "
                          <p style='text-align: right;'>Підсумок : <strong>".$total."</strong></p>
                       ";
       $final = $textfirst.$table;
       $subject = "Замовлення #00".$order->id;
     $this->sendEmail($settings->email, $subject, $final);
   }

    }

}
