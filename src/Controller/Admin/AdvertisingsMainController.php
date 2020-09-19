<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
/**
 * AdvertisingsMain Controller
 *
 * @property \App\Model\Table\AdvertisingsMainTable $AdvertisingsMain
 *
 * @method \App\Model\Entity\AdvertisingsMain[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdvertisingsMainController extends AppController
{
   
    
    /**
     * Edit method
     *
     * @param string|null $id Advertisings Main id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $advertisingsMain = $this->AdvertisingsMain->get($id, [
            'contain' => []
        ]);
         $old_picture=$advertisingsMain->image;
                 if($this->request->is(['patch', 'post', 'put'])) {
             $advertisingsMain = $this->AdvertisingsMain->patchEntity($advertisingsMain, $this->request->getData());
             if ($this->request->getData('image')['error'] != 0) {
                $advertisingsMain->image=$old_picture;
             }
            if ($this->AdvertisingsMain->save($advertisingsMain)) {
             if ($this->request->getData('image')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . 'img' . DS . 'advertising_main', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $advertisingsMain->image;
                    if ($advertisingsMain->image)
                        if (file_exists($oldfile))
                        {
                            unlink($oldfile);
                        }
            
                    $this->AdvertisingsMain->updateAll(['image' => ""], ['id' => $advertisingsMain->id]);    

                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                       $advertisingsMain->image=$filename;
                        $this->AdvertisingsMain->updateAll(['image' => $filename], ['id' => $advertisingsMain->id]);
                        
                    }
                }
                $this->Flash->admin_success(__('The Advertisings  has been updated.'));
                return $this->redirect(['controller'=>'main','action' => 'index']);
            }
        }
        $this->set(compact('advertisingsMain'));
    }

}
