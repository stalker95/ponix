<div class="breadcrums">
	<div class="breadcrums_list">
		<p class="breadcrums_title">Блог</p>
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index/'], ['fullBase' => true]) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'blog','action'    =>  'index/'], ['fullBase' => true]) ?>">Блог</a>
			
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
								<a href="<?= $this->Url->build(['controller' => 'blog','action'    =>  $value['slug']], ['fullBase' => true]) ?>" class="blog_latest_news_item"><?= $value['title'] ?></a>
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
							<a href="<?= $this->Url->build(['controller' => 'blog','action'    =>  'category/'.$value['slug']], ['fullBase' => true]) ?>" class="blog_latest_news_item"><?=  $value['name'] ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				
				<div class="blog_item">
					<div class="blog_item_more">
						<p><?= $blog->title ?></p>
					</div>
					<div class="blog_item_image">
						<img src="<?= $this->Url->build('/blogs/'.$blog->image, ['fullBase' => true]) ?>" alt="">
					</div>
					<div class="blog_item_article">
						<div class="blog_item_description">
							<p><?= $blog->description ?></p>
						</div>
					</div>
					<div class="blog_item_data">
						<p class="blog_item_data_created"> <i class="fa fa-pencil"></i> <?= $blog->user['firstname']." ".$blog->user['lastname'] ?> <span>|</span> </p>
						<p class="blog_item_data_time"><?= $blog->created->day ?> <?= $blog->month ?>, <?= $blog->created->year ?></p> <span>|</span> 
						<p class="blog_item_data_category"><?= $blog->blog_category->name ?></p>
					</div>
					<div class="blog_item_posts">
												<?php 	if (!empty($prev_post)): ?>

						<a href="<?= $this->Url->build(['controller' => 'blogs','action'    =>  $prev_post->slug], ['fullBase' => true]) ?>" class="blog_item_posts_prev">
							<img src="<?= $this->Url->build('/img/left_arrow_grey.svg', ['fullBase' => true]) ?>" alt="">
							<span>Попередній пост </span>
						</a>
					<?php 	endif; ?>
						<?php 	if (!empty($next_post)): ?>
						<a href="<?= $this->Url->build(['controller' => 'blogs','action' => $next_post->slug], ['fullBase' => true]) ?>" class="blog_item_posts_next">
							<span>Наступний пост </span>
							<img src="<?= $this->Url->build('/img/right_arrow_grey.svg', ['fullBase' => true]) ?>" alt="">
						</a>
					<?php 	endif; ?>
					</div>
				</div>
				<div class="latest_news">
					<div class="latest_news_top">
						<p>Останні новини</p>
					</div>
					<div class="latest_news_container">
                       <?php 	foreach ($other_posts as $key => $value):?>
						<div class="latest_news_item">
						<a href="<?= $this->Url->build(['controller' => 'blog','action' => $value['slug']], ['fullBase' => true]) ?>" class="latest_news_item_image">
							<img src="<?= $this->Url->build('/blog/'.$value['image'], ['fullBase' => true]) ?>" alt="">
						</a>
						<div class="latest_news_item_data">
							<p><?= $value['created']->day ?> <?= $value['month'] ?>, <?= $value['created']->year ?></p>
						</div>
						<div class="latest_news_item_title">
							<p>
								<a href="<?= $this->Url->build(['controller' => 'blog','action' => $value['slug']], ['fullBase' => true]) ?>"><?= $value['title'] ?>
								</a>
							</p>
						</div>
						</div>
					<?php 	endforeach; ?>

						

					</div>
				</div>
			</div>
		</div>	
	</div>
