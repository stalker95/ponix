
<style>
	header .propose_list {
		display: block;
	}
	@media (max-width: 768px) {
		header .propose_list {
			display: none;
		}
	}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<section class="propose">
	<div class="propose_inside container">
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-9">
				<div class="">
					<div class="advantages">

						<?php foreach ($advanteges as $key => $value): ?>
							<div class="advantages_item">
								<div class="advantages_item_left">
									<?= $value['svg'] ?>
								</div>
							<div class="advantages_item_right">
								<p><?= $value['title'] ?></p>
							</div>
						</div>
						<?php endforeach; ?>
						
					</div>
					<div class="center_slider">
						<div class="slider_arrow_left">
							<img src="<?= $this->Url->build('/img/arrov_left.svg', ['fullBase' => true]) ?>" alt="">
						</div>
						<div class="slider_arrow_right">
							<img src="<?= $this->Url->build('/img/arrov_right.svg', ['fullBase' => true]) ?>" alt="">
						</div>
						<div class="slider_inialize">
							<?php foreach ($actions as $key => $value): ?>
							<div style="background: <?= $value['background']; ?>;"	data-backgroud="<?= $value['background']; ?>">	
							<div class="center_slider_item" style="background: <?= $value['background']; ?>;">
								<div class="center_slider_item_left">
									<p class="center_slider_title">
										<?= $value['title'] ?> 
									</p>

									<a href="<?= $this->Url->build(['controller' => 'promotions','action'=>$value['slug']]) ?>" class="center_slider_link">Детальніше</a>
								</div>
								<div class="center_slider_item_right">
									<img class="lazy_load" data-load="<?= $this->Url->build('/actions/'.$value['image'], ['fullBase' => true]) ?>" src="" alt="">
								</div>
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
<section class="products">
	<div>
	<div class="container">
		<div class="slider_arrow_left">
							<img src="<?= $this->Url->build('/img/arrov_left.svg', ['fullBase' => true]) ?>" alt="">
						</div>
						<div class="slider_arrow_right">
							<img src="<?= $this->Url->build('/img/arrov_right.svg', ['fullBase' => true]) ?>" alt="">
						</div>
			<div class="products_slider">
				<?php foreach ($categories as $key => $value): if ($value['parent_id'] == 0) :?>
				<div>
					<a href="<?= $this->Url->build(['controller' => 'categories','action'=>$value['slug']], ['fullBase' => true]) ?>" class="products_slider_item">
						<?= $value['image'] ?>
					</a>
				</div>
			<?php endif; endforeach; ?>
			</div>
	</div>
</div>
</section>
<?php if (!empty($proposes)): ?>
<div class="propose">
			<div class=" propose_top container">
		<p class="propose_title">Пропозиція дня</p>
		<div class="propose_arrows">
			<div class="slider_arrow_left">
				<img src="<?= $this->Url->build('/img/arrov_left.svg', ['fullBase' => true]) ?>" alt="">
			</div>
			<div class="slider_arrow_right">
				<img src="<?= $this->Url->build('/img/arrov_right.svg', ['fullBase' => true]) ?>" alt="">
			</div>
		</div>	
</div>
	<div class="propose_container container">
		<div class="propose_slider">
			<?php foreach ($proposes as $key => $value): ?>
				<div class="propose_slider_item <?= $this->element('action_product', array("item" => $value['product']['actions_products'])); ?> ">
					<div class="propose_slider_item_action"><p>Акція</p></div>
					<a href="<?= $this->Url->build(['controller' => 'products','action'=>$value['product']['slug']]) ?>" class="propose_slider_item_image">
						<img src="<?= $this->Url->build('/products/'.$value['product']['image'], ['fullBase' => true]) ?> " alt="">
					</a>
					<div class="propose_slider_item_stars">
						<?= $this->element('rating_product', array("item" => $value['product'])); ?>
					</div>
					<div class="propose_slider_item_title">
						<p><a href="<?= $this->Url->build(['controller' => 'products','action'=>$value['product']['slug']]) ?>"><?= $value['product']['title'] ?></a></p>
					</div>
					<div class="propose_slider_item_kod">
						<p>Код товару <span class="item_kod"><?= $value['product']['cod'] ?></span></p>
					</div>
					<div class="propose_slider_item_status">
						<p class="on_sklad">На складі</p>
					</div>
					<div class="propose_slider_item_price">
						<?= $this->element('price_product', array("item" => $value['product'])); ?>
					</div>

					<div class="product_buttons">
						<button class="product_buttons_item add_product_to_bascket" data-product="<?= $value['product']['id'] ?>">
							<img src="<?= $this->Url->build('/img/back.svg', ['fullBase' => true]) ?>" alt="">
						</button>
						<a href="<?= $this->Url->build(['controller' => 'products','action'=>$value['product']['slug']]) ?>" class="product_buttons_item" >
							<i class="fa fa-eye"></i>
						</a>
						<button class="product_buttons_item  <?= $this->element('wishlist_item', 
						array("item" => $value['product']['wishlists'], 
						      'product' => $value['product']['id'],
						      'user' => $user)); ?>" data-product="<?= $value['product']['id'] ?>">
							<img src="<?= $this->Url->build('/img/favorite.svg', ['fullBase' => true]) ?>" alt="">
						</button>
						<button class="product_buttons_item add_product_to_compare" data-product="<?= $value['product']['id'] ?>"> 
							<i class="fa fa-exchange"></i>
						</button>
					</div>
				</div>
			<?php endforeach; ?>
			
			
		</div>
	</div>
</div>
<?php endif; ?>
<section class="about">
		<div class=" about_container container">
			<div class="about_top">
				<p>Про нас </p>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="about_description">
						<p><?= $abouts->description ?></p>
					</div>
				</div>	
				<div class="col-md-4 about_right">
					<a href="/">
                            <img src='<?= $this->Url->build("/settings/$settings->logo", ["fullBase" => true]) ?>' alt="">
                        </a>
                    </div>
			</div>
			
	</div>
</section>

<?php if (!empty($products)): ?>
<section class="sales">
	<div class="section_inside container">
		<div class="section_top">
			<div class="section_title">
				<p>Хіти продаж</p>				
			</div>
            <div class="section_title">
            	<a href="<?= $baseUrl ?>categories/" target="_blanck">Переглянути усі категорії</a>
            </div>
		</div>
		<div class="row">
			
		
		<div class="col-sm-4 col-md-3">
			<div class="sales_categories">
               <?php foreach ($products as $key => $value): ?>
				<div class="sales_categories_item">
					<div class="sales_categories_item_image">
						<?= $value['image'] ?>
					</div>
					<div class="sales_categories_item_title">
						<p><?= $key ?></p>
					</div>
				</div>
		<?php endforeach; ?>

				
			</div>
		</div>
		<div class="col-sm-8 col-md-9">
			<div class="sales_list">
				<?php foreach ($products as $key => $value): if (!empty($value)):?>
				<div class="sales_list_item">
					<?php foreach ($value['products'] as $key_two => $item): ?>
			<div class="propose_slider_item <?php if (!empty($item['actions_products'])): ?> propose_slider_item_show_action <?php endif; ?>">
				<div class="propose_slider_item_action"><p>Акція</p></div>
					<a href="<?= $this->Url->build(['controller' => 'products','action'=>$item['slug']]) ?>" class="propose_slider_item_image">
						<img src="<?= $this->Url->build('/products/'.$item['image'], ['fullBase' => true]) ?> " alt="">
					</a>
					<div class="propose_slider_item_stars">
						<?= $this->element('rating_product', array("item" => $item)); ?>
					</div>
					<div class="propose_slider_item_title">
						<p><a href="<?= $this->Url->build(['controller' => 'products','action'=>$item['slug']]) ?>"><?= $item['title'] ?></a></p>
					</div>
					<div class="propose_slider_item_kod">
						<p>Код товару <span class="item_kod"><?= $item['cod'] ?></span></p>
					</div>
					<div class="propose_slider_item_status">
						<p class="on_sklad">На складі</p>
					</div>
					<div class="propose_slider_item_price">
						<?= $this->element('price_product', array("item" => $item)); ?>
						
					</div>
					<div class="product_buttons">
						<button class="product_buttons_item add_product_to_bascket" data-product="<?= $item['id'] ?>">
							<img src="<?= $this->Url->build('/img/back.svg', ['fullBase' => true]) ?>" alt="">
						</button>
						<a href="<?= $this->Url->build(['controller' => 'products','action'=>$item['slug']]) ?>" class="product_buttons_item" >
							<i class="fa fa-eye"></i>
						</a>
						<button class="product_buttons_item add_product_to_wishlist" data-product="<?= $item['id'] ?>">
							<img src="<?= $this->Url->build('/img/favorite.svg', ['fullBase' => true]) ?>" alt="">
						</button>
						<button class="product_buttons_item add_product_to_compare" data-product="<?= $item['id'] ?>">
							<i class="fa fa-exchange"></i>
						</button>
					</div>
				</div>	
					<?php endforeach; ?>
				</div>
			<?php endif; endforeach; ?>

				</div>
		</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if (!empty($blogs)): ?>
<section class="news">
	<div class="section_inside container">
		<div class="section_top">
			<div class="section_title">
				<p>Свіжі новини</p>				
			</div>
            <div class="section_buttons">
            	<div class="slider_arrow_left">
					<img src="<?= $this->Url->build('/img/arrov_left.svg', ['fullBase' => true]) ?>" alt="">
				</div>
				<div class="slider_arrow_right">
					<img src="<?= $this->Url->build('/img/arrov_right.svg', ['fullBase' => true]) ?>" alt="">
				</div>
            </div>
		</div>
		<div class="news_inside">
			<div class="news_slider">
               <?php 	foreach ($blogs as $key => $value): ?>
				<div class="news_slider_item">
					<div class="news_slider_item_image">
						<a href="<?= $this->Url->build(['controller' => 'blog','action' => $value['slug']]) ?>">
							<img src="<?= $this->Url->build('/blogs/'.$value['image'], ['fullBase' => true]) ?>" alt="">
						</a>
					</div>
					<div class="news_slider_item_title">
				    	<p><a href="<?= $this->Url->build(['controller' => 'blog','action' => $value['slug']]) ?>"><?= $value['title'] ?></a></p>
				    </div>
				    <div class="news_slider_item_information">
						<div><i class="fa fa-user">	</i> admin</div>
						<div><i class="fa fa-calendar">	</i> <?= $value['created']->day ?> <?= $value['month'] ?>, <?= $value['created']->year ?></div>
					</div>
				    <div class="news_slider_item_description">
				    	<p><?php 
	          				if (strlen($value['description']) > 200){
	          				$first_string = substr($value['description'], 200);

	          				$first_empty = strpos($first_string, ' ');

	          			}
	          				if (strlen($value['description']) > 200){ ?>
	          					<?= substr($value['description'], 0, 200 + $first_empty);
	          				echo "<span class='thre_comas'>...</span>"; ?>
	          				<?php 	} else { ?>
	          					<?= $value['description'] ?>
	          				<?php 	} ?>
	          					
	          				</p>
				    </div>
				    <div class="news_slider_item_link">
				    	<a href="<?= $this->Url->build(['controller' => 'blog','action' => $value['slug']]) ?>">Детальніше</a>
				    </div>
				</div>
                <?php 	endforeach; ?>
				
				
				
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<section class="producer">
	<div class="section_inside container">
		<div class="section_top">
			<div class="section_title">
				<p>Виробники</p>				
			</div>
            <div class="section_buttons">
            	<div class="slider_arrow_left">
					<img src="<?= $this->Url->build('/img/arrov_left.svg', ['fullBase' => true]) ?>" alt="">
				</div>
				<div class="slider_arrow_right">
					<img src="<?= $this->Url->build('/img/arrov_right.svg', ['fullBase' => true]) ?>" alt="">
				</div>
            </div>
		</div>
		<div class="producer_inside">	
		<div class="producer_slider">

			<?php foreach ($producers as $key => $value): ?>
				<a href="<?= $this->Url->build(['controller' => 'producers','action'=>$value['slug']]) ?>">
					<img src="<?= $this->Url->build('/producers/'.$value['image'], ['fullBase' => true]) ?>" alt="">
				</a>
			<?php endforeach; ?>

		</div>
		</div>
	</div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>
    
    if ($(window).width() > 768) {
    	$(".propose_left").addClass('propose_left_active');
	}
	
	$('.slider_inialize').slick({
  infinite: true,
  autoplay: true,
  autoplaySpeed: 4000,
  slidesToShow: 1,
  slidesToScroll: 1
});  


$('.products_slider').slick({
  infinite: true,
  slidesToShow: 6,
  slidesToScroll: 6,
  responsive: [
  {
  	breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
    },
    breakpoint: 993,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
    },
  }]
});  

$('.propose_slider').slick({
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
  {
    breakpoint: 993,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
    },
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
    }
  }]
});  

$('.producer_slider').slick({
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 4000,
  responsive: [
  {
    breakpoint: 993,
    settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
    },
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
    }
  }]
});  

$('.news_slider').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
   responsive: [
  {
    breakpoint: 993,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
    },
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
    }
  }]
}); 

$(".slider_arrow_left").click(function() {
 $(this).parent().parent().parent().find('.slick-prev.slick-arrow').first().trigger('click')
});

$(".slider_arrow_right").click(function() {
 $(this).parent().parent().parent().find('.slick-next.slick-arrow').first().trigger('click')
});



	<?php echo $this->Html->scriptEnd(); ?>
</script>