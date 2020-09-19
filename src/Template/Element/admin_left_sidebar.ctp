<section class="sidebar">
    <!-- Sidebar user panel -->
   <!-- <div class="user-panel">
        <div class="pull-left image">
            <?php echo $this->Html->image($employee->getAvatar(), ['class' => 'img-circle', 'alt' => __('User Image')]); ?>
        </div>
        <div class="pull-left info">
            <p><?php echo trim($employee->getName()); ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div> -->

    <ul class="sidebar-menu" data-widget="tree">
       <!-- <li class="header">MAIN NAVIGATION</li> -->

        <li class="<?= $nav_['dashboard'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'dashboard', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <img src="<?= $this->Url->build('/img/dashboard1.svg', ['fullBase' => true]) ?>" alt=""> <span><?php echo __('Панель управління'); ?></span>
            </a>
        </li>  
 <li class="<?php  if($nav_['orders'] OR $nav_['quick_orders'] OR $nav_['actions'] OR $nav_['proposes']){ echo 'active '; } ?> treeview">
          <a href="#">
           <img src="<?= $this->Url->build('/img/shop.svg', ['fullBase' => true]) ?>" alt=""> <span>Продажі</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="<?= $nav_['orders'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'orders', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i><span><?php echo __('Замовлення'); ?></span>
            </a>
        </li> 

            <li class="<?= $nav_['quick_orders'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'quick-orders', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i><span><?php echo __('Швидкі замовлення'); ?></span>
            </a>
        </li> 
            <li class="<?= $nav_['actions'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'actions', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i><span><?php echo __('Акції'); ?></span>
            </a>
        </li> 
        <li class="<?= $nav_['proposes'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'proposes', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i> <span><?php echo __('Пропозиції'); ?></span>
            </a>
        </li> 
             
        
        
          </ul>
        </li>


          <li class="<?= $nav_['options'] ? 'active' : '' ?> treeview
             <?php  if($nav_['category'] OR $nav_['products'] OR $nav_['attributes_item'] OR $nav_['options_group'] OR $nav_['producers']  OR $nav_['attributes']){ echo 'active'; } ?>
  ">
          <a href="#">
            <img src="<?= $this->Url->build('/img/katalog.svg', ['fullBase' => true]) ?>" alt=""> <span>Каталог</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="<?php  if($nav_['category']){ echo 'active '; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'category', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>" >
                <i class="fa fa-angle-double-right"></i>Категорії товарів</a>
            </li>
            <li class="<?php  if($nav_['products']){ echo 'active '; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'products', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i>Товари</a>
            </li>
             <li class="<?php if($nav_['attributes_item'] OR $nav_['attributes']) { echo 'active_element'; } ?> treeview">
          <a href="#">
            <i class="fa fa-angle-double-right"></i> <span>Атрибути</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="<?php  if($nav_['attributes_item']){ echo 'active '; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'attributes-items', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                 <i class="fa fa-angle-double-right"></i>Атрибути</a>
            </li>
            <li class="<?php  if($nav_['attributes']){ echo 'active '; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'attributes', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                 <i class="fa fa-angle-double-right"></i>Групи атрибутів</a>
            </li>

          </ul>
        </li>
        <li class="<?php if($nav_['options'] OR $nav_['options_group']) { echo 'active_element'; } ?> treeview">
          <a href="#">
            <i class="fa fa-angle-double-right"></i> <span>Опції</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="<?php  if($nav_['options']){ echo 'active '; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'options-items', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i>Опції</a>
            </li>
            <li class="<?php  if($nav_['options_group']){ echo 'active '; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'options', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i>Групи опцій</a>
            </li>

          </ul>
        </li>
        <li class="<?= $nav_['producers'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'producers', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i> <span><?php echo __('Виробники'); ?></span>
            </a>
        </li>
          </ul>
        </li>


 <li class="<?php if ($nav_['rules'] OR $nav_['delivery'] OR $nav_['contacts'] OR $nav_['aboutus'] OR $nav_['payments'] OR $nav_['publics'])  { echo 'active'; } ?> treeview">
          <a href="#">
            <img src="<?= $this->Url->build('/img/pages.svg', ['fullBase' => true]) ?>" alt=""> <span>Сторінки</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            
             <li class="<?php if ($nav_['rules'])  { echo 'active'; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'rules', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i> Обмін та повернення </a></li>
            <li class="<?php if ($nav_['delivery'])  { echo 'active'; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'delivery-page', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i> Доставка</a></li>
            <li class="<?php if ($nav_['contacts'])  { echo 'active'; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'contacts', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i> Контакти</a></li>
            <li class="<?php if ($nav_['aboutus'])  { echo 'active'; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'aboutus', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i> Про нас</a></li>
            <li class="<?php if ($nav_['payments'])  { echo 'active'; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'payments', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i>Оплата</a></li>
            <li class="<?php if ($nav_['publics'])  { echo 'active'; } ?>"><a href="<?php echo $this->Url->build(['controller' => 'publics', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i>Публічна оферта</a></li>

          </ul>
        </li>



<?php if ($user->is_admin() OR $user->is_abs()): ?>
        <li class="<?= $nav_['users'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <img src="<?= $this->Url->build('/img/people.svg', ['fullBase' => true]) ?>" alt="">
                 <span><?php echo __('Клієнти'); ?></span>
            </a>
        </li> 
      <?php endif; ?>
<?php if ($user->is_admin() OR $user->is_abs()): ?>
        <li class="<?php if ($nav_['blogs'] OR $nav_['blog_categories'])  { echo 'active'; } ?> treeview">
          <a href="#">
             <img src="<?= $this->Url->build('/img/news.svg', ['fullBase' => true]) ?>" alt=""> <span>Блог</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($nav_['blog_categories'])  { echo 'active'; } ?>">
                <a href="<?php echo $this->Url->build(['controller' => 'BlogCategories', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i> Категорії блога</a>
            </li>
            <li class="<?= $nav_['blogs'] ? 'active' : '' ?>">
              <a href="<?php echo $this->Url->build(['controller' => 'blogs', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i> <span><?php echo __('Блог'); ?></span>
              </a>
             </li> 
           
          </ul>
        </li>
<?php endif; ?>
<?php if ($user->is_admin() OR $user->is_abs()): ?>
        <li class="<?= $nav_['seo'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'seos', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                 <img src="<?= $this->Url->build('/img/seo_icon.svg', ['fullBase' => true]) ?>" alt=""> <span><?php echo __('Seo'); ?></span>
            </a>
        </li> 
<?php endif; ?>

 <?php if ($user->is_admin() OR $user->is_abs()): ?>
        <li class="<?= $nav_['reviews'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'rewiev', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                 <i class="fa fa-comment" style="font-size: 17px;margin-right: 5px;"></i> <span><?php echo __('Відгуки'); ?></span>
            </a>
        </li> 
<?php endif; ?>  


     <li class="<?php if ($nav_['settingss'] OR $nav_['currencys'] OR $nav_['managers'] OR $nav_['socials'] OR $nav_['producers_discounts'] )  { echo 'active'; } ?> treeview">
          <a href="#">
             <img src="<?= $this->Url->build('/img/new_setting.svg', ['fullBase' => true]) ?>" alt=""> <span>Налаштування</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($nav_['settingss'])  { echo 'active'; } ?>">
                <a href="<?php echo $this->Url->build(['controller' => 'settings', 'action' => 'edit', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>"><i class="fa fa-angle-double-right"></i>Загальні налаштування </a>
            </li>
           <?php if ($user->is_admin() OR $user->is_abs()): ?>
             <li class="<?php if ($nav_['managers'])  { echo 'active'; } ?>">
                <a href="<?php echo $this->Url->build(['controller' => 'managers', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?> "><i class="fa fa-angle-double-right"></i>Менеджери</a>
            </li>
          <?php endif; ?>
            <li class="<?= $nav_['currencys'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'currency', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i><span><?php echo __('Валюти'); ?></span>
            </a>
        </li> 
        <li class="<?= $nav_['producers_discounts'] ? 'active' : '' ?>">
            <a href="<?php echo $this->Url->build(['controller' => 'producers-discounts', 'action' => 'index', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">
                <i class="fa fa-angle-double-right"></i><span><?php echo __('Зміна вартості'); ?></span>
            </a>
        </li> 
            
          </ul>
        </li>



          <li class="absolute_link" >
            <a href="<?php echo $baseUrl; ?>" target="_blanck">
                <i class="fa fa-globe"></i> <span>Відвідати сайт</span>
            </a>
        </li>
      
        
    </ul>
</section>