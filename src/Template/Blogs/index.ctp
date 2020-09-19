<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title">Блог</p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index/'], ['fullBase' => true]) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'blogs','action'    =>  'index/'], ['fullBase' => true]) ?>">Блог</a>
			
		</div>
	</div>
</div>
<div class="blog_container container">
		<div class="row">
			<div class="col-md-3">
				<div class="search_form blog_search">
					<form action="">
						<input type="text" placeholder="">
						<label for="submit" class="search_form_label">
                                <i class="fa fa-search"></i>
                                <input type="submit" value="Надіслати" name="submit">
                            </label>
					</form>
				</div>
				<div class="blog_last">	
					<div class="blog_title">
						<p>Останні новини</p>
					</div>
					<div class="blog_container">
						<div class="blog_latest_news">
							<?php 	foreach ($latest_news as $key => $value): ?>
								<a href="<?= $this->Url->build(['controller' => 'blogs','action'    =>  $value['slug']], ['fullBase' => true]) ?>" class="blog_latest_news_item"><?= $value['title'] ?></a>
							<?php 	endforeach; ?>
							
						</div>
					</div>
				</div>
				<div class="blog_last">	
					<div class="blog_title">
						<p>Категорії</p>
					</div>
					<div class="blog_container">
						<?php foreach ($blogCategories as $key => $value): ?>
							<a href="<?= $this->Url->build(['controller' => 'blogs','action'    =>  'category/'.$value['slug']], ['fullBase' => true]) ?>" class="blog_latest_news_item"><?=  $value['name'] ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<?php 	foreach ($blogs as $key => $value):?>
				<div class="blog_item">
					<div class="blog_item_image">
						<img src="<?= $this->Url->build('/blogs/'.$value['image'], ['fullBase' => true]) ?>" alt="">
					</div>
					<div class="blog_item_inside">
						<div class="blog_item_data">
						<p><?= $value['created']->day ?> <?= $value['month'] ?>, <?= $value['created']->year ?></p>
					</div>
					<div class="blog_item_title">
						<p><?= $value['title'] ?></p>
					</div>
					<div class="blog_item_description">
						<p><?= $value['description'] ?></p>
					</div>
					<div class="blog_item_link">
						<a href="<?= $this->Url->build(['controller' => 'blogs','action'    =>  $value['slug']], ['fullBase' => true]) ?>">Детальніше</a>
					</div>
					<div class="blog_item_auth">
						<p> <i class="fa fa-pencil"></i> <?= $value['user']['firstname']." ".$value['user']['lastname'] ?></p>
						
					</div>
					</div>
					
				</div>
			<?php 	endforeach; ?>
			<?php
              $params = $this->Paginator->params();
              $this->Paginator->options = array(
                    'url' => array('controller'=>'blogs')
   );
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
