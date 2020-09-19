<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Settings Controller
 *
 *
 * @method \App\Model\Entity\Setting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SettingsController extends AppController
{
    public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');

        $this->loadModel('Playlist');
        $this->loadModel('Advantages');
        $this->loadModel('Settings');
        $this->loadModel('Socials');

        ini_set('memory_limit', '2048M');
        
    }
   

    /**
     * Edit method
     *
     * @param string|null $id Setting id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $settingssa = $this->Settings->find()->first();
        $old_picture = $settingssa->logo;
        $advantages = $this->Advantages
                           ->find()
                           ->toArray();

        $phones_before = explode('<br>', $settingssa->phones);




        $socials = $this->Socials->find()->toArray();

        $old_picture_favicon = $settingssa->favicon;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $advantages = $this->request->getData('advantages_hidden');
            $advantages_name = $this->request->getData('advantages_name');
            $advantages_svg = $this->request->getData('advantages_svg');
            
            foreach ($advantages as $key => $value) {
                $advantage = $this->Advantages->get($value);
                $advantage->title = $advantages_name[$key];
                $advantage->svg = $advantages_svg[$key];
                $this->Advantages->save($advantage);
            }
            $settingssa = $this->Settings->patchEntity($settingssa, $this->request->getData());
            $settingssa->logo = $old_picture;
            $settingssa->favicon = $old_picture_favicon;

             if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'settings', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Settings->updateAll(['logo' => ""], ['id' => $settingssa->id]);    
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $settingssa->logo=$filename;
                        $this->Settings->updateAll(['logo' => $filename], ['id' => $settingssa->id]);
                    }
                }

                if ($this->request->getData('favicon.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'settings', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Settings->updateAll(['favicon' => ""], ['id' => $settingssa->id]);    
                    $img = $this->request->getData('favicon');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $settingssa->favicon=$filename;
                        $this->Settings->updateAll(['favicon' => $filename], ['id' => $settingssa->id]);
                    }
                }
                $settingssa->phones = "";
            if ($this->Settings->save($settingssa)) {   

            foreach ($socials as $key => $value) {
              if ($value['id'] != NULL) {
              $atrubute_tovar =  $this->Socials->get($value['id']);
               $this->Socials->delete($atrubute_tovar);
              }
            }



            $socials_name = $this->request->getData('social_name');
            $socials_values = $this->request->getData('social_value');

            foreach ($socials_name as $key => $value) {
                $social_item = $this->Socials->newEntity();
                $social_item->name = $value;
                $social_item->url = $socials_values[$key];
                $this->Socials->save($social_item);
            }     

            $new_phones = $this->request->getData('phones_numbers');
            
            $data = "";
            foreach ($new_phones as $key => $value) {
                if (!empty($value)) {
                    $data .=  $value."<br>";
                }
                

            }
            if (!empty($data)) {
                $settingssa->phones = $data;
                $this->Settings->save($settingssa);
            }
                $this->Flash->admin_success(__('Зміни збережно'));

               return $this->redirect(['controller' => 'settings', 'action' => 'edit', 'prefix' => 'admin']);




            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте пізніше'));
        }
        $this->nav_['settingss'] = true;
        $this->set('settingssa', $settingssa);
        $this->set('socialsa', $socials);
        $this->set('phones', $phones_before);
        $this->set('advantages', $advantages);
        
    }

    
}
