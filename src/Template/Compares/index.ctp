<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<div class="breadcrums">
	<div class="breadcrums_list">
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  '/']) ?>">Головна</a>
			<span> / </span>
      <a href="<?= $this->Url->build(['controller' => 'compares','action'    =>  'index']) ?>">Порівняння</a>
			
			
		</div>
	</div>
</div>

<div class="white_container container">
	<div class="orders_container">
    <div class="compares_page_top">
      <p class="title_of_compare">Порівнюємо <?= $category->title ?></p>
      <?=   $this->Form->postLink('<span class="delete_category_slug">Очистити всі</span>', ['action' => 'delete-all-category', $category->slug], ['class'=>'btn  delete__user','escape' => false]); ?>
</div>
      
      
      <div class="list_of_params">

        <div class="list_of_params_column">
          <div class="lists_if_compares_item lists_if_compares_item_add">
          <div class="lists_if_compares_item_top">
            <?php if (!empty($category->picture)): ?>
                          <img src="<?= $this->Url->build('/categories/'.$category->picture, ['fullBase' => true]) ?>" alt="" class="lists_if_compares_item_top_image">

            <?php else: ?>
              <img src="<?= $this->Url->build('/img/unnamed.png', ['fullBase' => true]) ?>" alt="" class="lists_if_compares_item_top_image">
            <?php endif; ?>
            <a href="<?= $this->Url->build(['controller' => 'categories','action'    =>  $category->slug]) ?>" target="_blank">Додати ще одну модель</a>
          </div>
          
        </div>
        <p class="params_title">
        Параметри
      </p>

        <div class="container_of_paramth">
           <?php foreach ($new_last as $key => $value): ?>
              <p><?= $value; ?> </p>
            <?php endforeach; ?>
        </div>
          
        </div>


        <?php foreach ($products as $key => $value): ?>
                  <div class="list_of_params_column">
          <div class="lists_if_compares_item">
          <div class="lists_if_compares_item_top">
            <img src="<?= $this->Url->build('/products/'.$value['image'], ['fullBase' => true]) ?>" alt="" class="lists_if_compares_item_top_image">
            <a href="<?= $this->Url->build(['controller' => 'products','action'    =>  $value['slug']]) ?>"><?= $value['title']; ?></a>
          </div>
          <div class="lists_if_compares_item_bottom">
            <p class="bascket_item_price lists_if_compares_item_bottom_price">
              <span class="translate_price" data-currency="<?= $value['currency_id'] ?>"><?= $value['price'] ?></span> грн
            </p>
            <div class="lists_if_compares_item_bottom_buttons">
              <button class="product_buttons_item add_product_to_bascket" data-product="<?= $value['id'] ?>">
                <img src="<?= $this->Url->build('/img/back.svg', ['fullBase' => true]) ?>" alt="">
              </button>
              
            <button class="product_buttons_item  <?= $this->element('wishlist_item', 
            array("item" => $value['wishlists'], 
                  'product' => $value['id'],
                  'user' => $user)); ?>" data-product="<?= $value['id'] ?>">
              <img src="<?= $this->Url->build('/img/favorite.svg', ['fullBase' => true]) ?>" alt="">
            </button>
            </div>
          </div>
          <?=   $this->Form->postLink('<i class="fa fa-close delete_compare"></i>', ['action' => 'delete', $value['id']], ['class'=>'btn  delete__user','escape' => false]); ?>
        </div>
        <div class="container_of_paramth_of_product">
            <?php 
          
            $i = 0;
            $values_of_product = [];
            $array_two = [];
            foreach($value['attributes_products'] as $keys => $item){
           // var_dump($item);
           // die();
              $values_of_product[] = array_values((array)$item['attributes_item']['name']);
              $array_two[] = array_values((array)$item);
            }
            

          //  var_dump($values_of_product);
             

              foreach ($attributes_list as $key_attribute => $attribute_item) {
                if (in_array($attribute_item[0], $values_of_product)) {
                  echo "full";
                }
              //  var_dump($attribute_item[0]);
               // echo "----";
               // echo "<br>";
               // var_dump($values_of_product);
               // echo "=====";
               // echo "<br>";
               // echo "---------------------";
               // echo "<br>";
                $empty = false;
                //var_dump($attributes_list)
               // var_dump(array_diff($attributes_list, $values_of_product));

             foreach ($values_of_product as $key_two => $item_two) {
              if ($item_two[0] == $attribute_item[0] AND in_array($attribute_item[0], $new_last)) {
                echo "<p><span class='name_of_param'>".$attribute_item[0]."</span>".$array_two[$key_two][1]['value']."</p>";
                $empty = true;
              }
             


              
            
             } 

           }
            //  echo "<p>".$item['value']."</p>";
              //var_dump($item);
           // $cleared_inputs = array_column($all_values, 'name');
           // var_dump($cleared_inputs);
           // var_dump(array_values((array)$item['attributes_item']['name']));
           // $values_of_product = array_values((array)$item['attributes_item']['name']);
           // var_dump(array_diff($cleared_inputs, values_of_product));

                //debug(array_values((array)$value['attributes_products'][$keys]['attributes_item']['name']));
               // debug(array_values((array)$item['attributes_item']['name']));
               // die();
              //debug($attributes_list[$keys]);
               ?>
             
            </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>





  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>


	<?php echo $this->Html->scriptEnd(); ?>
</script>
