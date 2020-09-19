<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<div class="breadcrums">
	<div class="breadcrums_list">
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index']) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'rewievs','action'    =>  '/index']) ?>">Відгуки</a>
			<span> / </span>
			
			
		</div>
	</div>
</div>
<div class="white_container container">
	<div class="row">
		<div class="rewievs_container">

		<div class="col-md-offset-1 col-md-9 ">
         <?php 	if (empty($rewievs)): ?>
         	<p class="empty_review">Відгуків поки немає, будьте першим залишіть відгук!</p>
         <?php 	endif; ?>
                         	  <?php foreach ($rewievs as $key => $value): ?>
                        		<div class="products_rewievs_item">

                        			<div class="products_rewievs_item_top">
                        				<p><span class="reviev_left"> Відгук про товар:</span> <?= $value['product']->title ?></p>
                        			</div>

                        			<div class="products_rewievs_item_top">
                        				<p><span class="reviev_left"> <?= $value['user_name'] ?></span> <?= $value['rewiev_text'] ?></p>
                        				<p class="products_rewievs_item_top_data"><?= $value['created'] ?></p>
                        			</div>
                        		    <div class="products_rewievs_item_bottom">
                        		    	<p><?php for ($i=0; $i < $value['rating'] ; $i++) { 
                     						 echo "<i class='fa fa-star' style='color: yellow;'>  </i>" ;
                    						} ?>
                      						</p>
                        		    </div>
                        		</div>
                        		<?php if (!empty($value['parent_review'])): ?>
                        		 <?php foreach ($value['parent_review'] as $keys => $item): ?>
                                
                        		 <div class="products_rewievs_item products_rewievs_item_answer">
                        			<div class="products_rewievs_item_top">
                        				<p><span class="reviev_left"> Адміністратор Proftorg </span> <?= $item['rewiev_text'] ?></p>
                        				<p class="products_rewievs_item_top_data"><?= $item['created'] ?> </p>
                        			</div>
                        		  </div>
                        	     <?php endforeach; ?>
                        	    <?php endif; ?>

                        	    <?php endforeach; ?>

		</div>

		</div>
	</div>
</div>




<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>


$(".products_second_close").click(function() {

	if ($(this).find('.fa').hasClass('fa-plus')) {
		$(".products_second_close").find('.fa').removeClass('fa-minus').addClass('fa-plus');
		$('.products_second_container').slideUp('fast');
		$(this).parent().parent().parent().find('.products_second_container').slideUp('fast');
		$(this).parent().parent().find('.products_second_container').slideToggle('fast');
		$(this).find('.fa').removeClass('fa-plus');
		$(this).find('.fa').addClass('fa-minus'); 
		return;
	}

	if ($(this).find('.fa').hasClass('fa-minus')) {
		$(".products_second_close").find('.fa').removeClass('fa-minus').addClass('fa-plus');
		$('.products_second_container').slideUp('fast');
		$(this).parent().parent().find('.products_second_container').slideToggle('fast');
		$(this).find('.fa').removeClass('fa-minus');
		$(this).find('.fa').addClass('fa-plus'); 
		return;
	}

})

$(function() {

 $('.product_left_slider').not('.slick-initialized').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: false, });



$(".product_gallery_item").click(function() {

 var index = $(this).parent().parent().attr('data-slick-index');


 $('.product_left_slider').slick('slickGoTo', index);
 
});


$('.propose_slider').not('.slick-initialized').slick({
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
  {
    breakpoint: 993,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
    },
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
    }
  }]
});  

    var id_product = <?= $product->id ?>;
    var start_price_default = <?= $product->price ?> ;
    var currency = <?= $product->currency_id ?>;
    var start_price = <?= $product->price ?> ;

    var products_options = <?= $option_group_json ?>;
    console.log(products_options);

    var first_selected_value = $(".product_paramth_title").eq(0).text();
    var default_selected_value = $(".change_price").eq(0).val();
    console.log(default_selected_value);

    if (default_selected_value != undefined) {
    var str = first_selected_value.toString();
   str = str.trim();
   str = str.replace('_', ' ').trim();

    //console.log(products_options[str][0]);

    for (i = 0; i < products_options[str].length; i++) {
        if (products_options[str][i]['name'] == default_selected_value) {
        		console.log(products_options[str][i]['products_options'][0]['value']);
        		start_price_default +=  products_options[str][i]['products_options'][0]['value'];
        		<?php 	if ($discount == false): ?>
        				$(".product_price .translate_price").text(start_price_default);
        				start_price = start_price_default;
        		<?php 	endif; ?>
        }
    }
}

   setTimeout(function() {
if (currency == 2) {
         	start_price = start_price * global_curs;
         }
         if (currency == 3) {
          start_price = start_price * global_curs_dollar;
          }

          if (currency == 1) {
          start_price = start_price * 1;
          }
   },1000);


     
    var count_id_bascket = 1;

	var total_options = new Map();
	var total_options_name = new Map();
	var array_options_name = new Map();



 $(".review_product").submit(function() {
       event.preventDefault(); 
        
       var element = $(this);
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');

       console.log($(this).serialize());
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'rewiev', 'action' => 'insert-comment', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
             $("#added_after_rewiev").modal({
              show: true
            }); 
             $(".clear_input").val("");
             $(".clear_input").text("");
             console.log(data);

             if (data.status == false) {
             	$(".rewiew_message").html("<p class='rewiew_message_alert btn-danger'><strong>Увага</strong> "+data.message+"</p>");
             }
             if (data.status == true) {
             	$(".rewiew_message").html("<p class='rewiew_message_good btn-success'><strong>Увага</strong> "+data.message+"</p>");
             }
        }
     });
     });
$(".change_price").change(function() {
   var index = $(this).parent().parent().find('.product_paramth_title').text();
   var str = index.toString();
   str = str.trim();
   str = str.replace('_', ' ').trim();
    
    //console.log(str);
  //  console.log(products_options);
   // console.log(str);
    //console.log(Object.keys(products_options));

    for (i = 0; i < products_options.length; i++) {
        products_options[i] = products_options[i].replace(/ +/g, '_').trim();
       // console.log(products_options[i]);
    }

   // console.log(products_options);
    
    console.log('size');
    console.log(products_options[str]);
    console.log('size');
    console.log(products_options[str].length);

    for (i = 0; i < products_options[str].length; i++) {
    	// console.log(products_options[str][i]['name']);
    	if (products_options[str][i]['name'] == $(this).val()) {
         // console.log(products_options[str][i]['products_options'][0]['value']);
    	}
    } 
    change_price();
});

function change_price() {
	 total_options = [];
	 array_options_name = [];
	 total_options_name = [];

	var new_price = 0;
	 $(".change_price").each(function() {
	 	  var index = $(this).parent().parent().find('.product_paramth_title').text();
   var str = index.toString();
   str = str.trim();
   str = str.replace('_', ' ').trim();

    for (i = 0; i < products_options[str].length; i++) {
    	if (products_options[str][i]['name'] == $(this).val()) {
         array_options_name.push(str);
         var key = products_options[str][i]['name'].toString();
         if ( products_options[str][i]['products_options'][0]['value']) {
         	total_options_name.push(products_options[str][i]['name'].toString());
          total_options.push(products_options[str][i]['products_options'][0]['value']);
         }

         console.log(products_options[str][i]);
         if (currency == 2) {
         	new_price = new_price + ( products_options[str][i]['products_options'][0]['value'] * global_curs);
         }
         if (currency == 3) {
          new_price = new_price + ( products_options[str][i]['products_options'][0]['value'] * global_curs_dollar);
          }

          if (currency == 1) {
          new_price = new_price + ( products_options[str][i]['products_options'][0]['value'] * 1);
          }

    	}
    }
	 });

	 console.log(total_options_name);
	 console.log(total_options);
     
     console.log(start_price);
	 new_price = new_price;
	 console.log(new_price);
	 $(".translate_price").text(Math.round(new_price));
}

$(".product_shop_counter_right").click(function() {
   count_id_bascket++;
   $(".product_shop_counter_center").text(count_id_bascket);
});

$(".product_shop_counter_left").click(function() {
   count_id_bascket--;
   if (count_id_bascket <=1) {
   	count_id_bascket = 1;
   }
   $(".product_shop_counter_center").text(count_id_bascket);
});


	$('.product_gallery').not('.slick-initialized').slick({
  infinite: true,
  slidesToShow: 2,
  slidesToScroll: 2
});  



$(".slider_arrow_left").click(function() {
 $(this).parent().parent().parent().find('.slick-prev.slick-arrow').trigger('click');
});

$(".slider_arrow_right").click(function() {
 $(this).parent().parent().parent().find('.slick-next.slick-arrow').trigger('click');
});

$(document).ready(function() {
  
  $(".product_shop_buy").click(function() {
  	console.log(total_options);
  	console.log(array_options_name);

    $.ajax({
        url: '<?= $this->Url->build(['controller' => 'carts', 'action' => 'add', '_full' => true]) ?>',
        method: 'POST',
  		data: { "product_id": id_product, "total_options":total_options, "array_options_name":array_options_name, "total_options_name":total_options_name, "count_id_bascket":count_id_bascket  },
  		success: function(data){ 
    		  setTimeout(function() {
    		$("#basket").modal({
        			show: true
            }); 
           }, 50);
        }
  	});

  });

});
});


	var $star_rating = $('.products_tabs_item_form_stars .fa');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();

$(document).ready(function() {
 
});


$(document).ready(function() {
    $(".quick_buy_form_submit").submit(function() {
       event.preventDefault(); 
       $('.auth_loader').css("display","inline-block");
       $(".quick_submit").css("display","none");
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'quick-orders', 'action' => 'quick-order', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
          $(".message_submit_quick_order").html("");
          console.log()

          if (data.status == "true")
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
           }

           
        }
     });
    }); 
});


$(document).ready(function() {

 $('.gallery_item').magnificPopup({
  type: 'image',
  gallery:{
    enabled:true
  }
});

});
	<?php echo $this->Html->scriptEnd(); ?>
</script>