<?php

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use App\Model\Products;
use App\Controller\AppController;


$this->Products = TableRegistry::get('products');
$this->Categories = TableRegistry::get('categories');
$this->Settings = TableRegistry::get('settings');
$products = $this->Products->find()->toArray(); 
$settings = $this->Settings->find()->first();
$categories = $this->Categories->find()->contain(['ChildCategories'])->order('Categories.position ASC')->toArray();
$this->set(compact('categories'));
?>

<section class="propose ">
    <div class="categories_page background_white container">
        <?= $this->Form->create($category, ['type' => 'file','method' => 'get', 'id'=>'product_sort'] )  ?>
        <div class="row">
            <div class="col-md-3">
                <?= $this->element('catalog_categories'); ?>
               
            </div>
            <div class="col-md-4">
                <p style="color: red;">Помилка 404</p>
                <p>Сторінку не знайдено</p>
                <p>Неправильно набрано адресу або такої сторінки на сайті більше не існує </p>
                <div style="margin-top: 20px;">
                    <p>Перейдіть на <a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  $category['parent_category']['slug']]) ?>">головну сторінку</a> або оберіть потрібну категорію </p>
                </div>
                <img style="max-width: 100px;" src="<?= $this->Url->build('/img/photo_2020-05-26_13-50-20.jpg', ['fullBase' => true]) ?>" alt="">
            </div>
        </div>
    </div>
</section>
    