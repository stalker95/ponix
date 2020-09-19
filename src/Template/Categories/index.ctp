
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title">Категорії продуктів</p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index']) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  'index/']) ?>">Категорії</a>
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
				<div class="categories_list">
                    <?php foreach ($categories_main as $key => $value): if ($value['parent_id'] ==  0): ?>

					<a href="<?= $this->Url->build(['controller' => 'categories','action'=>$value['slug']]) ?>" class="categories_list_item">
						<div class="categories_list_item_image">
							<?= $value->image ?>
							<img src="<?= $this->Url->build('/categories/refrigerator.svg', ['fullBase' => true]) ?>" alt="">
						</div>
						<div class="categories_list_item_title">
							<p><?= $value->name ?>  (<?= $value['product_count'] ?>) </p>
						</div>
					</a>
				<?php endif; endforeach; ?>

			

				</div>
			</div>
		</div>
	</div>
</section>
