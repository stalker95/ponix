<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Main Controller
 *
 *
 * @method \App\Model\Entity\Main[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MainController extends AppController
{
    public function initialize()
     {
        parent::initialize();
        $this->Auth->allow(['index','register']);
        // Include the FlashComponent
        $this->loadComponent('Flash');
        $this->loadModel('Categories');
        $this->loadModel('Actions');
        $this->loadModel('Proposes');
        $this->loadModel('Producers');
        $this->loadModel('Advantages');
        $this->loadModel('Seo');
        $this->loadModel('Blogs');
        $this->loadModel('Aboutus');
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $_monthsList = array(
            "01" => "Січня",
            "02" => "Лютого",
            "03" => "Березня",
            "04" => "Квітня",
            "05" => "Травня",
            "06" => "Червня",
            "07" => "Липня",
            "08" => "Серпня",
            "09" => "Вересня",
            "10" => "Жовтня",
            "11" => "Листопада",
            "12" => "Грудня"
        );

        

        

        $seo = $this->Seo->find()->first();
        $categories = $this->Categories->find()->contain(['ChildCategories'])->order('Categories.position ASC')->toArray();
        $abouts = $this->Aboutus->find()->first();

        $advanteges = $this->Advantages
                           ->find()
                           ->toArray();
        
        $blogs = $this->Blogs
                      ->find('all')
                      ->order('id DESC')
                      ->limit(3)
                      ->toArray();
                      
        foreach ($blogs as $key => $value) {
           $_mDD = date("m", strtotime($value['created']));
            $blogs[$key]['month'] = $_monthsList[$_mDD];
        }

        $data = date("Y-m-d H:i:s");
        
        $data_today = date('Y-m-d H:i:s');
        $new_date = date('Y-m-d H:i:s', strtotime($data_today));
        $actions = $this->Actions->find()->order('Actions.position ASC')->toArray();
        $proposes = $this->Proposes->find()->contain(['Products','Products.ActionsProducts','Products.ActionsProducts.Actions','Products.Discounts','Products.Rewiev'=> [
                                                                     'conditions' => [
                                                                       'Rewiev.status' => 2
            ]
        ], 'Products.Producers.ProducersDiscounts','Products.ProductsOptions.OptionsItems.Options', 'Products.Wishlists'])->order('Proposes.position ASC')->toArray();
       //debug($proposes);



      
      //  debug($products);
        $category = $this->Categories->newEntity();
        $products = $category->getAllHits();

        $producers = $this->Producers->find()->toArray();
        $this->set(compact('categories','actions', 'proposes','products','producers', 'seo', 'blogs', 'advanteges', 'abouts'));
    }

    /**
     * View method
     *
     * @param string|null $id Main id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $main = $this->Main->get($id, [
            'contain' => []
        ]);

        $this->set('main', $main);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $main = $this->Main->newEntity();
        if ($this->request->is('post')) {
            $main = $this->Main->patchEntity($main, $this->request->getData());
            if ($this->Main->save($main)) {
                $this->Flash->success(__('The main has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main could not be saved. Please, try again.'));
        }
        $this->set(compact('main'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Main id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $main = $this->Main->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $main = $this->Main->patchEntity($main, $this->request->getData());
            if ($this->Main->save($main)) {
                $this->Flash->success(__('The main has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The main could not be saved. Please, try again.'));
        }
        $this->set(compact('main'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Main id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $main = $this->Main->get($id);
        if ($this->Main->delete($main)) {
            $this->Flash->success(__('The main has been deleted.'));
        } else {
            $this->Flash->error(__('The main could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $plan = $this->Plans->newEntity();
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {
                if ($user['is_admin']==1) {
                    $this->Auth->__set('sessionKey', 'employees');
                }
                $this->Auth->setUser($user);
               
                if ($this->Auth->user('is_admin') != 1) {
                    $this->Flash->admin_error(__('Access denied'));
                    return $this->redirect(['action'=>'index']);
                }
                if (!$this->request->getQuery('redirect')) {
                    $plan->user_id = $user['id'];
                    $plan->date = date("Y-m-d H:i:s");
                    $plan->program_id = $this->request->getData('program');
                    $this->Plans->save($plan);
                    $text = "User ".$user['firstname']." ".$user['lastname']." want to change Plan";
                    $this->sendEmail("Application for change plan",$text);
                    return $this->redirect(['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
                } else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
            else {
                $this->Flash->admin_error(__('Invalid username or password, try again'));
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
    }

    public function register() {
         $_user = $this->Users->newEntity();
         $plan = $this->Plans->newEntity();

         if ($this->request->is('post')) {
         $_user = $this->Users->patchEntity($_user, $this->request->getData()); 
         $_user->password = $this->getRequest()->getData('password');
         $_user->program_id  = $this->getRequest()->getData('program');  
         $_user->set('is_admin', 1);
         $_user->set('active', 0);
         if ($this->Users->save($_user)) {

             $_user->createPlayListUser();
             $_user->sendRegistrationEmail($_user->mail);
             $text = "User ".$_user['firstname']." ".$_user['lastname']."  just registered in system";
              $this->sendEmail("Registation new user ",$text);
             $this->Flash->admin_success(__('Congratulations on your registration. Please wait for your account to be activated'));
             return $this->redirect(['action' => 'index']);

            }

            $this->Flash->admin_error(__('The user could not be saved. Please, try again.'));
        }

    }

}
