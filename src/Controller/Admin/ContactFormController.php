<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * ContactForm Controller
 *
 * @property \App\Model\Table\ContactFormTable $ContactForm
 *
 * @method \App\Model\Entity\ContactForm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactFormController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $contactForm = $this->paginate($this->ContactForm);

        $this->set(compact('contactForm'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Form id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactForm = $this->ContactForm->get($id, [
            'contain' => []
        ]);

        $this->set('contactForm', $contactForm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactForm = $this->ContactForm->newEntity();
        if ($this->request->is('post')) {
            $contactForm = $this->ContactForm->patchEntity($contactForm, $this->request->getData());
            if ($this->ContactForm->save($contactForm)) {

                $subject = "Contact form";
                $text = "Name: ".$this->request->getData('name')."\n <br>
                Email: ".$this->request->getData('name')."\n <br>
                Message: ".$this->request->getData('message');

                $this->sendEmail($subject,$text);
                return $this->response
                ->withType('json')
                ->withStringBody(
                json_encode(array('status'=>true,'message' => "ההודעה שלך נשלחה ")));
            }
            else {
                $errors = [];
                foreach ($contactForm->getErrors() as $key => $value) {
                 foreach ($value as $key => $val) {
                     $errors[]=$val;
                 }
               }
                 return $this->response
                ->withType('json')
                ->withStringBody(
                json_encode(array('status'=>false,'message' => implode("<br>",$errors))));
            }
           // $this->Flash->error(__('The contact form could not be saved. Please, try again.'));
            
        }
        //$this->set(compact('contactForm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Form id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactForm = $this->ContactForm->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactForm = $this->ContactForm->patchEntity($contactForm, $this->request->getData());
            if ($this->ContactForm->save($contactForm)) {
                $this->Flash->success(__('The contact form has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact form could not be saved. Please, try again.'));
        }
        $this->set(compact('contactForm'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Form id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactForm = $this->ContactForm->get($id);
        if ($this->ContactForm->delete($contactForm)) {
            $this->Flash->admin_success(__('The contact form has been deleted.'));
        } else {
            $this->Flash->admin_error(__('The contact form could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deletechecked($data = null) {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);

     foreach ($ids as  $value) {
      $contactForm = $this->ContactForm->get($value);

      if (isset($contactForm)):
       $this->ContactForm->delete($contactForm);    
      endif;
      
     }  

      $this->Flash->admin_success(__('The Contact form   has been deleted.'));
      return $this->redirect(['action' => 'index']);
    }
}
