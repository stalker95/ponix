<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\View\ViewBuilder;
use Cake\Filesystem\Folder;

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
        $this->Auth->allow(['forgot','resetpassword']);
        $this->nav_['users'] = true;

    }

	public function login()
	{
		if ($this->request->is('post')) {

            $user = $this->Auth->identify();

            
            if ($user) {
                $this->Auth->setUser($user);
               
                if ($this->Auth->user('is_admin') == 0) {
                $this->Flash->admin_error(__('Access denied'));
                return $this->redirect(['action'=>'logout']);
                }

                if ($this->Auth->user('active') == 0) {
                $this->Flash->admin_error(__('Account is not active'));
                return $this->redirect(['action'=>'logout']);
                }

                if (!$this->request->getQuery('redirect')) {
                    return $this->redirect(['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
                } else {
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
            $this->Flash->admin_error(__('Invalid username or password, try again'));
        }
		$this->viewBuilder()->setLayout('login');
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
                $email= new Email('default');
                $email->setEmailFormat('html');
                $email->setTransport('default');
                $email->setSubject('Please confirm your reset password');
                $email->setTo($myemail);

                $baseUrl = \Cake\Routing\Router::url('/', true);
                $baseUrl = rtrim($baseUrl, '/').'/';

                $email->send('Hello '.$myemail.' Please click link below to reset your password <a href="'.$baseUrl.'/admin/users/resetpassword/'.$mytoken.'">Reser password</a> ');
            }
    	}
		$this->set('is_forgot', true);
        $this->viewBuilder()->setLayout('login');
        $this->render('login');
    }
    public function resetpassword($token) {
        if ($this->request->is('post')) {
            $hasher = new DefaultPasswordHasher();
            $mypass = $this->request->getData('password');
            $usersTable = TableRegistry::get('Users');
            $user = $usersTable->find('all')->where(['token'=>$token])->first();
            
            $user->password = $mypass;
            if ($usersTable->save($user)) {
                $this->Flash->admin_success('Password was changed');
                return $this->redirect(['action'=>'login']);
            }
        }
        $this->viewBuilder()->setLayout('login');
    }
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function index()
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $users = $this->Paginate($this->Users->find()->where(['Users.is_admin' => 0])->order('Users.id DESC'))->toArray();
        $this->set(compact('users'));
    }

    public function followers()
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $users = $this->Paginate($this->Users->find()->where(['Users.type_registry' => 1])->order('Users.id DESC'))->toArray();
        $this->set(compact('users'));
    }

    public function edit($id = null) 
    {

         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        $_user = $this->Users->get($id, [
            'contain' => []
        ]);

        $old_picture = $_user->avatar;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $_user = $this->Users->patchEntity($_user, $this->request->getData());
            if ($this->Users->save($_user)) {

               if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'avatars', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Users->updateAll(['avatar' => ""], ['id' => $_user->id]);    
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $_user->avatar=$filename;
                        $this->Users->updateAll(['avatar' => $filename], ['id' => $_user->id]);
                    }
                }
                $this->Flash->admin_success(__('Користувач збереженийй'));

                return $this->redirect(['controller'=>'users','action' => 'index']);
            }
            $this->Flash->admin_error(__('Данні не збережено. Спробуйте пізніше'));
        }
        $this->set(compact('_user'));
    }

public function exportFollowers()
{
     if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        
   $data_table = "<table>
   <thead>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Email</th>
   </thead>";
   
   $users = $this->Users->find()->where(['type_registry' => 1])->toArray();

   foreach ($users as $key => $value) {
       $data_table = $data_table . 
       "<tr>
            <td>".$value['firstname']."</td>
            <td>".$value['lastname']."</td>
            <td>".$value['mail']."</td>
            <td></td>
       </tr>";
   }

   $data_table = $data_table .  "</table>";

   header('Content-Type: application/force-download');
   header('Content-disposition: attachment; filename = report.xls ');
   header('Pragma: ');
   header('Cache-Control: ');
   echo $data_table;
   die();
}

public function export()
{
     if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
        
   $data_table = "<table>
   <thead>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Email</th>
   </thead>";
   
   $users = $this->Users->find()->where(['is_admin' => 0])->toArray();

   foreach ($users as $key => $value) {
       $data_table = $data_table . 
       "<tr>
            <td>".$value['firstname']."</td>
            <td>".$value['lastname']."</td>
            <td>".$value['mail']."</td>
            <td></td>
       </tr>";
   }

   $data_table = $data_table .  "</table>";

   header('Content-Type: application/force-download');
   header('Content-disposition: attachment; filename = report.xls ');
   header('Pragma: ');
   header('Cache-Control: ');
   echo $data_table;
   die();
}

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->admin_success(__('Користувача видалено'));
        } else {
            $this->Flash->error(__('Користувача не видалено.'));
        }

        return $this->redirect(['action' => 'index']);
    }


}

