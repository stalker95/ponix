<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 *
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        $this->Auth->allow(['index','add']);
        $this->loadComponent('Flash');
        $this->loadModel('Aboutus');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $contacts = $this->Contacts->find()->first();

        $this->set(compact('contacts'));
    }

    public function add()
    {
        $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');
      
        $this->loadModel('Settings');
        $settings = $this->Settings->find()->first();
        $data = $this->request->getData();

        $subject = "Заповнена форма на сторінці Контакти";
        $text = "Імя: ".$data['user_name']."<br>".
                "Email: ".$data['user_email']."<br>".
                "Повідомлення: ".$data['user_message']."<br>";

        $this->sendEmail($settings->email, $subject, $text);
              $this->response->body(json_encode(array('status' => 'true')));

    }

}
