<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Wishlist Controller
 *
 *
 * @method \App\Model\Entity\Wishlist[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WishlistController extends AppController
{
     public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index','add']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
    }
    
    public function add()
    {
      $this->loadModel('Wishlists');
      $data = $this->request->getData();
      $id_product = $data['id_product'];
      
      if ($this->Auth->user()) {
        $find_wishlist = $this->Wishlists
                              ->find()->where(['product_id' => $data['id_product'], 'user_id' => $this->Auth->user('id')])
                              ->first();

        if (empty($find_wishlist)) {

          $wishlist = $this->Wishlists->newEntity();
          $wishlist->user_id = $this->Auth->user('id');
          $wishlist->product_id = $data['id_product'];
          $wishlist->data =  date("Y-m-d H:i:s");
          $this->Wishlists->save($wishlist);
          
        }
     
      } 

      if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
      }

      if (!in_array($data['id_product'], $_SESSION['wishlist'])) {
        array_push($_SESSION['wishlist'], $data['id_product']);

      }

    



      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      $this->response->body(json_encode(array('result' => $data)));
    }
}
