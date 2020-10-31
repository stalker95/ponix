<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CheckCredit Controller
 *
 *
 * @method \App\Model\Entity\CheckCredit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CheckCreditController extends AppController
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
        $this->autoRender = false;
  if ($this->request->is(['get'])) {
              $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
       $datas = $this->request->getData();  
       $string = 'password + storeId + orderId + withoutFloatingPoint(amount) + partsCount + merchantType + responseUrl + redirectUrl + products_string + password';

       $password = '66a0dcbee82c4bd9b262cd5fe6f37547';
       $storeId  = 'BDCF7CE5E48F497DB45A';
       $orderId = 20;
       $amount   = 1000;
       $partsCount = 2;
       $merchantType = 'PP';
       $responseUrl = 'https://proftorg.in.ua/check-credit/check';
       $redirectUrl = 'https://proftorg.in.ua/check-credit/check';
       $products_string  = 'test'.'1'.'200';

       $string = $password.$storeId.$orderId.$amount."00".$partsCount.$merchantType.$responseUrl.$redirectUrl.$products_string.$password;
       
       $signature = base64_encode(sha1($string, true));


$ch = curl_init('https://payparts2.privatbank.ua/ipp/v2/payment/create');
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_URL  => 'https://payparts2.privatbank.ua/ipp/v2/payment/create',
    CURLOPT_POSTFIELDS => 
    json_encode(array(
        'storeId' => $storeId,
        'orderId' => $orderId,
        'amount' => $amount,
        'partsCount' => $partsCount,
        'merchantType' => 'PP',
        'scheme' => 1111,
        'products' => array(
            array(
                'name' => 'test',
                'count' => 2,
                'price' => 500
            )
        ),
        'recipientId'=> 'qwerty1234',
        'responseUrl'=> $responseUrl,
        'redirectUrl'=> $redirectUrl,
    'signature' => $signature
    )),
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_SSL_VERIFYPEER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json; charset=UTF-8;',
        'Accept-Encoding: UTF-8;',
        'Accept: application/json;'
    ),
));

// Send the request
$response = curl_exec($ch);
var_dump($response);

      $this->response->body(json_encode(array('signature' => $signature, 'data' => '' )));
        }
    }

}
