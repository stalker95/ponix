<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<div class="breadcrums">
	<div class="breadcrums_list">
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index']) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'cabinet','action'    =>  'wishlist']) ?>">Список бажань</a>
			
			
		</div>
	</div>
</div>

<div class="white_container container">
	<div class="row">	

	<div class="col-md-3">
		<div class="cabinet_navigation">
			<div class="cabinet_navigation_title">
				<p>Мій кабінет</p>
			</div>
			<div class="cabinet_navigation_list">
				 <?= $this->element('cabinet_user', array('item' => 'wishlist')); ?>
				
			</div>
		</div>
	</div>
	<div class="col-md-9">
    <form action="<?= $this->Url->build(['controller' => 'cabinet','action'    =>  'wishlist']) ?>" method="get" id="product_sort">

    <div class="wishlist_total" style="display: none;">
      <?php   foreach ($wishlist as $key => $value): ?>
      <span class="translate_price" data-currency="<?= $value['product']['currency_id'] ?>"> <?= $value['product']['price'] ?></span>
      <?php  endforeach;  ?>
    </div>
		<div class="cabinet_title">Список бажань</div>
        <div class="wishlist_container">
        	<div class="wishlist_container_top">
        		<div class="wishlist_left">
        			<div class="wishlist_left_total"><?= count($wishlist); ?> товари на суму <strong><span class="total_wishlist"></span> грн  </strong> </div>
        			<div class="wishlist_left_buy">
        				<div class="product_shop_buy">
                  <a href="<?= $this->Url->build(['controller' => 'cabinet','action'=>'buy-all-list']) ?>">
							<img src="<?= $this->Url->build('/img/back.svg', ['fullBase' => true]) ?>" alt="">
							<p>Купити</p>
              </a>
						</div>
					</div>
        		</div>
            <div class="delete_wishlist delete_form_checked" style="display: none;">
               <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'cabinet','action' => 'deletechecked'
           )])  ?>
           <div class="delete_form_checked_inputs"> </div>
           <button type="submit" >Видалити</button>
           <?=   $this->Form->end() ?>
            </div>

        		<div class="wishlist_right">
        			<div class="center">
	          				<p class="sorter_title">Сортувати</p>
  								<select name="sort_by" id="sort_by" class="custom-select custom-select-two sources"
  								 <? if (isset($sort_by)){ ?> placeholder="<?= $sort_by ?>"  
  								 <?php 	} else { ?>
  								 	placeholder="За рейтингом"
  								 <?php } ?>>
    								<option value="За рейтингом">За рейтингом</option>
	          				<option value="За спаданням ціни">За спаданням ціни</option>
	          				<option value="За зростанням ціни">За зростанням ціни</option>
	          				<option value="Акційні">Акційні</option>
 								 </select>
						</div>
        		</div>
        	</div>
        	<div class="wishlist_container wishlist_container_products">
            <?php if (empty($wishlist)): ?>
              <p>Список бажань пустий</p>
            <?php endif; ?>
        		<?php foreach ($wishlist as $key => $value): ?>
        		<div href="<?php echo $this->Url->build(['controller' => 'products','action'=> $value['product']['slug']]) ?>" class="propose_slider_item <?= $this->element('action_product', array("item" => $value['product']['actions_products'])); ?>">
        			<div class="filter_elements_items">
        				<input id="information_<?= $key ?>" name="info" type="checkbox" value="<?= $value['product']['id'] ?>" class="delete_item">
            	<label for="information_<?= $key ?>"></label>
        			</div>
	          			<div class="propose_slider_item_action"><p>Акція</p></div>
					<a href="<?= $this->Url->build(['controller' => 'products','action'=>$value['product']['slug']]) ?>" class="propose_slider_item_image">
						<img src="<?= $this->Url->build('/products/'.$value['product']['image'], ['fullBase' => true]) ?> " alt="">
					</a>
					<div class="propose_slider_item_stars">
						<?= $this->element('rating_product', array("item" => $value['product'])); ?>
					</div>
					<div class="propose_slider_item_title">
						<p><a href="<?= $this->Url->build(['controller' => 'products','action' => $value['product']['slug']]) ?>"><?= $value['product']['title'] ?></a></p>
					</div>
					<div class="propose_slider_item_kod">
						<p>Код товару <span class="item_kod"><?= $value['product']['cod'] ?></span></p>
					</div>
					<div class="propose_slider_item_status">
						<?php if ($value['product']['amount'] > 0) { ?>
						<p class="on_sklad">На складі</p>
					<?php } ?>
					<?php if ($value['product']['in_orders'] == true) { ?>
						<p class="in_orders">Під замовлення</p>
					<?php } ?>
					</div>
					<div class="propose_slider_item_price">
						<?= $this->element('price_product', array("item" => $value['product'])); ?>
					</div>
          <div class="product_buttons">
            <button class="product_buttons_item add_product_to_bascket" data-product="<?= $value['product']['id'] ?>">
              <img src="<?= $this->Url->build('/img/back.svg', ['fullBase' => true]) ?>" alt="">
            </button>
            <a href="<?= $this->Url->build(['controller' => 'products','action'=>$value['product']['slug']]) ?>" class="product_buttons_item" >
              <i class="fa fa-eye"></i>
            </a>
           
            <button class="product_buttons_item add_product_to_compare" data-product="<?= $value['id'] ?>">
              <i class="fa fa-exchange"></i>
            </button>
          </div>
					
				</div>
			<?php endforeach; ?>
        	</div>
        </div>
                 <?=   $this->Form->end() ?>

	</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content quick_buy_modal">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Змінити</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body quick_buy_form change_password_form">
        <form action="" class="quick_buy_form_submit">
        	<p class="quick_buy_form_title">Заповніть данні і наш менеджер звяжеться з вами</p>
        	<input type="password" name="old_password" placeholder="Старий пароль" required="true">
        	<input type="password" name="new_password" placeholder="Новий пароль" required="true">
        	<input type="password" name="confirm_new_password" placeholder="Підвердіть пароль ">
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

<div class="modal fade" id="mediaGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="gallery-box form__inline" style="text-align: center;">
          <h2 style="text-align: center;">Ви хочете видалити товари із списку бажаних ?</h2>
          <div class="gallery-box_inside">  
          <button class="close_modal_form close__modal btn btn-danger" >Ні</button>
           <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'cabinet','action' => 'deletechecked'
           )])  ?>
           <div class="delete_form_checked_inputs"> </div>
           <?=  $this->Form->submit('Так ',['class'=>'btn  btn-success save__changes__form__playlist','style'=>'margin-top:0px;margin-left:auto;margin-right:auto;']); ?>
           <?=   $this->Form->end() ?>
           </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>
    setTimeout(function() {
     var total = 0;

     $(".wishlist_total .translate_price").each(function() {
        total = total + parseInt($(this).text()); 
     });
     $(".total_wishlist").text(total);
    },1500);

  var count=0;
var mass= new Array();
  $(document).ready(function(){
$('body').on('click',".delete_item" , function() {
   count=$(".delete_item:checked").length;
   var id=$(this).index();
   var value=$(this).val();
if ($(this).is(":checked")) {
     mass.push(value);
}
else {
  var index = mass.indexOf(value);
if (index >= 0) {
  mass.splice( index, 1 );
}
}
console.log(unique(mass));
show_delete_form();
check_fill_checkbox();
 });

 function unique(arr) {
  var result = [];

  nextInput:
    for (var i = 0; i < arr.length; i++) {
      var str = arr[i]; // для каждого элемента
      for (var j = 0; j < result.length; j++) { // ищем, был ли он уже?
        if (result[j] == str) continue nextInput; // если да, то следующий
      }
      result.push(str);
    }

  return result;
}

function show_delete_form() {
  var html="";
   $(".delete_form_checked_inputs").html("");
   console.log(mass.length);
     if (mass.length!=0) {
       $(".delete_form_checked").css("display","inline-block");
       for (var i=0;i<mass.length;i++) {
         html=html+"<input type='text' name='ids[]' style='display:none;' value="+mass[i]+" id="+mass[i]+"/>";
       }
    $(".delete_form_checked_inputs").html(html);
  }
}
function hide_delete_form() {
  var html="";
   $(".delete_form_checked_inputs").html("");
   $(".delete_form_checked").css("display","none");
}

function check_fill_checkbox() {
   if ($(".delete_item:checked").length==0) {
     $(".delete_form_checked_inputs").html("");
   $(".delete_form_checked").css("display","none");
        $('#delete-all').prop('checked', false); 
   hide_delete_form();
   }
}
});
    $(".change_form").click(function() {
       $(".cabinet_data_first").css('display', 'none');
       $(".cabinet_data_second").css('display', 'block');
    });

    $(".close_second_form").click(function() {
       $(".cabinet_data_first").css('display', 'block');
       $(".cabinet_data_second").css('display', 'none');
    });
    

    $(function() {
   // enable_cb();
    $("#information").click(enable_cb);
});


    function enable_cb() {
    $("#code").prop("disabled", !this.checked);
     $("#full_name").prop("disabled", !this.checked);
}

   

      


    $(".quick_buy_form_submit").submit(function() {
       event.preventDefault(); 
       $('.auth_loader').css("display","inline-block");
       $(".quick_submit").css("display","none");
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'users', 'action' => 'change-password', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
          $(".message_submit_quick_order").html("");
          console.log(data.status);

          if (data.status == true)
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
           } else {
           	setTimeout(function() {
           		$('.auth_loader').css("display","none");
       		   $(".quick_submit").css("display","block");

            $(".message_submit_quick_order").html('<p class="display_message_register_alert btn-danger"><strong>Увага</strong> '+data.message+'</p>');
            },1000); 
           }

           
        }
     });
    }); 

    $("#sort_by").change(function() {
               $("#product_sort").submit();
        });

        

    <?php echo $this->Html->scriptEnd(); ?>
</script>