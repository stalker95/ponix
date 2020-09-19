	<?php 	 $data = date("Y-m-d H:i:s"); ?>
	<?php 	
	$final_price = 0;
	//echo "1";

	foreach ($item['discounts'] as $key => $values): 
		if (strtotime($values['end_data']) > strtotime($data) AND strtotime($values['start_data']) < strtotime($data) ) {
			$final_price = $values['price'];
			break;
		}
	 	endforeach; ?>
	 	<?php if ($final_price != 0 ) {?>
	<p>
		<span class="translate_price" data-currency="<?= $item['currency_id'] ?>">
			<?= $final_price ?>
		</span> грн
	</p>

	<p class="slider_item_price_old">
		<span class="translate_price" data-currency="<?= $item['currency_id'] ?>">
			<?= $item['price'] ?>
		</span> грн
	</p>

	<p class="slider_item_discount">-<?php $persent = $item['price'] / 100; $difference = ($item['price'] - $final_price) / $persent;  echo round($difference); ?>%</p>
	<?php 	} else { ?>
	<p>
		<span class="translate_price" data-currency="<?= $item['currency_id'] ?>">
			<?= $item['price'] ?>
		</span> грн
	</p>
<?php } ?>