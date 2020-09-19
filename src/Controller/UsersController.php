<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	protected $php_self = 'Users';

    public function initialize()
    {
        
        parent::initialize();
        $this->Auth->allow(['forgot','resetpassword','logout','login','registerAjax','follow','authAjax','checkAuth', 'remember', 'rememberPassword']);
        $this->nav_['users'] = true;
    }

	public function login()
	{
		if ($this->request->is('post')) {

            $user = $this->Auth->identify();

            
            if ($user) {
                $this->Auth->setUser($user);
                
                if (!$this->request->getQuery('redirect')) {
                    return $this->redirect(['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
                } else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
            $this->Flash->admin_error(__('Invalid username or password, try again'));
        }
		$this->viewBuilder()->setLayout('default');
	}

	public function forgot()
    {
    	if ($this->request->is(['post', 'put'])) {
            $myemail=$this->request->getData('mail');
            $mytoken=Security::hash(Security::randomBytes(25));
            
            $usersTable=TableRegistry::get('Users');
            $user=$usersTable->find('all')->where(['mail'=>$myemail])->first();
            $user->password='';
            $user->token=$mytoken;
            if ($usersTable->save($user)) {
                $this->Flash->admin_success('Reset password link was benn sent to your email');
                Email::configTransport('mailtrap', [
                    'host' => 'smtp.mailtrap.io',
                    'port' => 465,
                    'username' => '35b090f1ed4fe2',
                    'password' => '24238598e6b61f',
                    'className'=> 'Smtp'
                ]);

                $email= new Email('default');
                $email->emailFormat('html');
                $email->transport('mailtrap');
                $email->from('andrsaw4@gmail.com', 'Andrii Savchynetch');
                $email->subject('Please confirm your reset password');
                $email->to($myemail);
                
                $email->send('Hello '.$myemail.' Please click link below to reset your password <a href="http://omry/admin/users/resetpassword/'.$mytoken.'">Reser password</a> ');
            }
    	}
		$this->set('is_forgot', true);
        $this->viewBuilder()->setLayout('login');
        $this->render('login');
    }
    public function resetpassword($token) {
        if ($this->request->is('post')) {
            $hasher=new DefaultPasswordHasher();
            $mypass=$this->request->getData('password');
            $usersTable=TableRegistry::get('Users');
            $user= $usersTable->find('all')->where(['token'=>$token])->first();
            
            $user->password=$mypass;
            if ($usersTable->save($user)) {
                $this->Flash->admin_success('Password was changed');
                return $this->redirect(['action'=>'login']);
            }
        }
        $this->viewBuilder()->setLayout('login');
    }
    public function logout()
    {
                $this->autoRender = false;
        $this->Auth->logout();
         return $this->redirect(['action'=>'login']);
    }

    public function registerMain()
    {
                $this->autoRender = false;

       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json'); 

         $_user = $this->Users->newEntity();
         
         if ($this->request->is('post')) {
         $_user = $this->Clients->patchEntity($_user, $this->request->getData()); 
         $pass = md5($_user->id.md5(substr(md5(time()), 0, 50)).time());
         $_user->password = $pass;

         if ($this->Clients->save($_user)) {
          $_user->hash = md5($_user->id.md5(substr(md5(time()), 0, 50)).time());
          $this->Clients->save($_user);
            $this->Auth->setUser($_user);

             $text = 'Привет '.$_user->login.' Ваш пароль: '.$this->request->getData('password');
             $subject = 'Поздравляем с регистрацией';
             $to = $_user->email;
             $this->sendEmail($to, $subject, $text);
             $this->response->body(json_encode(array('status'=>true, 'message' => '')));

             return $this->response; 
            }
            else {
            $error_msg = [];
            foreach ($_user->getErrors() as $errors) {
                if (is_array($errors)) {
                    foreach ($errors as $error) {
                        $error_msg[] = $error."<br>";
                    }
                } else {
                    $error_msg[] = $errors;
                }
              }
             $this->response->body(json_encode(array('status'=>false, 'message' => $error_msg)));
             return $this->response; 
            }

        }

    }

    public function registerAjax()
    {

       $this->autoRender = false;
      $this->RequestHandler->renderAs($this, 'json');
      $this->response->disableCache();
      $this->response->type('application/json');

      $data = $this->request->getData();

      $email = $data['email'];
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             $this->response->body(json_encode(array('status' => 'false','message'=>'Не коректна пошта')));
             return $this->response;
      }

      $user = $this->Users
                   ->find()
                   ->where(['mail' => $email])
                   ->first();

      if (!empty($user)) {
         $this->response->body(json_encode(array('status' => 'false','message'=>'Користувач з таким email адресом вже існує в системі')));
         return $this->response;
      } else {
        $user = $this->Users->newEntity();
        $pass = md5(md5(substr(md5(time()), 0, 10)).time());
        $user_name = md5(md5(substr(md5(time()), 0, 30)).time());
        $user_surname = md5(md5(substr(md5(time()), 0, 33)).time());

        $user->firstname = $user_name;
        $user->lastname = $user_surname;
        $user->password = $pass;
        $user->mail = $email;
        $user->type_registry = 0;
        $user->date_of_birth = date("Y-m-d H:i:s");
        $user->created = date("Y-m-d H:i:s");

        
        if ($this->Users->save($user)) {
            $subject = "Реєстрація в інтернет магазині";
            $text = "Вітаємо з реєстрацією. Для авторизації використовуйте свою пошту і пароль : ".$pass;
            $this->sendEmail($user->mail, $subject, $text);
            $this->response->body(json_encode(array('status' => 'true','message'=>'Вітаємо з реєстрацією. Для авторизації використовуйте свою пошту і пароль надісланий на пошту')));
            return $this->response;
        } else {
            $this->response->body(json_encode(array('status' => 'true','message'=>'Не коректна пошта')));
            return $this->response;
        }
        
      
      }

     
      
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
             $this->response->body(json_encode(array('status'=>true, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
            return $this->response;
    }

    public function changePassword()
    {
      $this->autoRender = false;
       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json');
       $data = $this->request->getData();

       $id = $this->Auth->user('id');

       $_user = $this->Users->get($id);
      
      if ((new \Cake\Auth\DefaultPasswordHasher)->check($data['old_password'], $_user->password) == false) {

        $this->response->body(json_encode(array('status'=>false, 'message' => 'Неправильний логін або пароль. Спробуйте ще раз')));
        return $this->response;

      }

      if (strlen($data['new_password']) < 6 OR strlen($data['confirm_new_password']) < 6) {
        $this->response->body(json_encode(array('status'=>false, 'message' => 'Паролі менше шести символів')));
        return $this->response;
      }
      
      if ($data['new_password'] !=  $data['confirm_new_password'] ) {

        $this->response->body(json_encode(array('status'=>false, 'message' => 'Паролі не співпадають')));
        return $this->response;

      }
      $_user->password = $data['new_password'];

      $this->Users->save($_user);
      $this->response->body(json_encode(array('status' => true, 'message' => 'Пароль змінено')));
        return $this->response;
    }

    public function remember()
    {

    }

    public function rememberPassword()
    {
      $this->loadModel('Users');
      $this->autoRender = false;

       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json'); 

       $data = $this->request->getData();

       $_user = $this->Users->find()->where(['mail' => $data['email']])->first();

       if (empty($_user)) {
        $this->response->body(json_encode(array('status' => false, 'message' => 'Користувача за заданий email адресом не знайдено. ')));
        return $this->response;
       } else {
          
         $pass  = md5(md5(substr(md5(time()), 0, 10)).time());
         $_user->password = $pass;
         $this->Users->save($_user);
         $subject = "Новий пароль в інтернет магазині Профторг";
            $text = "Ваш новий пароль : ".$pass;
            $this->sendEmail($_user->mail, $subject, $text);

            $this->response->body(json_encode(array('status' => true, 'message' => 'Новий пароль надіслано на пошту. ')));
        return $this->response;

       }
    }

    public function checkAuth()
    {
      $this->autoRender = false;

       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json'); 

      if($this->Auth->user('id') == null) {
       $this->response->body(json_encode(array('status' => false)));
        return $this->response;
      } else {
        $this->response->body(json_encode(array('status' => true)));
      }

      return $this->response;
    }

    public function follow()
    {

      $this->autoRender = false;
      $this->loadModel('Users');
      $this->loadModel('Settings');
      $settings = $this->Settings->find()->first();

       $this->RequestHandler->renderAs($this, 'json');  
       $this->response->disableCache();
       $this->response->type('application/json'); 

       $data = $this->request->getData();
        $this->response->body(json_encode(array('status' => true)));

       $_user = $this->Users
                     ->find()
                     ->where(['mail' => $data['user_email']])
                     ->first();

       if (empty($_user)) {
         $new_user = $this->Users->newEntity();
         $new_user->firstname = " ";
         $new_user->mail = $data['user_email'];
         $new_user->date_of_birth = date("Y-m-d H:i:s");
         $new_user->created = date("Y-m-d H:i:s");
         $new_user->type_registry = 1;
         $this->Users->save($new_user);
         $subject = "Нова підписка на розсилку";
         $text = "Користувач з поштою: ".$data['user_email']." підписався на розсилку.";
         $this->sendEmail($settings->email, $subject, $text);
        $this->response->body(json_encode(array('status' => true, 'email' => $data['user_email'])));
       } else {
        $this->response->body(json_encode(array('status' => true, 'email' => $data['user_email'])));
       }

    }

}
