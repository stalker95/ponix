<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Currency Controller
 *
 * @property \App\Model\Table\CurrencyTable $Currency
 *
 * @method \App\Model\Entity\Currency[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CurrencyController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','getTypeCurrency']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $currency = $this->Currency->find()->first();

        $this->set(compact('currency'));
    }

    public function getTypeCurrency()
    {
        $currency = $this->Currency->find()->first();

      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $this->response->body(json_encode(array('result' => $currency)));    
  }
    
}
