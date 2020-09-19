
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title"><?= $category->title; ?></p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index'],['fullBase' => true]) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  'index/'], ['fullBase' => true]) ?>">Категорії</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  'view/'.$category->slug]) ?>"><?= $category->title ?></a>
		</div>
	</div>
</div>
<section class="propose ">
	<div class="categories_page background_white container">
       <div class="container">
       	<div class="about_container">
       		<?= $about->description ?>
       	</div>
       </div>
	</div>
</section>
