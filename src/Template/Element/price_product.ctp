
	<?php 	 $data = date("Y-m-d H:i:s"); ?>
	<?php 	

	$price_product = $item['price'];
	$old_price = $item['price'];
	$products_discount = $item['price'];
	$product_discount;
	$discount = false;
	//echo "1";
	//debug($item['products_options']);

	

	if (isset($item->producer->producers_discounts[0]['discount'])) {
		$price_discount = $item->producer->producers_discounts[0]['discount'];
	}
  
	foreach ($item['discounts'] as $key => $values): 
		$date_compare1= date("Y-m-d H:i:s", strtotime($data));
				// date now
		$date_compare2= date("Y-m-d H:i:s", strtotime($values['end_data']->i18nFormat('YYY-MM-dd')));
		$start_data = date("Y-m-d H:i:s", strtotime($values['start_data']->i18nFormat('YYY-MM-dd')));

		if ($date_compare1 < $date_compare2 AND $date_compare1 > $start_data) {
			$product_discount = $values['price'];
			$discount = true;
			break;
		}

	 	endforeach; 

	 	if (isset($item->producer->producers_discounts[0]['discount'])) {
	 		$persent = $item->producer->producers_discounts[0]['discount'];
	 		$price_product =  $price_product - ($price_product * ($persent / 100)) ;
	 }

	 if (!empty($item['products_options']) AND isset($item['products_options'])) {
      $price_product = $item['products_options'][0]->value;    
	}
?>
	 	<?php if ($discount == true ) { ?>
	<p>
		<span class="translate_price" data-currency="<?= $item['currency_id'] ?>">
			<?= $product_discount ?> 
		</span>   грн 
	</p>

	<p class="slider_item_price_old">
		<span class="translate_price" data-currency="<?= $item['currency_id'] ?>">
			<?=  $price_product ?>
		</span> грн
	</p>

	<p class="slider_item_discount">-
		<?php 
		
		$persent = $price_product / 100; 
		$difference = ($price_product - ($product_discount)) / $persent;  
		echo round($difference).'%</p>';

	
			?>
	<?php 	 } else { ?>
	<p>
		<span class="translate_price" data-currency="<?= $item['currency_id'] ?>">
			<?= $price_product ?>
		</span> грн
	</p>
<?php } ?>

