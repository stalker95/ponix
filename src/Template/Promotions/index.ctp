
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title">Акції</p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index'],['fullBase' => true]) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'promotions','action'    =>  '/'], ['fullBase' => true]) ?>">Акції</a>
			<span> / </span>
		</div>
	</div>
</div>
<section class="propose ">
	<div class="categories_page background_white container">
		<div class="row">
			<div class="col-md-3">
				<?= $this->element('catalog_categories'); ?>
			</div>
			<div class="col-md-9">
	          <div class="categories_product">
	          		<div class="actions_list" style="display: block;">
	          		  

	          		<!--  <?php foreach ($actions as $key => $value): ?>
	          		   <div class="actions_list_item_new">
	          		   		<div class="actions_list_item_new_left">
	          		   			<div class="actions_list_item_new_left_inside">
	          		   				<div class="actions_list_item_new_left_inside_left">
	          		   					<p class="actions_list_item_new_left_title"><?= $value['title'] ?></p>
	          		   					<div class="actions_list_item_new_left_link">
	          		   						<a href="<?= $this->Url->build(['controller' => 'promotions','action' => $value['slug']], ['fullBase' => true]) ?>">Переглянути</a>
	          		   					</div>
	          		   				</div>
	          		   				<div class="actions_list_item_new_left_inside_right">
	          		   					 <img src="<?= $this->Url->build('/actions/'.$value['image'], ['fullBase' => true]) ?>">
	          		   				</div>
	          		   				
	          		   			</div>
	          		   		</div>
	          		   		<div class="actions_list_item_new_right">
	          		   			<p class="actions_list_item_new_right_top">
	          		   				До завершення акції 
	          		   			</p>
	          		   			<p class="actions_list_item_new_right_center">
	          		   				<?= $value['days_left'] ?>
	          		   			</p>
	          		   			<p class="actions_list_item_new_right_bottom">
	          		   				днів
	          		   			</p>
	          		   		</div>
	          		   </div>       
	          		   <?php endforeach; ?>		   -->
	          		   	          		       <div class="promo-list">
	  <?php foreach ($actions as $key => $value): ?>
      <div class="promo-template">
        <div class="promo-image">
          <img src="<?= $this->Url->build('/actions/'.$value['image'], ['fullBase' => true]) ?>" alt="x100f" />
        </div>
        <div class="promo-description">
        	 <span class="promo-number">0<?= $key+1 ?></span>
          <p class="promo-name"><?= $value['title'] ?></p>
          <p class="promo-price promotions_days">З <?= $value['day_begin'] ?> <?= $value['month_begin'] ?> до <?= $value['day_end'] ?> <?= $value['month_end'] ?></p>
          <a class="promotions_read_more" href="<?= $this->Url->build(['controller' => 'promotions','action' => $value['slug']], ['fullBase' => true]) ?>">Детальніше</a>
        </div>
      </div>
  <?php endforeach; ?>
    </div>	  
	          		</div>
	          </div>
			</div>
		</div>
	</div>
</section>
