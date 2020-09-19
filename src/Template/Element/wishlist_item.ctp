
<?php 	$arrays = array_column($item, 'user_id'); ?>

<?php 	if (isset($user) AND $user != null AND in_array($user->id, $arrays)) {
	echo 'added_product_to_wishlist';
} else {
	echo "add_product_to_wishlist";
} ?>