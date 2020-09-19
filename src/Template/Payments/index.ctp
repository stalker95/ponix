
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title">Оплата</p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index'],['fullBase' => true]) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'payments','action'    =>  'index/'], ['fullBase' => true]) ?>">Оплата</a>
			<span> / </span>
		</div>
	</div>
</div>
<section class="propose ">
	<div class="categories_page background_white container">
       <div class="container">
       	<div class="about_container">
       		<?= $payments->description ?>
       	</div>
       </div>
	</div>
</section>
