
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title">Результати пошуку</p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index'],['fullBase' => true]) ?>">Головна</a>
			<span> / </span>
			
		</div>
	</div>
</div>
<section class="propose ">
	<div class="categories_page background_white container">
		<?= $this->Form->create('' , ['type' => 'file','method' => 'get', 'id'=>'product_sort'] )  ?>
		<div class="row">
			<div class="col-md-3">
				<?= $this->element('catalog_categories'); ?>
				
			</div>
			<div class="col-md-9">
	          <div class="categories_product">

	          	<div class="products_sort">
	          		<div class="sort_by">
	          			
	          			<div class="center">
	          				<p class="sorter_title">Сортувати</p>
  								<select name="sort_by" id="sort_by" class="custom-select custom-select-two sources"
  								 <? if (isset($sort_by)){ ?> placeholder="<?= $sort_by ?>"  
  								 <?php 	} else { ?>
  								 	placeholder="За рейтингом"
  								 <?php } ?>>
    								<option value="За рейтингом">За рейтингом</option>
	          				<option value="За спаданням ціни">За спаданням ціни</option>
	          				<option value="За зростанням ціни">За зростанням ціни</option>
	          				<option value="Акційні">Акційні</option>
 								 </select>
						</div>
	          		</div>
	          		<div class="products_show">
	          			Показати 
	          			<select name="count_display" id="count_display">
	          				<?php if (isset($count_display)): ?>
	          					<option value="<?= $count_display ?>"><?= $count_display ?></option>
	          				<?php endif; ?>
	          				<option value="9">9</option>
	          				<option value="12">12</option>
	          				<option value="16">16</option>
	          			</select>
	          		</div>
	          		<div class="products_display"></div>
	          	</div>
	          	<div class="products_list">
	          		<?php 	if (empty($products)): ?>
	          			<p class="empty_products">Товарів по за Вашим запатом не має. </p>
	          		<?php 	endif; ?>
	          		<?php foreach ($products as $key => $value): ?>

	          		<div href="<?php echo $this->Url->build(['controller' => 'products','action'=>$value['slug']]) ?>" class="propose_slider_item <?= $this->element('action_product', array("item" => $value['actions_products'])); ?>">
	          			<div class="propose_slider_item_action"><p>Акція</p></div>
					<a href="<?= $this->Url->build(['controller' => 'products','action'=>$value['slug']]) ?>" class="propose_slider_item_image">
						<img src="<?= $this->Url->build('/products/'.$value['image'], ['fullBase' => true]) ?> " alt="">
					</a>
					<div class="propose_slider_item_stars">
						<?= $this->element('rating_product', array("item" => $value)); ?>
					</div>
					<div class="propose_slider_item_title">
						<p><a href="<?= $this->Url->build(['controller' => 'products','action'=>$value['slug']]) ?>"><?= $value['title'] ?></a></p>
					</div>
					<div class="propose_slider_item_kod">
						<p>Код товару <span class="item_kod"><?= $value['cod'] ?></span></p>
					</div>
					<div class="propose_slider_item_status">
						<?php if ($value['amount'] > 0) { ?>
						<p class="on_sklad">На складі</p>
					<?php } ?>
					<?php if ($value['in_orders'] == true) { ?>
						<p class="in_orders">Під замовлення</p>
					<?php } ?>
					</div>
					<div class="propose_slider_item_price">
						<?= $this->element('price_product', array("item" => $value)); ?>
					</div>
					<div class="product_buttons">
						<button type="button" class="product_buttons_item add_product_to_bascket" data-product="<?= $value['id'] ?>">
							<img src="<?= $this->Url->build('/img/back.svg', ['fullBase' => true]) ?>" alt="">
						</button>
						<a href="<?= $this->Url->build(['controller' => 'products','action' => $value['slug']]) ?>" class="product_buttons_item" >
							<i class="fa fa-eye"></i>
						</a>
						<button type="button" class="product_buttons_item <?= $this->element('wishlist_item', 
						array("item" => $value['wishlists'], 
						      'product' => $value['id'],
						      'user' => $user)); ?>" data-product="<?= $value['id'] ?>">
							<img src="<?= $this->Url->build('/img/favorite.svg', ['fullBase' => true]) ?>" alt="">
						</button>
						<button type="button" class="product_buttons_item add_product_to_compare" data-product="<?= $value['id'] ?>">
							<i class="fa fa-exchange"></i>
						</button>
					</div>
				</div>

			<?php endforeach; ?>


	          	</div>
	          	 <?php
	          	 
              $params = $this->Paginator->params();
              if ($params['pageCount'] > 1): ?>
                <ul class="pagination pagination-sm">
                    <?= $this->Paginator->first('<< ') ?>
                    <?= $this->Paginator->prev('< ' ) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(' >') ?>
                <?= $this->Paginator->last(' >>') ?>
                </ul>
          <?php endif; ?>
	          </div>
	          
			</div>
		</div>
		     <?=   $this->Form->end() ?>
	</div>
</section>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>

    		$("#sort_by").change(function() {
               $("#product_sort").submit();
    		});

    		$("#count_display").change(function() {
               $("#product_sort").submit();
    		});

    <?php echo $this->Html->scriptEnd(); ?>
</script>
