<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Rewiev Controller
 *
 * @property \App\Model\Table\RewievTable $Rewiev
 *
 * @method \App\Model\Entity\Rewiev[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RewievController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['insertComment','add', 'changeOrder']);
    }

    public function index() 
    {
       $rewievs = $this->Paginate($this->Rewiev->find()->contain(['Products','ParentReview'])->where(['Rewiev.parent_id' => 0])->order(['Rewiev.id DESC']))->toArray();
        $this->nav_['reviews'] = true; 

        $this->set(compact('rewievs'));
    }
   
   public function insertComment()
   {
      $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');

      $data = $this->request->getData();

      $user_email = $data['user_email'];
      $user_name  = $data['user_name'];
      $commnet = $data['comment'];
      $id_product = $data['id_product'];

      $rewiev_before = $this->Rewiev
                            ->find()
                            ->where(['user_name' => $user_name])
                            ->where(['product_id' => $id_product])
                            ->where(['user_email' => $user_email])
                            ->first();
      if (count($rewiev_before) > 0 ) {
        $this->response->body(json_encode(array('status' => false,'message'=>'Комантар з такою поштою або eamil вже існує')));
        return $this->response;
      }

      $rewiev = $this->Rewiev->newEntity();
      $rewiev->user_name = $user_name;
      $rewiev->user_email = $user_email;
      $rewiev->rewiev_text = $commnet;
      $rewiev->product_id  = $id_product;
      $this->Rewiev->save($rewiev);
      $this->response->body(json_encode(array('status' => true,'message'=>'Комантар додано')));
      return $this->response;
   }

   public function changeOrder()
    {
        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
        $data = $this->request->getData();
        //debug($data);
        $record = $this->Rewiev->get($data['id_order']);
        $record->status = $data['status'];

        debug($record);

        if ($this->Rewiev->save($record)) {
           $this->response->body(json_encode(array('status' => 'true')));
        }
    }

    public function deletechecked() {
            if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $blog = $this->Rewiev->get($value);
        $this->Rewiev->delete($blog);   
         }

     $this->Flash->admin_success(__('Відгуки  видалено'));
     return $this->redirect(['action' => 'index']);
    }

    public function leaveRewiev()
    {
       $data = $this->request->getData();
        // debug($data);

       $review = $this->Rewiev->get($data['review_id']);

       $check_review_before = $this->Rewiev->find()->where(['parent_id' => $review->id])->first();

       if (!empty($check_review_before)) {
         $check_review_before->rewiev_text = $data['rewiev_text'];
         $this->Rewiev->save($check_review_before);
       }
       else {
        
        $product = $this->Products->get($review['product_id']); 
        $subject = "Відповідь на ваш коментар стосовно товару ".$product->title."";
        $text = "Відповідь на ваш коментар стосовно товару <a href='http://" . $_SERVER['SERVER_NAME']."/products/".$product->slug."''>".$product->title."</a>";

        $to = $review->user_email;
        $this->sendEmail($to, $subject, $text);

       $new_rewiev = $this->Rewiev->newEntity();
       $new_rewiev->parent_id = $data['review_id'];
       $new_rewiev->rewiev_text = $data['rewiev_text'];
       $new_rewiev->created = date("Y-m-d H:i:s");
       $this->Rewiev->save($new_rewiev);
     }

        $this->response->body(json_encode(array('status' => $data)));

         $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
    }
}
