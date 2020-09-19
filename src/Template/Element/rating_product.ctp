
<?php $count = 0; ?>
<?php foreach ($item['rewiev'] as $key => $value): 
   $count = $count + $value['rating'];
 endforeach; ?>
<?php 	$total_count = 0; 
      if (count($item['rewiev']) == 0) {
      	$count_rewiev = 0;
 } else {
 	$count_rewiev  =  $count / count($item['rewiev']);
 }

if (count($item['rewiev']) == 0) { 
 for ($i = 0; $i < 5 ; $i++) : ?>

	<div class="product-star-item">
		<svg xmlns="http://www.w3.org/2000/svg" width="26.087" height="25" viewBox="0 0 26.087 25"><path style="fill:#e1e1e1;" d="M44.993,41.034a1.05,1.05,0,0,0-1.011.772L41.417,49.73H32.993a1.076,1.076,0,0,0-1.043,1.092,1.064,1.064,0,0,0,.451.87c.168.114,6.8,4.962,6.8,4.962s-2.549,7.826-2.6,7.951a1.183,1.183,0,0,0-.065.369,1.054,1.054,0,0,0,1.658.87L44.993,60.9s6.641,4.837,6.794,4.946a1.054,1.054,0,0,0,1.657-.87,1.163,1.163,0,0,0-.065-.369c-.049-.125-2.6-7.951-2.6-7.951s6.635-4.848,6.8-4.962A1.084,1.084,0,0,0,57,49.73H48.58L46,41.806A1.049,1.049,0,0,0,44.993,41.034Z" transform="translate(-31.95 -41.034)"/></svg>
	</div>

<?php endfor;  
} else {
  for ($i = 0; $i < $count_rewiev ; $i++) : ?>

	<div class="product-star-item">
		<svg xmlns="http://www.w3.org/2000/svg" width="26.087" height="25" viewBox="0 0 26.087 25"><path style="fill:#FCDB38;" d="M44.993,41.034a1.05,1.05,0,0,0-1.011.772L41.417,49.73H32.993a1.076,1.076,0,0,0-1.043,1.092,1.064,1.064,0,0,0,.451.87c.168.114,6.8,4.962,6.8,4.962s-2.549,7.826-2.6,7.951a1.183,1.183,0,0,0-.065.369,1.054,1.054,0,0,0,1.658.87L44.993,60.9s6.641,4.837,6.794,4.946a1.054,1.054,0,0,0,1.657-.87,1.163,1.163,0,0,0-.065-.369c-.049-.125-2.6-7.951-2.6-7.951s6.635-4.848,6.8-4.962A1.084,1.084,0,0,0,57,49.73H48.58L46,41.806A1.049,1.049,0,0,0,44.993,41.034Z" transform="translate(-31.95 -41.034)"/></svg>
	</div>

<?php endfor; ?>

<?php  for ($i = 0; $i < 4 - round($count_rewiev); $i++) : ?>

	<div class="product-star-item">
		<img src="<?= $this->Url->build('/img/gray_star.svg', ['fullBase' => true]) ?> " alt=""> 	
	</div>

<?php endfor; ?>
<?php 	} ?>
