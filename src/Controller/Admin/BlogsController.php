<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Blogs Controller
 *
 * @property \App\Model\Table\BlogsTable $Blogs
 *
 * @method \App\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BlogsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('BlogCategories');

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $blogs = $this->paginate($this->Blogs);
        $this->nav_['blogs'] = true; 

        $this->set(compact('blogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blog = $this->Blogs->get($id, [
            'contain' => []
        ]);

        $this->set('blog', $blog);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $blog = $this->Blogs->newEntity();
        
       if ($this->request->is('post')) {
        if (!file_exists(WWW_ROOT . 'blogs')) {
        if (!mkdir(WWW_ROOT . 'blogs', 0755, true)) {
         $this->Flash->admin_error(__('Директорію не знайдено '));
         return;
        }
      }      $fileName = "";
             $fileName = time().str_replace(" ", "", $this->request->getData('file.name'));
             $uploadPath = 'uploads/files/';
             $blog = $this->Blogs->patchEntity($blog, $this->request->getData());
             $blog->image = $fileName;
             $blog->created = date("Y-m-d H:i:s");
             $blog->user_id = $this->user->id;
            if ($this->Blogs->save($blog)) {


            if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'blogs', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Blogs->updateAll(['image' => ""], ['id' => $blog->id]);    
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $blog->image=$filename;
                        $this->Blogs->updateAll(['image' => $filename], ['id' => $blog->id]);
                    }
                }
                $this->Flash->admin_success(__('The blog has been saved.'));
                return $this->redirect(['action' => 'index']);
            } 
            $this->Flash->admin_error(__('The blog could not be saved. Please, try again.'));
    }
    $category_id = $this->BlogCategories->find('list', ['limit' => 200]);
    $this->nav_['blogs'] = true; 
        $this->set(compact('blog', 'category_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $blog = $this->Blogs->get($id, [
            'contain' => []
        ]);
        $old_picture = $blog->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blog = $this->Blogs->patchEntity($blog, $this->request->getData());
            $blog->image = $old_picture;
            if ($this->Blogs->save($blog)) {

 if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'blogs', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Blogs->updateAll(['image' => ""], ['id' => $blog->id]);    
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $blog->image=$filename;
                        $this->Blogs->updateAll(['image' => $filename], ['id' => $blog->id]);
                    }
                }

                $this->Flash->admin_success(__('Блог збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('The blog could not be saved. Please, try again.'));
        }
        $category_id = $this->BlogCategories->find('list', ['limit' => 200]);
        $this->nav_['blogs'] = true; 
        $this->set(compact('blog','category_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $this->request->allowMethod(['post', 'delete']);
        $blog = $this->Blogs->get($id);
        if ($this->Blogs->delete($blog)) {

            $mm_dir = new Folder(WWW_ROOT  . DS . 'blogs', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $blog->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
            $this->Flash->admin_success(__('Пост видалено'));
        } else {
            $this->Flash->admin_error(__('Пост не видалено. Спробуйте пізніше'));
        }

        return $this->redirect(['action' => 'index']);
    }
        public function deletechecked() {
            if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $blog = $this->Blogs->get($value);
        $this->Blogs->delete($blog);   
         $mm_dir = new Folder(WWW_ROOT  . DS . 'blogs', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $blog->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }   
      } 

     $this->Flash->admin_success(__('Пости видалено видалено'));
     return $this->redirect(['action' => 'index']);
    }
}
