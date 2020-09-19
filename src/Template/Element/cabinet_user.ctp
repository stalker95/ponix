<ul>
	<li>
		<a href="<?php echo $this->Url->build(['controller' => 'cabinet', 'action' => 'cabinet', '_full' => true,  'plugin' => false]); ?>" class="<?php if ($item == 'main'): ?> active  <?php 	endif; ?>">Особисті данні</a></li>
	<li>
		<a href="<?php echo $this->Url->build(['controller' => 'cabinet', 'action' => 'wishlist', '_full' => true,  'plugin' => false]); ?>" class="<?php if ($item == 'wishlist'): ?> active  <?php 	endif; ?>">Список бажань</a></li>
	<li>
		<a data-toggle="modal" data-target="#basket">Кошик</a></li>
	<li>
		<a class="<?php if ($item == 'orders'): ?> active  <?php 	endif; ?>" href="<?php echo $this->Url->build(['controller' => 'cabinet', 'action' => 'orders', '_full' => true,  'plugin' => false]); ?>">Мої замовлення</a>
	</li>
	<li>
		<a class="<?php if ($item == 'review'): ?> active  <?php 	endif; ?>" href="<?php echo $this->Url->build(['controller' => 'cabinet', 'action' => 'review', '_full' => true,  'plugin' => false]); ?>">Мої відгуки</a>
	</li>
		<li>
		<a  href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'logout', '_full' => true,  'plugin' => false]); ?>">Вийти</a>
	</li>
</ul>