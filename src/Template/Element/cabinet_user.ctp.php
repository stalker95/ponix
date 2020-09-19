<ul>
	<?php 	debug($item); ?>
	<li><a href="" class="<?php if ($item == 'main'): ?> active  <?php 	endif; ?>" >Особисті данні</a></li>
	<li><a href="<?php echo $this->Url->build(['controller' => 'cabinet', 'action' => 'wishlist', '_full' => true, 'prefix' => 'admin', 'plugin' => false]); ?>">Список бажань</a></li>
	<li><a href="">Кошик</a></li>
	<li><a href="">Мої замовлення</a></li>
	<li><a href="">Мої замовлення</a></li>
</ul>