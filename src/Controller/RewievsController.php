<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Rewiev Controller
 *
 * @property \App\Model\Table\RewievTable $Rewiev
 *
 * @method \App\Model\Entity\Rewiev[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RewievsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->loadModel('Rewiev');
        $this->Auth->allow(['insertComment','add', 'index']);
    }
    
    public function index()
    {
      $rewievs = $this->Paginate($this->Rewiev
                      ->find()
                      ->contain(['ParentReview','Products'])
                      ->where(['Rewiev.status' => 2])
                      ->order(['Rewiev.id DESC']))
                      ->toArray();

      $this->set(compact('rewievs'));
    }  
}
