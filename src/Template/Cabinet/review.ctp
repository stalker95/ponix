
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<div class="breadcrums">
	<div class="breadcrums_list">
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index']) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'cabinet','action'    =>  'review']) ?>">Відгуки</a>
			
			
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
				 <?= $this->element('cabinet_user', array('item' => 'review')); ?>
				
			</div>
		</div>
	</div>
	<div class="col-md-9">
    <div class="review_container">
      <?php if (empty($reviews)): ?>
        <p>Ви не поставили комантарі жодному товару. </p>
      <?php endif; ?>
      <?php foreach ($reviews as $key => $value):?>
      <div class="review_container_item">
        <div class="review_container_item_image">
          <img src="<?= $this->Url->build('/products/'.$value['product']['image'], ['fullBase' => true]) ?>" alt="">
        </div>
        <div class="review_container_item_description">
          <p class="review_container_item_description_title">
            <a href="<?= $this->Url->build(['controller' => 'products','action'    =>  'views/'.$value['product']['slug']]) ?>"><?= $value['product']['title'] ?></a>
          </p>
          <p class="review_container_item_description_text">
            <?= $value['rewiev_text'] ?>
          </p>
        </div>
      </div>
     <?php endforeach; ?>

    </div>
	</div>
 </div>
</div>


<!-- <div class="modal fade" id="mediaGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
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
</div> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>

$(".orders_leave_review").click(function() {
  $(".slider_arrow_left").click(function() {
 $(this).parent().parent().parent().find('.slick-prev.slick-arrow').first().trigger('click')
});

$(".slider_arrow_right").click(function() {
 $(this).parent().parent().parent().find('.slick-next.slick-arrow').first().trigger('click')
});
  setTimeout(function() {
$('.products_review_container').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
  {
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
    },
    breakpoint: 993,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
    },
  }]
}); 
  },250)
 
});




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

    <?php echo $this->Html->scriptEnd(); ?>
</script>