<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
/**
 * User Entity
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $mail
 * @property bool|null $is_admin
 * @property bool|null $active
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*'         => true,
        'firstname' => true,
        'lastname' => true,
        'mail' => true,
        'is_admin' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'password'=>true,

        'users' => true,
        'address' => true,
        'city' => true,
        'zone' => true,
        'phone' => true,
        'business' => true,
        'program_id' => true,
        'info'       => true,
    ];

    public function getName()
    {
        return trim($this->firstname . ' ' . $this->lastname);
    }

    public function getTheme()
    {
        return (isset($this->theme) && $this->theme ? $this->theme : 'skin-black-light');
    }

    public function getAvatar()
    {
        return ((!isset($this->avatar) || empty($this->avatar)) ? 'softsprint.png' : $this->avatar);
    }
    protected function _setPassword($value)
    {
       $hasher = new DefaultPasswordHasher();
       return $hasher->hash($value);
    }

    public function createPlayListUser()
    {          
         //$last_user=$this->Users->find('all', ['where' => ['Users.id' => 'DESC']])->last();
         $playList = \Cake\ORM\TableRegistry::get('Playlist')->newEntity();
         $playList->name = $this->firstname." ".$this->lastname;
         $playList->city = "";
         $playList->region="";
         $playList->time="";
         $playList->user_id=$this->id;
         \Cake\ORM\TableRegistry::get('Playlist')->save($playList); 
    }
    public  function getListPlaylists($mass=null)  
    {
       
         $medias_playlists = \Cake\ORM\TableRegistry::get('playlist');
         $medias_playlist = $medias_playlists->find('all')->where(['user_id in' => $mass])->toArray();
        return $medias_playlist;
    }

    public function insert_media_in_playlist($playlist_mass, $media_id) 
    {
         $medias_playlists = \Cake\ORM\TableRegistry::get('playlists_media');
         $media=$medias_playlists->newEntity();
         foreach ($playlist_mass as $key => $value) {
             $media->playlist_id=$value['id'];
             $media->media_id=$media_id;
             \Cake\ORM\TableRegistry::get('playlists_media')->save($media); 
         }
    }

    public function setHimPlayListABSFiles($user_id)
    {
         $medias_abs = \Cake\ORM\TableRegistry::get('abs_media');
         $media_abs = $medias_abs->find('all')->toArray();
         $user_playlists = \Cake\ORM\TableRegistry::get('playlist');
         $user_playlist = $user_playlists->find('all')->where(['user_id'=>$user_id])->toArray(); 

         foreach ($media_abs as $item):
           $playlists_media = \Cake\ORM\TableRegistry::get('playlists_media');
           $playlist_media = $playlists_media->newEntity();
            
            $playlist_media->playlist_id = $user_playlist[0]->id;
            $playlist_media->media_id = $item['media_id'];
            $playlist_media->is_abs = 1;
            //debug($playlist_media);
             \Cake\ORM\TableRegistry::get('playlists_media')->save($playlist_media); 
         endforeach;
         


    }

    public function is_abs() 
    {

     return $this->is_admin == 3;
    }

    public function is_admin() 
    {
        
     return $this->is_admin==2;
    } 

    public function is_manager() 
    {
        
     return $this->is_admin == 1;
    } 

    public function deleteHimSubUsers($user_id = null)
    {
           $userss = \Cake\ORM\TableRegistry::get('users');
             $_user=$userss 
        ->find('all')
        ->where(['parent_id'=>$user_id])
        ->toArray();
       

         if (!empty($_user)):
            foreach ($_user as $key => $value): 
              \Cake\ORM\TableRegistry::get('users')->delete($_user[$key]);            
            endforeach;
         endif;
    }

    public function deleteHimMedia($user_id = null)
    {
        $medias = \Cake\ORM\TableRegistry::get('media');
             $media = $medias 
        ->find('all')
        ->where(['user_id'=>$user_id]);
       
         if (!empty($media)):
             foreach ($media as $key => $value): 
              \Cake\ORM\TableRegistry::get('media')->delete($media[$key]);
             endforeach;   
         endif;
    }

    public function setNewPermition($user,$allow_delete,$allow_edit,$allow_write)
    {
     $users_permitions = \Cake\ORM\TableRegistry::get('users_permitions');
     $text =  "User ".$user['firstname']." ".$user['lastname']." would like to change Plan. Please, confirm. : ";
     $message = "User ".$user['firstname']." ".$user['lastname']." would like to change Plan. Please, confirm. : ";

     if ($user->allow_delete==false AND $allow_delete==true)
     {
             $users_permition = $users_permitions->newEntity();

        $users_permition->user_id = $user['id'];
        $users_permition->name_permition = "allow_delete";
        $users_permition->id_permition = 2;
        $users_permition->new_value = 1;
        $message=$message.$users_permition->name_permition." ";
        \Cake\ORM\TableRegistry::get('users_permitions')->save($users_permition);     
    }
    if ($user->allow_edit==false AND $allow_edit==true)
     {
             $users_permition = $users_permitions->newEntity();

        $users_permition->user_id = $user['id'];
        $users_permition->name_permition = "allow_edit";
        $users_permition->id_permition = 3;
        $users_permition->new_value = 1;
        $message=$message.$users_permition->name_permition." ";
        \Cake\ORM\TableRegistry::get('users_permitions')->save($users_permition);     
    }
     if ($user->allow_write==false AND $allow_write==true)
     {
             $users_permition = $users_permitions->newEntity();

        $users_permition->user_id = $user['id'];
        $users_permition->name_permition = "allow_write";
        $users_permition->id_permition = 4;
        $users_permition->new_value = 1;
        $message=$message.$users_permition->name_permition." ";
        \Cake\ORM\TableRegistry::get('users_permitions')->save($users_permition);     
    }
    if (strlen($text) < strlen($message))
    {
        $this->sendEmail("Change Permitions",$message);
    }
    }

    public function setNewPermitionUser($_user,$id_permition,$name_permition,$new_value)
    {
     $this->Users = TableRegistry::get('users');
     $_user =  $this->Users->find('all')->where(['id'=>$_user->id])->toArray();
     $firstname = $_user[0]->firstname;
     $lastname  = $_user[0]->lastname;
     if ($id_permition == 2)
     {
        $_user[0]->allow_delete = $new_value;
        
     }
     if ($id_permition == 3)
     {
        $_user[0]->allow_edit = $new_value;
        
     }
     if ($id_permition == 4)
     {
        $_user[0]->allow_write = $new_value;
        
     }
     $this->Users->save($_user[0]);

        $text = "Hello, ".$firstname." ".$lastname." your permition has been confirmed by Admin. Please, enjoy. ";
        $subject = "confirmed Permition";
        $email= new Email('default');
        $email->setTransport('default');
        $email->setEmailFormat('html');

        try {
        $res = $email
              ->setTo($_user[0]->mail)
              ->setSubject($subject)                   
              ->send($text);

              //var_dump($res);
        } catch (Exception $e) {
            var_dump("ergerg");
            echo 'Exception : ',  $e->getMessage(), "\n";

        }
    } 

    public function sendEmail($subject,$text)
    {
        $this->ContactData = TableRegistry::get('contact_data');
        $contact_data=$this->ContactData->find('all')->toArray();
        $to = $contact_data[0]['email'];
        $email= new Email('default');
        $email->setTransport('default');
        $email->setEmailFormat('html');

        try {
        $res = $email
              ->setTo($to)
              ->setSubject($subject)                   
              ->send($text);

              //var_dump($res);
        } catch (Exception $e) {
            var_dump("ergerg");
            echo 'Exception : ',  $e->getMessage(), "\n";

        }

        
    }

    public function sendNotificationEmail($to)
    {
        $text = "Hello, your account on Plug has been activated. Please, enjoy.";
        $subject = "Active account";
        $email= new Email('default');
        $email->setTransport('default');
        $email->setEmailFormat('html');

        try {
        $res = $email
              ->setTo($to)
              ->setSubject($subject)                   
              ->send($text);

              //var_dump($res);
        } catch (Exception $e) {
            var_dump("ergerg");
            echo 'Exception : ',  $e->getMessage(), "\n";

        }

        
    }
    public function sendRegistrationEmail($to)
    {
        $text = "Hello, your account on Plug has been created. Please, wait for activation.";
        $subject = "Active account";
        $email= new Email('default');
        $email->setTransport('default');
        $email->setEmailFormat('html');

        try {
        $res = $email
              ->setTo($to)
              ->setSubject($subject)                   
              ->send($text);

              //var_dump($res);
        } catch (Exception $e) {
            var_dump("ergerg");
            echo 'Exception : ',  $e->getMessage(), "\n";

        }

        
    }

    public function sendEmailToUser($to,$subject,$text)
    {
        $email= new Email('default');
        $email->setTransport('default');
        $email->setEmailFormat('html');

        try {
        $res = $email
              ->setTo($to)
              ->setSubject($subject)                   
              ->send($text);

              //var_dump($res);
        } catch (Exception $e) {
            var_dump("ergerg");
            echo 'Exception : ',  $e->getMessage(), "\n";

        }

        
    }

}
