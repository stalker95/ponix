<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Category Controller
 *
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoryController   extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   public function initialize(){
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Categories');
        $this->loadModel('Attributes');
        $this->loadModel('Users');
        $this->loadModel('AttributesCategories');
    }

    public function index()
    {
        if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $categories_admin = $this->paginate(
            $this->Categories->find('all')->contain('ParentCategories')
            );

        $this->nav_['category'] = true; 
        $this->set('categories_admin', $categories_admin);   
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

        $category   = $this->Categories->newEntity();
        $categories = $this->Categories->find('all')->toArray();
        $attributes = $this->Attributes->find()->toArray();

        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {

                if ($this->request->getData('picture.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'categories', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Categories->updateAll(['picture' => ""], ['id' => $category->id]);    
                    $img = $this->request->getData('picture');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $category->picture=$filename;
                        $this->Categories->updateAll(['picture' => $filename], ['id' => $category->id]);
                    }
                }
                $this->Flash->admin_success(__('Категорію додано'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Категорію не створено. Спробуйте ще раз '));
        }

        $this->nav_['category'] = true; 
        $this->set(compact('category'));
        $this->set(compact('categories'));
        $this->set(compact('attributes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;

        $category = $this->Categories->get($id);
        $parent_category = $this->Categories->find()->where(['id' => $category->parent_id])->first();
        $attributes = $this->Attributes->find()->toArray();
        $attributes_categories = $this->AttributesCategories->find()->contain(['Attributes'])->where(['category_id' => $category->id])->toArray();

        $attributes_categories_array = [];
        $old_picture = $category->picture;

        foreach ($attributes_categories as $key => $value) {
            array_push($attributes_categories_array, $value['attribute']['id']);
        }


        if (!empty($attributes_categories_array)) {
            $attributes = $this->Attributes->find()->where(['id NOT IN ' => $attributes_categories_array ])->toArray();
        } else {
            $attributes = $this->Attributes->find()->toArray();
        }

        $categories = $this->Categories
                           ->find()
                           ->where(['id != ' => $category->parent_id ])
                           ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            $category->picture = $old_picture;
            if ($this->Categories->save($category)) {

                $attributes_category = $this->AttributesCategories->find()->where(['category_id' => $category->id])->toArray();

                foreach ($attributes_category as $key => $value) {
                    $attribute_c = $this->AttributesCategories->get($value['id']);
                    $this->AttributesCategories->delete($attribute_c);
                }

                $attributes = $this->request->getData('attributes');

                if (!empty($attributes)) {
                foreach ($attributes as $key => $value) {
                    $attribute = $this->AttributesCategories->newEntity();
                    $attribute->attribute_id = (int)$value;
                    $attribute->category_id = $category->id;
                    $this->AttributesCategories->save($attribute);
                }
            }
            if ($this->request->getData('picture.error')['error'] == 0) {
             $mm_dir = new Folder(WWW_ROOT . DS . 'categories', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $img = $this->request->getData('picture');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $category->picture=$filename;
                        $this->Categories->updateAll(['picture' => $filename], ['id' => $category->id]);
                    }
                }
                
                $this->Flash->admin_success(__('Категорію змінено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте ще раз'));
        }
         $this->nav_['category'] = true; 
        $this->set(compact('category'));
        $this->set(compact('parent_category'));
        $this->set(compact('attributes'));
        $this->set(compact('attributes_categories'));
        $this->set(compact('categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
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
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            if ($category->picture != "") {
           $mm_dir = new Folder(WWW_ROOT  . DS . 'categories', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $category->picture;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
         }
            $this->Flash->admin_success(__('Категорію видалено'));
        } else {
            $this->Flash->admin_error(__('Категорію не видалено . Спробуйте ще раз'));
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
        $category = $this->Categories->get($value);
        $this->Categories->delete($category);      
         $mm_dir = new Folder(WWW_ROOT  . DS . 'categories', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $category->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
      } 

     $this->Flash->admin_success(__('Категорії видалено'));
     return $this->redirect(['action' => 'index']);
    }

     public function search($name = null)
    {
         if (!$this->user->is_abs()):
            $this->Flash->admin_error(__('У вас не має прав'));
             return $this->redirect(['controller'=>'dashboard','action' => 'index']);
        endif;
     if ($this->request->is(['patch', 'post', 'put'])) 
     {
        $name = $this->getRequest()->getData('name');
        $categories = $this->Categories->find()->select([])->where([
                'name LIKE'=>'%'.$name.'%',          
        ])->toArray();
          $this->set('categories',$categories);
     }
    }
}
