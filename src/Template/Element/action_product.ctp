<?php 
  $data_today = date('Y-m-d H:i:s');
  $new_date = date('Y-m-d H:i:s', strtotime($data_today));

  foreach ($item as $key => $value):
     if(date('Y-m-d H:i:s', strtotime($value['action']['date_end'])) > $new_date ) {
     	echo "propose_slider_item_show_action";
     	break;

     }
  endforeach;

 ?>
