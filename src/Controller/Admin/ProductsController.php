<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('ProductsGallery');
        $this->loadModel('Options');
        $this->loadModel('AttributesCategories');
        $this->loadModel('AttributesProducts');
        $this->loadModel('AttributesItems');
        $this->loadModel('ProductsOptions');
        $this->loadModel('Attributes');
        $this->loadModel('Discounts');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories','ProductsOptions.OptionsItems.Options']

        ];
        $products = $this->paginate($this->Products->find()->order('Products.id DESC'));

        $this->nav_['products'] = true; 
        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        $first_options = $this->Options->find()->order('rand()')->toArray();
        $attributes = $this->Attributes->find()->contain('AttributesItems')->toArray();

        $find_product = $this->Products->find()->where(['cod' => $this->request->getData('cod')])->first();


        
       if ($this->request->is('post')) {

    /*    if (!file_exists(WWW_ROOT . 'uploads' . DS . 'product_gallery')) {
        if (!mkdir(WWW_ROOT . 'uploads' . DS . 'product_gallery', 0755, true)) {
         $this->Flash->admin_error(__('Product gallery directory not found'));
         return;
        }
      }
      */  if (!empty($find_product)):
            $this->Flash->admin_error(__('Товар з таким самим кодом уже існує'));
            return $this->redirect(['action' => 'index']);
        endif;


                $fileName = time().str_replace(" ", "", $this->request->getData('file.name'));
                $uploadPath = 'uploads/files/';
                $uploadFile = $uploadPath.$fileName;

            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->slug = str_replace(" ", "-", $product->slug);
            $product->slug = str_replace(" ", "-", $this->request->getData('slug'));
            $product->slug = strtolower($product->slug);
            $product->image = $fileName;
            $product->status = 0;

            
            if ($this->Products->save($product)) {

                $attributes_products = $this->request->getData('attributes');
                $attributes_values = $this->request->getData('attributes_values');

                $discounts_price = $this->request->getData('discount_price');
                $discounts_start_date = $this->request->getData('date_begin');
                $discounts_end_date = $this->request->getData('date_end');
              
              if (!empty($discounts_price)) {
                foreach ($discounts_price as $key => $value) {
                    $discounts = $this->Discounts->newEntity();
                    $discounts->price = $value;
                    $discounts->start_data =  date("Y-m-d H:i:s", strtotime($discounts_start_date[$key]));
                    $discounts->end_data =  date("Y-m-d H:i:s", strtotime($discounts_start_date[$key]));
                    $discounts->product_id = $product->id;

                    $this->Discounts->save($discounts);
                }
              }

    $product->saveOptions($this->request->getData(), $product->id);
    $product->saveAttributes($this->request->getData('attributes'), $this->request->getData('attributes_values'), $product->id);
   // $product->saveMainPicture($this->request->getData('image'));
            if ($this->request->getData('image.error')['error'] == 0) {
            $mm_dir = new Folder(WWW_ROOT . DS . 'products', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
                    $this->Products->updateAll(['image' => ""], ['id' => $product->id]);    
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $product->image=$filename;
                        $this->Products->updateAll(['image' => $filename], ['id' => $product->id]);
                    }
                }
                
                $product->saveGallery($this->request->getData('image_gallery'), $this->request->getData('alts'), $product->id);

                 
                $this->Flash->admin_success(__('Товар додано'));

                return $this->redirect(['action' => 'index']);

                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            } 
            $this->Flash->admin_error(__('Товар не додано. Спробуйте пізніше'));
        }
    
        $category_id = $this->Products->Categories->find('list')->order('name ASC');
        $producer_id = $this->Products->Producers->find('list', ['limit' => 200]);
        $this->set(compact('product', 'category_id', 'producer_id','first_options','attributes'));
        $this->nav_['products'] = true;
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        $first_options = $this->Options->find()->order('rand()')->toArray();
        $products_gallery = $this->ProductsGallery->find()->where(['product_id' => $id])->order('position ASC')->toArray();
        $attributes_products = $this->AttributesProducts->find()->contain(['AttributesItems'])->where(['product_id' => $id])->toArray();        
       $option_group = $product->getOptionsGroup($product->id, 100);

       $discounts = $this->Discounts->find()->where(['product_id' => $product->id])->toArray();

        $old_picture = $product->image;

                $attributes = $this->Attributes->find()->contain('AttributesItems')->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            $product->image = $old_picture;
          
            foreach ($attributes_products as $key => $value) {
              if ($value['id'] != NULL) {
              $atrubute_tovar =  $this->AttributesProducts->get($value['id']);
               $this->AttributesProducts->delete($atrubute_tovar);
              }
            }

           $discounts_price = $this->request->getData('discount_price');
                $discounts_start_date = $this->request->getData('date_begin');
                $discounts_end_date = $this->request->getData('date_end');

                $product->slug = str_replace(" ", "-", $product->slug);
            $product->slug = str_replace(" ", "-", $this->request->getData('slug'));
            $product->slug = strtolower($product->slug);
            
            if ($this->Products->save($product)) {
                  $product->saveOptions($this->request->getData(), $product->id);
                  $product->saveAttributes($this->request->getData('attributes'), $this->request->getData('attributes_values'), $product->id);
                  $product->saveDiscounts(
                            $this->request->getData('discount_price'),
                            $this->request->getData('date_begin'),
                            $this->request->getData('date_end'),
                            $product->id
                 );

                if ($this->request->getData('image.error')['error'] == 0) {
                    $mm_dir = new Folder(WWW_ROOT . DS . 'products', true, 0777);
                    $target_path = $mm_dir->pwd() . DS;
                    $img = $this->request->getData('image');
                    if ($img['name']) {
                        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                        $filename = md5(microtime(true)) . '.' . $ext;
                        move_uploaded_file($img['tmp_name'], $target_path . $filename);
                        $product->image=$filename;
                        $this->Products->updateAll(['image' => $filename], ['id' => $product->id]);
                    }
                }
              
                $new_pictures = $this->request->getData('image_gallery');
                $product->deleteGallery($new_pictures, $products_gallery);
                
                $product->saveGallery($this->request->getData('image_gallery'), $this->request->getData('alts'), $product->id);

                $this->Flash->admin_success(__('Товар збережено'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->admin_error(__('Товар не збережено спробуйте пізніше'));
        }
        $category_id = $this->Products->Categories->find('list')->order('name ASC');
        $producer_id = $this->Products->Producers->find('list', ['limit' => 200]);
        $this->nav_['products'] = true;
        $this->set(compact('product', 'category_id', 'products_gallery', 'attributes','attributes_products', 'producer_id','option_group','first_options','id','discounts'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
          $product->deleteAllData($product->id);

         $mm_dir = new Folder(WWW_ROOT  . DS . 'products', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $product->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
        $products_gallery = $this->ProductsGallery->find()->where(['product_id' => $product->id])->toArray();
        foreach ($products_gallery as $key => $item) {
            $products_gallery_item = $this->ProductsGallery->get($item['id']);
            $this->ProductsGallery->delete($products_gallery_item);    

             $mm_dir = new Folder(WWW_ROOT  . DS . 'products_gallery', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $products_gallery_item->name;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
        }
            $this->Flash->admin_success(__('Товар видалено'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     public function deletechecked() {
     $ids=$this->request->getData('ids');
     $this->request->allowMethod(['post', 'delete']);
     
      foreach ($ids as  $value) {
        $product = $this->Products->get($value);
        $this->Products->delete($product);      
        $product->deleteAllData($product->id);

         $mm_dir = new Folder(WWW_ROOT  . DS . 'products', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $product->image;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
        $products_gallery = $this->ProductsGallery->find()->where(['product_id' => $value])->toArray();
        foreach ($products_gallery as $key => $item) {
            $products_gallery_item = $this->ProductsGallery->get($item['id']);

            $this->ProductsGallery->delete($products_gallery_item);    

             $mm_dir = new Folder(WWW_ROOT  . DS . 'products_gallery', true, 0777);
            $target_path = $mm_dir->pwd() . DS;
            $oldfile = $target_path . $products_gallery_item->name;

            if (file_exists($oldfile)) {
                unlink($oldfile);
             }
        }
      } 


     $this->Flash->admin_success(__('Товари видалено'));
     return $this->redirect(['action' => 'index']);
    }

     public function search($name = null)
    {
      $this->loadModel('Categories');
           $this->nav_['products'] = true;
     if ($this->request->is(['get', 'post', 'put'])) {
        $name = $this->getRequest()->getData('name');
        $name = trim($name);
        $products = $this->Products->find()->contain(['Categories','ProductsOptions.OptionsItems.Options'])->where([
                'Products.title LIKE'=>'%'.$name.'%',          
        ])->toArray();

        $categories_admin = $this->Categories->find()->contain('ParentCategories')->where([
                'Categories.name LIKE'=>'%'.$name.'%',          
        ])->toArray();
          $this->set('categories_admin',$categories_admin);
          $this->set('products',$products);
     }
    }

    public function getAttributes() {
        $id_category = $this->request->getQuery('id_category');
        $data = $this->AttributesCategories->find()->contain('attributes')->where(['category_id' => $id_category])->toArray();
        $this->autoRender = false;
        $this->RequestHandler->renderAs($this, 'json');  
        $this->response->disableCache();
        $this->response->type('application/json');   
        $this->response->body(json_encode(array('result'=>$data)));
    }

    public function copyElement($id = null)
    {
        $this->autoRender = false;
        $product = $this->Products->newEntity();

        $product->copyElement($id);
        return $this->redirect(['action' => 'index']);
    }
}
