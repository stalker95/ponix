<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<div class="breadcrums">
	<div class="breadcrums_list">
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index']) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  '/index']) ?>">Категорії</a>
			<span> / </span>
			
			<?php if (!empty($product->category['parent_category']['parent_category']['parent_category'])): ?>
				<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  $category['parent_category']['parent_category']['parent_category']['slug']]) ?>"><?= $product['category']['parent_category']['parent_category']['parent_category']['name'] ?></a>
							<span> / </span>
			<?php endif; ?>
			<?php if (!empty($product->category['parent_category']['parent_category'])): ?>
				<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  $category['parent_category']['parent_category']['slug']]) ?>"><?= $product['category']['parent_category']['parent_category']['name'] ?></a>
							<span> / </span>
			<?php endif; ?>

			<?php if (!empty($product->category['parent_category'])): ?>
				<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  $product->category['parent_category']['slug']]) ?>"><?= $product->category['parent_category']['name'] ?></a>
							<span> / </span>
			<?php endif; ?>
			<a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  $product->category->slug]) ?>"><?= $product->category->name; ?></a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'products','action'    =>  $product->slug]) ?>"><?= $product->title ?></a>
			<span> / </span>
			
		</div>
	</div>
</div>
<div class="white_container container">

	<div class="product container">
				<div class="product_left">
					<div class="product_left_slider">
						<a href="<?= $this->Url->build('/products/'.$product->image, ['fullBase' => true]) ?>" class="product_left_inside  gallery_item">
							<img src="<?= $this->Url->build('/products/'.$product->image, ['fullBase' => true]) ?>" alt="">
						</a>
						<?php foreach ($product['products_gallery'] as $key => $value):?>
								<a href="<?= $this->Url->build('/products_gallery/'.$value['name'], ['fullBase' => true]) ?> " class="product_item gallery_item">
									<img src="<?= $this->Url->build('/products_gallery/'.$value['name'], ['fullBase' => true]) ?>" alt="">
								</a>
								
						<?php endforeach; ?>
					</div>
					
					<?php if (!empty($product['products_gallery'])) { ?>
					<div class="products_gellery_inside">
						<div class="slider_arrow_left">
							<img src="<?= $this->Url->build('/img/arrov_left.svg', ['fullBase' => true]) ?>" alt="">
						</div>
						<div class="slider_arrow_right">
							<img src="<?= $this->Url->build('/img/arrov_right.svg', ['fullBase' => true]) ?>" alt="">
						</div>
						<div class="product_gallery">
							<div  class="product_item product_gallery_item">
									<img src="<?= $this->Url->build('/products/'.$product->image, ['fullBase' => true]) ?>" alt="">
							</div>
							<?php foreach ($product['products_gallery'] as $key => $value):?>
								<div  class="product_item product_gallery_item">
									<img src="<?= $this->Url->build('/products_gallery/'.$value['name'], ['fullBase' => true]) ?>" alt="">
								</div>


							<?php endforeach; ?>
					 </div>
					</div>
				    <?php } ?>
					
				</div>
				<div class="product_right">
					<div class="product_title">
						<p><?= $product->title ?></p>
					</div>
					<div class="product_stars">
						<?= $this->element('rating_product', array("item" => $product)); ?>
					</div>

					<div class="propose_slider_item_flex">
						<div class="propose_slider_item_kod">
							<p>Код товару: <span class="item_kod"><?= $product->cod ?></span></p>
						</div>

						<div class="product_price">
							<p><?= $this->element('price_product', array("item" => $product)); ?> </p>
						</div>
					</div>

					<div class="propose_slider_item_flex">
						<div class="propose_slider_item_kod">
							<p>Виробник: <span class="item_kod">
								<a href="<?= $this->Url->build(['controller' => 'producers','action'=>$product->producer->slug]) ?>" target="_blanck" ><?= $product->producer->name ?>
							    </a>
							</span></p>
						</div>

						<div class="product_status">
							<?php 	if ($product->amount > 0 ) { ?>
									<p class="on_sklad">На складі</p>
							<?php 	} ?>

							<?php if ($product->in_orders == true) { ?>
								<p class="in_orders">Під замовлення</p>
							<?php } ?>
					</div>
					</div>

					<div class="product_shop">
						<div class="product_shop_counter">
							<div class="product_shop_counter_left"><i class="fa fa-minus"></i></div>
							<output name="result" class="product_shop_counter_center">1</output>
							<div class="product_shop_counter_right"><i class="fa fa-plus"></i></div>
						</div>
						<div class="product_shop_buy">
							<img src="<?= $this->Url->build('/img/back.svg', ['fullBase' => true]) ?>" alt="">
							<p>Купити</p>
						</div>
						<div class="products_quick_buy"  data-toggle="modal" data-target="#exampleModal">
							<div class="products_quick_buy_left">
								<i class="fa fa-dollar"></i>
							</div>
							<p>Швидке замовлення</p>
						</div>
					</div>
					<div class="product_buttons"  data-product="2">
						<button class="add_product_to_wishlist" data-product="2">
							<i class="fa fa-heart"></i>
							В обрані
						</button>
						<button class="add_product_to_compare" data-product="<?= $product['id'] ?>">
							<i class="fa fa-exchange"></i>
							Порівняти
						</button>
					</div>
					<div class="product_paramth">
						<?php foreach ($option_group as $key => $value):?>
						<div class="product_paramth_item">
							<div class="product_paramth_title">
								<?= $key; ?>
							</div>
							<div class="product_paramth_select">
								
								<select name="" id="" class="change_price">
									<option value="">Виберіть опцію</option>
									<?php foreach ($value as $keys => $item): ?>
										<option <?php 	if ($keys == 0 AND $key == 0): ?> selected <?php 	endif; ?> value="<?= $item['name'] ?>"><?= $item['name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
					<?php if (!empty($main_attributes)): ?>
					<div class="product_description">
						<p class="product_description_title">Основні характеристики </p>

						<div class="product_description_container">
						
						<?php foreach ($main_attributes as $key => $value): ?>
							<p>
							<span><?php echo  $value['attributes_item']['name']; ?>: </span>
							<?php foreach ($value['attributes_item']['attributes_products'] as $keys => $item): ?>
								<span><?php echo  $item['value']; ?></span>
							<?php endforeach; ?>
							</p>
						<?php endforeach; ?>

						</div>
					</div>
                    <?php endif; ?>
				</div>
				
		</div>
			<div class="product_first">	
			<div class="product container">
				<div class="product_tabs">
					<div class="product_tabs_top">
						<p class="product_tabs_top_item product_tabs_top_item_active">Опис</p>
						<p class="product_tabs_top_item">Характеристики</p>
						<p class="product_tabs_top_item">Відеогляд</p>
						<p class="product_tabs_top_item">Відгуки (<?= count($product->rewiev); ?>)</p>
					</div>
					<div class="product_tabs_container">
                        <div class="product_tabs_item" style="display: block;">
                        	<?= $product->description; ?>
                        </div>
                         <div class="product_tabs_item">
                         	<table class="products_attributes_table">
                         		<thead>
                         			<th></th>
                         			<th></th>
                         		</thead>
                         		<tbody>
                         			<?php foreach ($attributes_products as $key => $value) :?>
                         				<tr>
                         					<td><?= $value['attributes_item']['name'] ?></td>
                         					<td><?= $value['value']; ?></td>
                         				</tr>
											
									<?php endforeach; ?>
                         		</tbody>
                         	</table>
                        </div>
                         <div class="product_tabs_item">
                        	<iframe src="<?= $product->video ?>" style="width: 100%;height: 400px;" frameborder="0"></iframe>
                        </div>
                         <div class="product_tabs_item">
                         	<?php if (empty($product->rewiev)): ?>
                            <p class="product_tabs_item_title">Відгуків про даний товар не має </p>
                            <p class="product_tabs_item_first">Станьте першим, хто оцінить продукт <?= $product->title ?></p>
                            </p>
                        <?php else: ?>
                        	<div class="products_rewievs">
                        	  <?php foreach ($product->rewiev as $key => $value): ?>
                        		<div class="products_rewievs_item">
                        			<div class="products_rewievs_item_top">
                        				<p><?= $value['rewiev_text'] ?></p>
                        				<p class="products_rewievs_item_top_data"><?= $value['created'] ?></p>
                        			</div>
                        		    <div class="products_rewievs_item_bottom">
                        		    	<p class="products_rewievs_item_bottom_title"><?= $value['user_name'] ?></p>
                        		    	<p><?php for ($i=0; $i < $value['rating'] ; $i++) { 
                     						 echo "<i class='fa fa-star' style='color: yellow;'>  </i>" ;
                    						} ?>
                      						</p>
                        		    </div>
                        		</div>
                        		<?php if (!empty($value['parent_review'])): ?>
                        		 <?php foreach ($value['parent_review'] as $keys => $item): ?>
                                
                        		 <div class="products_rewievs_item products_rewievs_item_answer">
                        			<div class="products_rewievs_item_top">
                        				<p><?= $item['rewiev_text'] ?></p>
                        				<p class="products_rewievs_item_top_data"><?= $item['created'] ?> </p>
                        			</div>
                        		    <div class="products_rewievs_item_bottom">
                        		    	<p class="products_rewievs_item_bottom_title">Адміністратор Proftorg</p>
                        		    	
                        		    </div>
                        		  </div>
                        	     <?php endforeach; ?>
                        	    <?php endif; ?>

                        	    <?php endforeach; ?>
                        	</div>
                        
                    <?php endif; ?>
                        	<div class="products_tabs_item_form">
                        	  <form action="" class="review_product">
                        	  	<p>Оцініть або задайте питання по продукту <?= $product->title ?></p>
                        		<p>Вашу email  адресу не буде публіковано. Заповніть відповідні поля * </p>
                        		<p class="products_tabs_item_form_title">Оцінка</p>
                        		<div class="products_tabs_item_form_stars clearfix">
                        			<input type="hidden" name="id_product" value="<?= $product->id ?>">
                        			<fieldset class="rating">
    									<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    									
    									<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    									
    									<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    									
    									<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    									
    									<input type="radio" id="star1" name="rating" value="1" checked /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    									
								</fieldset>
                        		</div>
                        		<div class="products_tabs_item_form_textarea">
                        			<p>Ваш відгук <span class="important_star">*</span></p>
                        			<textarea name="comment" id="" cols="30" rows="10" class="clear_input" required="required"></textarea>
                        		</div>
                        		<div class="products_tabs_item_form_inputs">
                        			<label for="user_name">Ваше ім'я <span class="important_star">*</span><br>
                        				<input type="text" name="user_name" 
                        				<?php 	if (isset($user->firstname)): ?> value="<?= $user->firstname." ".$user->lastname ?>" <?php 	endif; ?>
                        				 id="user_name" class="clear_input" required="required">
                        			</label>
                        			<label for="user_email">Email <span class="important_star"  >*</span><br>

                        				<input type="email" name="user_email" id="user_email" class="clear_input" required="required" <?php 	if (isset($user->firstname)): ?> value="<?= $user->mail ?>" <?php 	endif; ?>>
                        			</label>
                        		</div>
                        		<div class="products_tabs_item_form_submit">
                        			<input type="submit" value="Залишити відгук">
                        		</div>
                        		<div class="rewiew_message">
                        			
                        		</div>
                        	  </form>
                        	</div>
                        </div>
					</div>
				</div>
				</div>
				</div>		
				
				<div class="product container">
			<div class="products_second">
								<div class="product_tabs">
					<div class="product_tabs_top">
						<div class="products_second_item">
							<div class="products_second_top">
								<p class="products_second_top_title">Опис</p>
								<div class="products_second_close">
									<i class="fa fa-minus"></i>
								</div>
							</div>
							<div class="products_second_container" style="display: block;">
								<?= $product->description; ?>
							</div>
						</div>

						<div class="products_second_item">
							<div class="products_second_top">
								<p class="products_second_top_title">Характеристики</p>
								<div class="products_second_close">
									<i class="fa fa-plus"></i>
								</div>
							</div>
							<div class="products_second_container" >
								<?= $product->description; ?>
							</div>
						</div>

						<div class="products_second_item">
							<div class="products_second_top">
								<p class="products_second_top_title">Відео</p>
								<div class="products_second_close">
									<i class="fa fa-plus"></i>
								</div>
							</div>
							<div class="products_second_container" >
								<iframe src="<?= $product->video ?>" style="width: 100%;height: 300px;" frameborder="0"></iframe>
							</div>
						</div>

						<div class="products_second_item">
							<div class="products_second_top">
								<p class="products_second_top_title">Відгуки</p>
								<div class="products_second_close">
									<i class="fa fa-plus"></i>
								</div>
							</div>
							<div class="products_second_container" >

						<?php if (empty($product->rewiev)): ?>
                            <p class="product_tabs_item_title">Відгуків про даний товар не має </p>
                            <p class="product_tabs_item_first">Станьте першим, хто оцінить продукт <?= $product->title ?></p>
                            </p>
                        <?php else: ?>

                        	<div class="products_rewievs">
                        	  <?php foreach ($product->rewiev as $key => $value): ?>
                        		<div class="products_rewievs_item">
                        			<div class="products_rewievs_item_top">
                        				<p><?= $value['rewiev_text'] ?></p>
                        				<p class="products_rewievs_item_top_data"><?= $value['created'] ?></p>
                        			</div>
                        		    <div class="products_rewievs_item_bottom">
                        		    	<p class="products_rewievs_item_bottom_title"><?= $value['user_name'] ?></p>
                        		    	<p><?php for ($i=0; $i < $value['rating'] ; $i++) { 
                     						 echo "<i class='fa fa-star' style='color: yellow;'>  </i>" ;
                    						} ?>
                      						</p>
                        		    </div>
                        		</div>
                        		<?php if (!empty($value['parent_review'])): ?>
                        		 <?php foreach ($value['parent_review'] as $keys => $item): ?>
                                
                        		 <div class="products_rewievs_item products_rewievs_item_answer">
                        			<div class="products_rewievs_item_top">
                        				<p><?= $item['rewiev_text'] ?></p>
                        				<p class="products_rewievs_item_top_data"><?= $item['created'] ?> </p>
                        			</div>
                        		    <div class="products_rewievs_item_bottom">
                        		    	<p class="products_rewievs_item_bottom_title">Адміністратор Proftorg</p>
                        		    	
                        		    </div>
                        		  </div>
                        	     <?php endforeach; ?>
                        	    <?php endif; ?>

                        	    <?php endforeach; ?>
                        	</div>
                        
                    <?php endif; ?>
                        	<div class="products_tabs_item_form">
                        	  <form action="" class="review_product">
                        		<p>Оцініть або задайте питання по продукту <?= $product->title ?></p>
                        		<p>Вашу email  адресу не буде публіковано. Заповніть відповідні поля * </p>
                        		<p class="products_tabs_item_form_title">Оцінка</p>
                        		<div class="products_tabs_item_form_stars clearfix">
                        			<input type="hidden" name="id_product" value="<?= $product->id ?>">
                        			<fieldset class="rating">
    									<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    									
    									<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    									<
    									<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    									
    									<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    									
    									<input type="radio" id="star1" name="rating" value="1" checked /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    									
								</fieldset>
                        		</div>
                        		<div class="products_tabs_item_form_textarea">
                        			<p>Ваш відгук <span class="important_star">*</span></p>
                        			<textarea name="comment" id="" cols="30" rows="10" class="clear_input"></textarea>
                        		</div>
                        		<div class="products_tabs_item_form_inputs">
                        			<label for="user_name">Ваше ім'я <span class="important_star">*</span><br>
                        				<input type="text" name="user_name" id="user_name" class="clear_input" <?php 	if (isset($user->firstname)): ?> value="<?= $user->firstname." ".$user->lastname ?>" <?php 	endif; ?>>
                        			</label>
                        			<label for="user_email">Email <span class="important_star">*</span><br>
                        				<input type="email" name="user_email" id="user_email" class="clear_input"  <?php 	if (isset($user->firstname)): ?> value="<?= $user->mail ?>" <?php 	endif; ?>>
                        			</label>
                        		</div>
                        		<div class="products_tabs_item_form_submit">
                        			<input type="submit" value="Залишити відгук">
                        		</div>
                        		<div class="rewiew_message">
                        			
                        		</div>
                        	  </form>
                        	</div>
							</div>
						</div>
					</div>

				</div>
				</div>	
			</div>
		</div>

<div class="propose product_propose">
	<div class="propose_title product_propose_title">
		Подібні товари 
	</div>
			<div class=" propose_top propose_top_right container">
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
			<?php 	foreach ($products as $key => $value): ?>
					<div class="propose_slider_item <?= $this->element('action_product', array("item" => $value['actions_products'])); ?> ">
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
						<p class="on_sklad">На складі</p>
					</div>
					<div class="propose_slider_item_price">
						<?= $this->element('price_product', array("item" => $value)); ?>
					</div>

					<div class="product_buttons">
						<button type="button" class="product_buttons_item " data-product="<?= $value['id'] ?>">
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
              <?php 	endforeach; ?>
		</div>
	</div>
</div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content quick_buy_modal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Швидке замовлення</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body quick_buy_form">
        <form action="" class="quick_buy_form_submit">
        	<p class="quick_buy_form_title">Заповніть данні і наш менеджер звяжеться з вами</p>
        	<input type="text" name="user_name" placeholder="Ваше ім'я" required="true">
        	<input type="text" name="user_phone" placeholder="Ваш номер телефону" required="true">
        	<input type="hidden" name="product_id" value="<?= $product->id  ?>">
        	<div class="quick_buy_form_bottom">
        		<!-- 2 -->
				<div class="loader loader--style2 " title="1">
  					<svg version="1.1" id="loader-1" class="auth_loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     				width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
  					<path fill="#fff" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
    				<animateTransform attributeType="xml"
      									attributeName="transform"
      									type="rotate"
     									 from="0 25 25"
      									to="360 25 25"
      									dur="0.6s"
      									repeatCount="indefinite"/>
    				</path>
  					</svg>
				</div>
                <input type="submit" value="Підтвердити" class="quick_submit">
        	</div>
        	<div class="message_submit_quick_order"></div>
        </form>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --> 
    </div>
  </div>
</div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>


$(".products_second_close").click(function() {

	if ($(this).find('.fa').hasClass('fa-plus')) {
		$(".products_second_close").find('.fa').removeClass('fa-minus').addClass('fa-plus');
		$('.products_second_container').slideUp('fast');
		$(this).parent().parent().parent().find('.products_second_container').slideUp('fast');
		$(this).parent().parent().find('.products_second_container').slideToggle('fast');
		$(this).find('.fa').removeClass('fa-plus');
		$(this).find('.fa').addClass('fa-minus'); 
		return;
	}

	if ($(this).find('.fa').hasClass('fa-minus')) {
		$(".products_second_close").find('.fa').removeClass('fa-minus').addClass('fa-plus');
		$('.products_second_container').slideUp('fast');
		$(this).parent().parent().find('.products_second_container').slideToggle('fast');
		$(this).find('.fa').removeClass('fa-minus');
		$(this).find('.fa').addClass('fa-plus'); 
		return;
	}

})

$(function() {

 $('.product_left_slider').not('.slick-initialized').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: false, });



$(".product_gallery_item").click(function() {

 var index = $(this).parent().parent().attr('data-slick-index');


 $('.product_left_slider').slick('slickGoTo', index);
 
});


$('.propose_slider').not('.slick-initialized').slick({
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

    var id_product = <?= $product->id ?>;
    var start_price_default = <?= $product->price ?> ;
    var currency = <?= $product->currency_id ?>;
    var start_price = <?= $product->price ?> ;

    var products_options = <?= $option_group_json ?>;
    console.log(products_options);

    var first_selected_value = $(".product_paramth_title").eq(0).text();
    var default_selected_value = $(".change_price").eq(0).val();
    console.log(default_selected_value);

    if (default_selected_value != undefined) {
    var str = first_selected_value.toString();
   str = str.trim();
   str = str.replace('_', ' ').trim();

    //console.log(products_options[str][0]);

    for (i = 0; i < products_options[str].length; i++) {
        if (products_options[str][i]['name'] == default_selected_value) {
        		console.log(products_options[str][i]['products_options'][0]['value']);
        		start_price_default +=  products_options[str][i]['products_options'][0]['value'];
        		<?php 	if ($discount == false): ?>
        				$(".product_price .translate_price").text(start_price_default);
        				start_price = start_price_default;
        		<?php 	endif; ?>
        }
    }
}

   setTimeout(function() {
if (currency == 2) {
         	start_price = start_price * global_curs;
         }
         if (currency == 3) {
          start_price = start_price * global_curs_dollar;
          }

          if (currency == 1) {
          start_price = start_price * 1;
          }
   },1000);


     
    var count_id_bascket = 1;

	var total_options = new Map();
	var total_options_name = new Map();
	var array_options_name = new Map();



 $(".review_product").submit(function() {
       event.preventDefault(); 
        
       var element = $(this);
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');

       console.log($(this).serialize());
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'rewiev', 'action' => 'insert-comment', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
             $("#added_after_rewiev").modal({
              show: true
            }); 
             $(".clear_input").val("");
             $(".clear_input").text("");
             console.log(data);

             if (data.status == false) {
             	$(".rewiew_message").html("<p class='rewiew_message_alert btn-danger'><strong>Увага</strong> "+data.message+"</p>");
             }
             if (data.status == true) {
             	$(".rewiew_message").html("<p class='rewiew_message_good btn-success'><strong>Увага</strong> "+data.message+"</p>");
             }
        }
     });
     });
$(".change_price").change(function() {
   var index = $(this).parent().parent().find('.product_paramth_title').text();
   var str = index.toString();
   str = str.trim();
   str = str.replace('_', ' ').trim();
    
    //console.log(str);
  //  console.log(products_options);
   // console.log(str);
    //console.log(Object.keys(products_options));

    for (i = 0; i < products_options.length; i++) {
        products_options[i] = products_options[i].replace(/ +/g, '_').trim();
       // console.log(products_options[i]);
    }

   // console.log(products_options);
    
    console.log('size');
    console.log(products_options[str]);
    console.log('size');
    console.log(products_options[str].length);

    for (i = 0; i < products_options[str].length; i++) {
    	// console.log(products_options[str][i]['name']);
    	if (products_options[str][i]['name'] == $(this).val()) {
         // console.log(products_options[str][i]['products_options'][0]['value']);
    	}
    } 
    change_price();
});

function change_price() {
	 total_options = [];
	 array_options_name = [];
	 total_options_name = [];

	var new_price = 0;
	 $(".change_price").each(function() {
	 	  var index = $(this).parent().parent().find('.product_paramth_title').text();
   var str = index.toString();
   str = str.trim();
   str = str.replace('_', ' ').trim();

    for (i = 0; i < products_options[str].length; i++) {
    	if (products_options[str][i]['name'] == $(this).val()) {
         array_options_name.push(str);
         var key = products_options[str][i]['name'].toString();
         if ( products_options[str][i]['products_options'][0]['value']) {
         	total_options_name.push(products_options[str][i]['name'].toString());
          total_options.push(products_options[str][i]['products_options'][0]['value']);
         }

         console.log(products_options[str][i]);
         if (currency == 2) {
         	new_price = new_price + ( products_options[str][i]['products_options'][0]['value'] * global_curs);
         }
         if (currency == 3) {
          new_price = new_price + ( products_options[str][i]['products_options'][0]['value'] * global_curs_dollar);
          }

          if (currency == 1) {
          new_price = new_price + ( products_options[str][i]['products_options'][0]['value'] * 1);
          }

    	}
    }
	 });

	 console.log(total_options_name);
	 console.log(total_options);
     
     console.log(start_price);
	 new_price = new_price;
	 console.log(new_price);
	 $(".translate_price").text(Math.round(new_price));
}

$(".product_shop_counter_right").click(function() {
   count_id_bascket++;
   $(".product_shop_counter_center").text(count_id_bascket);
});

$(".product_shop_counter_left").click(function() {
   count_id_bascket--;
   if (count_id_bascket <=1) {
   	count_id_bascket = 1;
   }
   $(".product_shop_counter_center").text(count_id_bascket);
});


	$('.product_gallery').not('.slick-initialized').slick({
  infinite: true,
  slidesToShow: 2,
  slidesToScroll: 2
});  



$(".slider_arrow_left").click(function() {
 $(this).parent().parent().parent().find('.slick-prev.slick-arrow').trigger('click');
});

$(".slider_arrow_right").click(function() {
 $(this).parent().parent().parent().find('.slick-next.slick-arrow').trigger('click');
});

$(document).ready(function() {
  
  $(".product_shop_buy").click(function() {
  	console.log(total_options);
  	console.log(array_options_name);

    $.ajax({
        url: '<?= $this->Url->build(['controller' => 'carts', 'action' => 'add', '_full' => true]) ?>',
        method: 'POST',
  		data: { "product_id": id_product, "total_options":total_options, "array_options_name":array_options_name, "total_options_name":total_options_name, "count_id_bascket":count_id_bascket  },
  		success: function(data){ 
    		  setTimeout(function() {
    		$("#basket").modal({
        			show: true
            }); 
           }, 50);
        }
  	});

  });

});
});


	var $star_rating = $('.products_tabs_item_form_stars .fa');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();

$(document).ready(function() {
 
});


$(document).ready(function() {
    $(".quick_buy_form_submit").submit(function() {
       event.preventDefault(); 
       $('.auth_loader').css("display","inline-block");
       $(".quick_submit").css("display","none");
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'quick-orders', 'action' => 'quick-order', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
          $(".message_submit_quick_order").html("");
          console.log()

          if (data.status == "true")
           {

            setTimeout(function() {
               $(".message_submit_quick_order").html('<div class="message_submit_quick_order_message">'+
                ''+
                '<strong>Увага!</strong> Ваше замовлення прийнято'+
                '</div>');

               $('.auth_loader').css("display","none");
       		   $(".quick_submit").css("display","block");
       		   $(".quick_buy_form_submit input[type='text']").val("");
       		   $(".quick_buy_form_submit input[type='number']").val("");
             },1000); 
           }

           
        }
     });
    }); 
});


$(document).ready(function() {

 $('.gallery_item').magnificPopup({
  type: 'image',
  gallery:{
    enabled:true
  }
});

});
	<?php echo $this->Html->scriptEnd(); ?>
</script>