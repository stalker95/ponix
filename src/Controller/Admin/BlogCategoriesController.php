<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Category Controller
 *
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BlogCategoriesController   extends AppController
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
        $this->loadModel('BlogCategories');
        $this->loadModel('Attributes');
        $this->loadModel('Users');
        $this->loadModel('AttributesCategories');
    }

    public function index()
    {
        $categories_blog = $this->paginate(
            $this->BlogCategories->find('all'));

        $this->set('categories_blog', $categories_blog);   
      $this->nav_['blog_categories'] = true;
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $category   = $this->BlogCategories->newEntity();
        $categories = $this->BlogCategories->find('all')->toArray();
        $attributes = $this->Attributes->find()->toArray();

        if ($this->request->is('post')) {
            $category = $this->BlogCategories->patchEntity($category, $this->request->getData());
            if ($this->BlogCategories->save($category)) {
                $this->Flash->admin_success(__('Категорію додано'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Категорію не створено. Спробуйте ще раз '));
        }
        $this->set(compact('category'));
        $this->set(compact('categories'));
       $this->nav_['blog_categories'] = true;  
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
        $category = $this->BlogCategories->get($id);
       

        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->BlogCategories->patchEntity($category, $this->request->getData());
            if ($this->BlogCategories->save($category)) {
                $this->Flash->admin_success(__('Категорію змінено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Зміни не збережено. Спробуйте ще раз'));
        }
        $this->set(compact('category'));
        
        $this->nav_['blog_categories'] = true;
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
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->BlogCategories->get($id);
        if ($this->BlogCategories->delete($category)) {
            $this->Flash->admin_success(__('Категорію видалено'));
        } else {
            $this->Flash->admin_error(__('Категорію не видалено . Спробуйте ще раз'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function deletechecked() {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $category = $this->BlogCategories->get($value);
        $this->BlogCategories->delete($category);      
      } 

     $this->Flash->admin_success(__('Категорії видалено'));
     return $this->redirect(['action' => 'index']);
    }

     
}
