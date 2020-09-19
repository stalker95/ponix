 
 <div class="filter_container">
	<div class="filter_container_title">
		<p>Фільтрувати за ціною</p>
	</div>
	<div class="filter_range_price">
		<div class="filter_range_container">
			<div class="slider-wrap">
    		<div id="slider"></div>
      			<div class="values">
        			<input type="text" name="start_price" class="sliderValue" data-index="0" value="<?= $min_price ?>" />
        			<input type="text" name="end_price" class="sliderValue" data-index="1" value="<?= $max_price ?>" />
    			</div>
 		 </div>
 		 <div class="filter_button">
 		 	<button class="button_filter">Фільтрувати</button>
 		 </div>
		</div>

		 <?php   if ($producers_page): ?>
 		 <div class="filter_elements_items">
 		 	<?php 	foreach ($attributes_to_view as $key => $value) :?>
 		 		<?php if (!empty($value)): ?>
 		 		<div class="filter_elements_items_item">
          <div class="filter_elements_items_item_top">
            <p class="filter_elements_items_item_title"><?= $key ?></p>
            <div class="filter_elements_items_item_close "><i class="fa fa-plus"></i></div>
          </div>
 		 			
          <div class="filter_elements_items_item_bottom" style="display: none;">
 		 			<?php 	foreach ($value as $keys => $item):  ?>
            <?php $checkbox_name = str_replace('.', '--', $item['name']);  
            $checkbox_name = str_replace(' ', '-', $checkbox_name);
             ?>
                    <input id="checkbox_<?php echo str_replace(' ', '-', $checkbox_name) ?>_<?= $item['attribute_id'] ?>" 
                           name="checkbox_<?php echo str_replace(' ', '-', $checkbox_name) ?>_<?= $item['attribute_id'] ?>" 
                           type="checkbox"

                            <?php
                           if (isset($selected_values["checkbox_".$checkbox_name."_".$item['attribute_id'].""])): ?>
                           	checked
                           <?php endif; ?>
                           >
 		 			<label for="checkbox_<?php echo str_replace(' ', '-', $checkbox_name) ?>_<?= $item['attribute_id'] ?>"><?= $item['name'] ?> (<?= $item['count'] ?>)</label>
 		 			<?php 	endforeach; ?>
          <div class="filter_button">
            <button class="button_filter">Фільтрувати</button>
          </div>
          </div>
          
 		 		</div>
 		 	<?php endif;	endforeach; ?>

               
 		 	
 		 </div>

       <?php   if ($producers_page) { ?>   
        <div class="filter_container_title">
          <p>Виробники</p>
        </div>
             <div class="filter_elements_items">
        <div class="filter_elements_items_item">
          <p class="filter_elements_items_item_title">Виробники</p>
          <?php   foreach ($producers_list as $keys => $item):  ?>
                    <input id="producer_<?= $item['name'] ?>_<?= $item['id'] ?>" 
                           name="producer_<?= $item['name'] ?>_<?= $item['id'] ?>" 
                           type="checkbox" 
                           <?php if (isset($selected_values["producer_".$item['name']."_".$item['id'].""])): ?>
                            checked
                           <?php endif; ?>
                           >
          <label for="producer_<?= $item['name'] ?>_<?= $item['id'] ?>"><?= $item['name'] ?> (<?= $item['count'] ?>)</label>
          <?php   endforeach; ?>
          <div class="filter_button">
            <button class="button_filter">Фільтрувати</button>
          </div>
        </div>
      </div>
      <?php } ?>

           <?php   endif; ?>

	</div>
</div>
<script src='https://code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>

   	$(document).ready(function() {
    $("#slider").slider({
        range: true,
        min: <?= $current_value_min ?>,
        max: <?= $current_value_max ?>,
        step: 1,
        values: [<?= $min_price ?>, <?= $max_price?>],
        animate: 300,
        slide: function(event, ui) {
            for (var i = 0; i < ui.values.length; ++i) {
                $("input.sliderValue[data-index=" + i + "]").val(ui.values[i]);
            }
        }
    });

    $("input.sliderValue").change(function() {
        var $this = $(this);
        $("#slider").slider("values", $this.data("index"), $this.val());
    });
});

	<?php echo $this->Html->scriptEnd(); ?>
</script>