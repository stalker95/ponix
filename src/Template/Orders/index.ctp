<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<div class="breadcrums">
	<div class="breadcrums_list">
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  '/']) ?>">Головна</a>
			<span> / </span>
      <a href="<?= $this->Url->build(['controller' => 'orders','action'    =>  'index']) ?>">Оформлення замовлення</a>
			
			
		</div>
	</div>
</div>
<div class="white_container container">
	<div class="orders_container">
    <form  class="insert_orders" method="POST">
  <div class="row">
  	<div class="col-md-7">
  <div class="orders">
  	<div class="order_item">
  		<div class="order_item_top">
  			<div class="order_item_top_number">
  				<p>1</p>
  			</div>
  			<div class="order_item_top_title">
  				<p>Контактні данні</p>
  			</div>
        <div class="order_item_top_change_data">
          <p>Змінити</p>
        </div>
  		</div>
  		<div class="order_item_bottom">
        <?php if (empty($_user)): ?>
  			<div class="order_item_bottom_tabs">
  				<div class="order_item_bottom_tabs_item order_item_bottom_tabs_item_active">
  					<p>Новий покупець</p>
  				</div>
  				<div class="order_item_bottom_tabs_item">
  					<p>Постійний клієнт</p>
  				</div>
  			</div>
      <?php   endif; ?>
  			<div class="order_item_bottom_container">
  				<div class="order_item_bottom_item" style="display: block;">
  					<form  class="new_customer_register">
  						<div class="new_customer_register_item">
  							<div class="new_customer_register_item_title">
  								<label for="name">Ім'я та прізвище</label>
  							</div>
  							<div class="new_customer_register_item_input ">
  								<input type="text" class="user_name" name="user_name" value="<?php if (!empty($_user)) { echo $_user->firstname; } ?>">
  								<div class="message_display"></div>
  							</div>
  						</div>
  						<div class="new_customer_register_item">
  							<div class="new_customer_register_item_title" >
  								<label for="name">Місто</label>
  							</div>
  							<div class="new_customer_register_item_input">
  								<input type="text" class="user_city" name="user_city" value="<?php if (!empty($_user)) { echo $_user->adress_city; } ?>">
  								<div class="message_display"></div>
  							</div>
  						</div>
  						<div class="new_customer_register_item">
  							<div class="new_customer_register_item_title">
  								<label for="user_mobile">Мобільний телефон</label>
  							</div>
  							<div class="new_customer_register_item_input">
  								<input type="text" name="user_mobile" class="user_mobile" value="<?php if (!empty($_user)) { echo $_user->phone; } ?>">
  								<div class="message_display"></div>
  							</div>
  						</div>
  						<div class="new_customer_register_item">
  							<div class="new_customer_register_item_title">
  								<label for="user_email">Електронна пошта</label>
  							</div>
  							<div class="new_customer_register_item_input">
  								<input type="email" class="user_email" name="user_email" value="<?php if (!empty($_user)) { echo $_user->mail; } ?>">
  								<div class="message_display"></div>
  							</div>
  						</div>
               <div class="message_invalid_email" style="display: none;">
                    <div class="message_invalid_email_left">
                      <img src="<?= $this->Url->build('/img/attention.svg', ['fullBase' => true]) ?>" alt="">
                    </div>
                    <div class="message_invalid_email_right">
                      <p>Покуцець з такою ел. поштою вже зареєстрований. Увійдіть з паролем і ми збережемо це замовлення у вашому особистому кабінеті. </p>
                    </div>
                  </div>
  					</form>
  					<button class="order_item_next" type="button">Далі</button>
  				</div>
          <div class="order_item_bottom_item">
             <form  class="new_customer_login">
              <div class="new_customer_register_item">
                <div class="new_customer_register_item_title">
                  <label for="user_email">Електронна пошта</label>
                </div>
                <div class="new_customer_register_item_input">
                  <input type="email" class="user_email" name="email">
                  <div class="message_display"></div>
                </div>
              </div>

               <div class="new_customer_register_item">
                <div class="new_customer_register_item_title">
                  <label for="user_email">Пароль</label>
                </div>
                <div class="new_customer_register_item_input">
                  <input type="password" class="user_password" name="password">
                  <div class="message_display"></div>
                </div>
              </div>

           
            <button type="submit" class="order_item_next"> 
                      <svg class="loader_svg" version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="35px" height="23px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;margin: auto;" xml:space="preserve">
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
                    <span class="hide_submit">Увійти</span>
                </button>
                <div class="message_invalid_email" style="display: none;">
                    <div class="message_invalid_email_left">
                      <img src="<?= $this->Url->build('/img/attention.svg', ['fullBase' => true]) ?>" alt="">
                    </div>
                    <div class="message_invalid_email_right">
                      <p>Не правильний логін або пароль. Спробуйте ще раз. </p>
                    </div>
                  </div>
                <output class="display_message_register"></output>
                 </form>
          </div>
  			</div>
  		</div>
  	</div>
    <div class="order_item">
            <div class="order_item_top">
        <div class="order_item_top_number">
          <p>2</p>
        </div>
        <div class="order_item_top_title">
          <p>Виберіть спросіб доставки та оплати</p>
        </div>
      </div>
      <div class="order_item_bottom" style="display: none;">
        <div class="order_item_bottom_container order_item_bottom_container_bascket">
          <div class="order_item_bottom_container_item">

          <?php $total = 0; ?>
          <?php   if (isset($_SESSION['cart']) AND count($_SESSION['cart']) > 0 ): ?>
          <?php foreach ($_SESSION['cart'] as $key => $value): ?>
            <div class="orders_products">
              <div class="orders_products_image">
                <img src="<?= $this->Url->build('products/'.$value['product']['image'], ['fullBase' => true]) ?>" alt="">
              </div>
              <div class="orders_products_title">
                <p><?= $value['product']['title']; ?></p>
              </div>
              <div class="orders_products_count">
                <?= $value['count']; ?> шт.
              </div>
              <div class="orders_products_price">
                <span class="translate_price" data-currency="<?=$value['product']['currency_id'] ?>"><?= ($value['count'] * $value['one_price']) + array_sum($value['array_option_value']);  ?></span> грн
              </div>
            </div>
         <?php  endforeach; ?>
       <?php  endif; ?>
           

          </div>

          <div class="orders_delivery">
            <div class="orders_delivery_top">
              <div class="orders_delivery_top_left">
                <p>Доставка у <span class="city_selected"></span>Львів </p>
              </div>
              <div class="orders_delivery_top_right">
                <div class="order_item_top_change_data">
                  <p>Змінити</p>
                </div>
              </div>
            </div>
            <div class="orders_delivery_bottom">
              <div class="orders_delivery_container">
                <label class="orders_delivery_item">Самовивіз
                  <input type="radio" checked="checked" name="type_delivery" class="type_delivery" value="1">
                  <span class="checkmark"></span>
                </label>

                <label class="orders_delivery_item">Нова пошта
                  <input type="radio" name="type_delivery" class="type_delivery" value="2">
                  <span class="checkmark"></span>
                </label>
                <input type="text" name="adress_delivery_new" class="adress_delivery" placeholder="Вкажіть реквізити доставки" value="<?php if (!empty($_user)) { echo $_user->new_post_city." ".$_user->new_post_delivery; } ?>">
                <p class="message_display"></p>

                <label class="orders_delivery_item">МістЕкспес
                  <input type="radio" name="type_delivery" class="type_delivery" value="3">
                  <span class="checkmark"></span>
                </label>
                <input type="text" name="adress_delivery_mist" class="adress_delivery" placeholder="Вкажіть реквізити доставки">
                <p class="message_display"></p>

                <label class="orders_delivery_item">Інтайм
                  <input type="radio" name="type_delivery" class="type_delivery" value="4">
                  <span class="checkmark"></span>
                </label>
                <input type="text" name="adress_delivery_in" class="adress_delivery" placeholder="Вкажіть реквізити доставки">
                <p class="message_display"></p>

                 <label class="orders_delivery_item">Делівері
                  <input type="radio" name="type_delivery" class="type_delivery" value="5">
                  <span class="checkmark"></span>
                </label>
                <input type="text" name="adress_delivery_del" class="adress_delivery" placeholder="Вкажіть реквізити доставки">
                <p class="message_display"></p>

              </div>
            </div>
          </div>

          <div class="orders_delivery">
            <div class="orders_delivery_top">
              <div class="orders_delivery_top_left">
                <p>Виберіть спосіб оплати</p>
              </div>
              
            </div>
            <div class="orders_delivery_bottom">
              <div class="orders_delivery_container">
                <label class="orders_delivery_item">Готівкою
                  <input type="radio" checked="checked" name="type_radio" value="1" class="type_payment">
                  <span class="checkmark"></span>
                </label>

                 <label class="orders_delivery_item">Visa або MasterCard
                  <input type="radio" name="type_radio" value="2" class="type_payment">
                  <span class="checkmark"></span>
                </label>

                 <!--<label class="orders_delivery_item">LiqPay
                  <input type="radio" name="type_radio" value="3" class="type_payment">
                  <span class="checkmark"></span>
                </label> -->

                 <label class="orders_delivery_item">Наложений платіж
                  <input type="radio" name="type_radio" value="4" class="type_payment">
                  <span class="checkmark"></span>
                </label>

                <label class="orders_delivery_item">Безготівковий рахунок
                  <input type="radio" name="type_radio" value="5" class="type_payment">
                  <span class="checkmark"></span>
                </label>

              </div>
            </div>
          </div>
          <div class="orders_delivery orders_delivery_user">
            <div class="orders_delivery_top">
              <div class="orders_delivery_top_left">
                <p>Хто отримувач</p>
              </div>
              
            </div>

            <div class="orders_delivery_bottom">
              <div class="orders_delivery_container">

                <label class="orders_delivery_item">Я
                  <input type="radio" class="type_user_delivery"  name="type_user_delivery" value="1">
                  <span class="checkmark"></span>
                </label>

                <label class="orders_delivery_item">Інша особа
                  <input type="radio" class="type_user_delivery"   name="type_user_delivery" value="2">
                  <span class="checkmark"></span>
                </label>

                            <div  class="new_delivery_user">
              <div class="new_customer_register_item">
                <div class="new_customer_register_item_title">
                  <label for="name">Телефон отримувача</label>
                </div>
                <div class="new_customer_register_item_input ">
                  <input type="text" class="user_delivery_phone user_delivery_item" name="user_delivery_phone">
                  <div class="message_display"></div>
                </div>
              </div>
              <div class="new_customer_register_item">
                <div class="new_customer_register_item_title">
                  <label for="name">Прізвище отримувача</label>
                </div>
                <div class="new_customer_register_item_input">
                  <input type="text" class="user_delivery_surname user_delivery_item" name="user_delivery_surname">
                  <div class="message_display"></div>
                </div>
              </div>
              <div class="new_customer_register_item">
                <div class="new_customer_register_item_title">
                  <label for="user_mobile">Ім'я отримувача</label>
                </div>
                <div class="new_customer_register_item_input">
                  <input type="text" name="user_delivery_name" class="user_delivery_name user_delivery_item">
                  <div class="message_display"></div>
                </div>
              </div>
              <div class="new_customer_register_item">
                <div class="new_customer_register_item_title">
                  <label for="user_email">По батькові отримувача</label>
                </div>
                <div class="new_customer_register_item_input">
                  <input type="email" class="user_delivery_second user_delivery_item" name="user_delivery_second">
                  <div class="message_display"></div>
                </div>
              </div>
               
            </div>

              </div>
            </div>
            <div class="message_user_display">
              <p class="message_display"></p>
            </div>
          </div>


        </div>
    </div>
  </div>  
  	</div>
  </div>
  	<div class="col-md-5">
  		<div class="orders_bascket">
        <div class="orders_bascket_first" >
          
       
  			<div class="orders_bascket_title">
  				<p>Ваша корзина</p>
  			</div>
  			<div class="orders_bascket_container">
          <?php $total = 0; ?>
          <?php   if (isset($_SESSION['cart']) AND count($_SESSION['cart']) > 0 ): ?>
          <?php foreach ($_SESSION['cart'] as $key => $value): ?>
  				<div class="orders_bascket_item">
  					<div class="orders_bascket_item_left">
  						<img src="<?= $this->Url->build('/products/'.$value['product']['image'], ['fullBase' => true]) ?>" alt="">
  					</div>
  					<div class="orders_bascket_item_right">
  						<p class="orders_bascket_item_title"><?= $value['product']['title'] ?></p>
              <?php foreach ($value['array_options_name'] as $keys => $item): ?>
                <?= $item ?> <?= $value['array_option_item'][$keys] ?>
              <?php endforeach; ?>
  						<div class="orders_bascket_item_right_bottom">
  							<div class="orders_bascket_item_right_count">
  								<p><?= $value['count'] ?> шт</p>
  							</div>
  							<div class="orders_bascket_item_right_count_price">
  								<p><span class="translate_price total_basket_submit" data-currency="<?= $value['product']['currency_id'] ?>" ><?=  ($value['count'] * $value['one_price']) + (array_sum($value['array_option_value']) * $value['count']); ?></span> грн</p>
  							</div>
  						</div>
  					</div>
  				</div>
        <?php   endforeach; ?>
        <?php  endif; ?>
  			</div>

  			<div class="orders_bascket_total">
  				<div class="orders_bascket_total_description">
  					<p>Разом</p>
  					<p><strong class="total_of_bascket_submit"></strong> грн</p>
  				</div>
  			</div>
         </div>
         <div class="orders_bascket_second">
           <p class="orders_bascket_second_title">
            <strong>Ваше замовлення</strong>
           </p>
           <div class="orders_bascket_second_container">
             <div class="orders_bascket_second_item">
               <div class="orders_bascket_second_item_left">
                 <p><span class="counts_of_bascket"><?php if (isset($_SESSION['cart'])){ echo array_sum(array_column($_SESSION['cart'], 'count')); }?></span> товарів на суму </p>
               </div>
               <div class="orders_bascket_second_item_righr">
                 <p><span class="total_of_bascket_submit"></span> грн</p>
               </div>
             </div>
             <div class="orders_bascket_second_item">
                <div class="orders_bascket_second_item_left">
                 <p>Вартість доставки</p>
               </div>
               <div class="orders_bascket_second_item_righr">
                 <p><span class="selected_delivery">Безкоштовно</span></p>
               </div>
             </div>
           </div>
            <div class="orders_bascket_second_total">
               <div class="orders_bascket_second_total_left">
                 <p><strong>До сплати</strong></p>
               </div>
             </div>
             <div class="confirm_bascket">
              <?php if (isset($_SESSION['cart']) AND !empty($_SESSION['cart'])) : ?>
               <button class="button_confirm_bascket disabled" type="button">
                 Замовлення підтверджую
               </button>
             <?php endif; ?>
             </div>
         </div>
  			<div class="orders_bascket_submit">
  				<button data-toggle="modal" data-target="#basket">Редагувати замовлення</button>
  			</div>
  		</div>
  	</div>	
  </div>
</form>
</div>
</div>

<div class="modal fade" id="display_privat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content ">
     <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-content quick_buy_modal">
      <div class="modal-body quick_buy_form added_to_cart_modal">
       <!-- <h5>Ваше замовлення прийнято</h5>
        <div class="added_to_cart">
          <button class="btn btn-primary " data-dismiss="modal" aria-label="Close">OK</button>
        </div>-->
        <div id="liqpay_checkout"></div> 
      </div>
    </div>
</div>
  </div>
</div>
<script>
 
</script>






  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>

var logget_user = 0 ;
var logger_user_before = <?php if (isset($_user)) { echo "1"; } else {echo "0";}  ?>;
 $('.new_customer_login').submit(function() {
       event.preventDefault(); 

       var element = $(this);
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'orders', 'action' => 'auth-ajax', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                   $(element).parent().find('.hide_submit').css("display",'block');
       $(element).parent().find(".loader_svg").css('display','none');
        if (data.status == false ) {
            $(element).parent().find('.message_invalid_email').css('display', 'flex');
          }
         if (data.status == true) {
          $(element).parent().find('.message_invalid_email').css('display', 'none');

          logget_user = 1;
          
          if (data.user.phone != "" && data.user.city != "" ) {
           $(".order_item_top_title p").text(data.user.firstname+' '+data.user.phone);
           $(".order_item_bottom").eq(0).slideUp('fast');
           $(".order_item_bottom").eq(1).slideDown('fast');
           $(".order_item:nth-child(2)").css('display', 'block');
           $(".order_item").eq(0).find('.order_item_top_number').addClass('order_item_top_number_active');
           $(".order_item_bottom_tabs_item").removeClass('order_item_bottom_tabs_item_active');
           $(".order_item_bottom_tabs_item").eq(0).addClass('order_item_bottom_tabs_item_active');
           $(".order_item_top_change_data").css('display', 'block');
          } else {
            $(".user_name").val(data.user.firstname);
            $(".user_email").val(data.user.mail);
            $(".user_city").val(data.user.adress_city);
            $(".user_mobile").val(data.user.phone);
            $('.adress_delivery').eq(0).val(data.user.new_post_city+" "+data.user.new_post_delivery);
            $(".order_item_bottom_item").css('display', 'none');
            $('.order_item_bottom_item').eq(0).css('display', 'block');
            $(".order_item_bottom_tabs_item").removeClass('order_item_bottom_tabs_item_active');
            $(".order_item_bottom_tabs_item").eq(0).addClass('order_item_bottom_tabs_item_active');
          }
          
            if (data.user.phone == "") {
              $(".user_mobile").focus();
              $('.user_mobile').addClass('new_customer_register_item_input_not_valid');
              $('.user_mobile').next('.message_display').text("Введіть номер телефону");
            }

            if (data.user.adress_city == "") {
              $(".user_city").focus();
              $('.user_city').addClass('new_customer_register_item_input_not_valid');
              $('.user_city').next('.message_display').text("Введіть назву міста");
            }
          
         }
        }
     });
     });



    $('.order_item_bottom_tabs_item').click(function() {
       
       $(".order_item_bottom_tabs_item").removeClass('order_item_bottom_tabs_item_active');
       $(this).addClass('order_item_bottom_tabs_item_active');
       var index = $(this).index();
       
       $(".order_item_bottom_item").css('display', 'none');
       $(".order_item_bottom_item").eq(index).css('display', 'block');

    }); 


     function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

     var errors = 0;
     $(".order_item_next"). eq(0).click(function() {
        if ($(".user_name").val() == "") {
        	$(".user_name").focus();
        	$('.user_name').addClass('new_customer_register_item_input_not_valid');
        	$('.user_name').next('.message_display').text("Введіть своє ім'я а прізвище ");
        	errors++;
        } else {
          if ($(".user_name").val().length < 3) {
          $(".user_name").focus();
          $('.user_name').addClass('new_customer_register_item_input_not_valid');
          $('.user_name').next('.message_display').text("Мінімальна кількість символів 3 ");
          errors++;
        }
        }

        

        if ($(".user_city").val() == "") {
        	$(".user_city").focus();
        	$('.user_city').addClass('new_customer_register_item_input_not_valid');
        	$('.user_city').next('.message_display').text("Введіть своє місто");
        	errors++;
        } else {
          if ($(".user_city").val().length < 3) {
          $(".user_city").focus();
          $('.user_city').addClass('new_customer_register_item_input_not_valid');
          $('.user_city').next('.message_display').text("Мінімальна кількість символів 3 ");
          errors++;
        }
        }

        if ($(".user_mobile").val() == "") {
        	$(".user_mobile").focus();
        	$('.user_mobile').addClass('new_customer_register_item_input_not_valid');
        	$('.user_mobile').next('.message_display').text("Введіть номер телефону");
        	errors++;

        }
        else {
          if ($(".user_mobile").val().length < 3) {
          $(".user_mobile").focus();
          $('.user_mobile').addClass('new_customer_register_item_input_not_valid');
          $('.user_mobile').next('.message_display').text("Мінімальна кількість символів 6 ");
          errors++;
        }
        }

        if ($(".user_email").val() == "") {
        	$(".user_email").focus();
        	$('.user_email').addClass('new_customer_register_item_input_not_valid');
        	$('.user_email').next('.message_display').text('Введіть електронну пошту');
        	errors++;
        }
        if (!validateEmail($(".user_email").val())) {
        	$(".user_email").focus();
        	$('.user_email').addClass('new_customer_register_item_input_not_valid');
        	$('.user_email').next('.message_display').text('Пошта не валідна');
        	errors++;
        } else {

        }
                if (errors == 0) {
           $.ajax({
            url: '<?= $this->Url->build(['controller' => 'orders', 'action' => 'search', '_full' => true]) ?>',
            type: 'POST',
            data: {"email": $(".user_email").val()},
            success: function(data){ 
              if (data.status == 'true' && logget_user == 0 && logger_user_before != 1 ) {
                $(".message_invalid_email").css('display', 'flex');
                errors++;
              } else {
                $(".message_invalid_email").css('display', 'none');
                $(".order_item_top_title p").eq(0).text($('.user_name').val()+' '+$('.user_mobile').val());
           $(".order_item_bottom").eq(0).slideUp('fast');
           $(".order_item_bottom").eq(1).slideDown('fast');
           $(".order_item:nth-child(2)").css('display', 'block');
           $(".order_item").eq(0).find('.order_item_top_number').addClass('order_item_top_number_active');
           $(".order_item_top_change_data").css('display', 'block');
           $(".message_display").text('');
           $(".message_invalid_email").css('display', 'none');
           $(".orders_bascket_first").css('display', 'none');
           $('.orders_bascket_second').css('display', 'block');
              }
            }
     });
         } 

        
           errors = 0;
         });

    $(".user_name, .user_city, .user_mobile, .user_email").keyup(function() {
    	if ($(this).val() != "") {
    		$(this).removeClass('new_customer_register_item_input_not_valid');
    		$(this).next('.message_display').text();
    	}
    })
   

   function update_basckets() {
  setTimeout(function() {
  var total_basket_new = 0;

  $(".total_basket_submit").each(function() {
     total_basket_new = total_basket_new + parseInt($(this).text());
  });
  
  $(".total_of_bascket_submit").text(total_basket_new);
  console.log(total_basket_new);
  $(".total_of_bascket_submit").css('opacity', '1');
}, 1500);
}
update_basckets();


$(".order_item_top_change_data").click(function() {
  
  $(".order_item_top_title p").eq(0).text("Контактні данні");
  $(".order_item_bottom").eq(1).slideUp('fast');
  $(".order_item_bottom").eq(0).slideDown('fast');
  $(".order_item:nth-child(2)").css('display', 'none');
  $(".order_item").eq(0).find('.order_item_top_number').removeClass('order_item_top_number_active');
  $(".order_item_top_change_data").css('display', 'none');

});

$(".type_user_delivery").change(function() {
 
 var type_dostavku  = $('.type_delivery:checked').val();
 if ($(this).val() == 2) {
     $(".new_delivery_user").css('display', 'block');
 } else {

     $(".new_delivery_user").css('display', 'none');
       if ($('.type_delivery:checked').val() !=1 && $('.type_delivery:checked').parent().next(".adress_delivery").val() != "") {
     $(".button_confirm_bascket").removeClass('disabled');
     $(".button_confirm_bascket").addClass('not_disabled');
   }
   if ($(this).val() == 1 && $('.type_delivery:checked').val() == 1) {
    $(".button_confirm_bascket").removeClass('disabled');
     $(".button_confirm_bascket").addClass('not_disabled');
   }
 }
});

$(".type_delivery").change(function() {
  
  var type_user = $(".type_user_delivery:checked").val();

$(this).parent().parent().find('.adress_delivery').css('display', 'none').text('');
  $(".type_delivery").removeClass('new_customer_register_item_input_not_valid');
  if ($(this).val() != 1) {
    $(this).parent().next('.adress_delivery').css('display', 'block');
    $(".selected_delivery").text('Вартість доставки відповідно до тарифів перевізника');
  }

  if ($(this).val() == 1) {
    $(".selected_delivery").text('Безкоштовно');
  }
  
  if ($(this).val() == 1 && type_user != "undefined") {
     $(".button_confirm_bascket").removeClass('disabled');
     $(".button_confirm_bascket").addClass('not_disabled');
  } else {

          $(".button_confirm_bascket").removeClass('not_disabled');
     $(".button_confirm_bascket").addClass('disabled');
  }
});


$(".button_confirm_bascket.disabled").click(function() {
    

    if ($('.type_delivery:checked').val() != 1 && $('.type_delivery:checked').parent().next(".adress_delivery").val() == "") {
      $('.type_delivery:checked').parent().next(".adress_delivery").css('display','block');
       $('.type_delivery:checked').parent().next(".adress_delivery").addClass('new_customer_register_item_input_not_valid');
          $('.type_delivery:checked').parent().next('.adress_delivery').next('.message_display').text('Введіть адресу доставки');
    }

    if ($('.type_user_delivery:checked').val() == undefined) {
      $('.orders_delivery_user').find('.message_user_display').find('.message_display').css('display', 'block').text('Виберіть отримувача');
    }

    if ($('.type_user_delivery:checked').val() == 1) {
      $('.orders_delivery_user').find('.message_display').css('display', 'none').text('');
    }

    if ($('.type_user_delivery:checked').val() == 2) {
      if ($('.user_delivery_phone').val() == "") {
        $('.user_delivery_phone').next('.message_display').text('Введіть номер телефону отримувача')
        $('.user_delivery_phone').addClass('new_customer_register_item_input_not_valid');
      }

      if ($('.user_delivery_name').val() == "") {
        $('.user_delivery_name').next('.message_display').text("Введіть ім'я отримувача")
        $('.user_delivery_name').addClass('new_customer_register_item_input_not_valid');
      }

      if ($('.user_delivery_surname').val() == "") {
        $('.user_delivery_surname').next('.message_display').text('Введіть прізвище  отримувача')
        $('.user_delivery_surname').addClass('new_customer_register_item_input_not_valid');
      }

      if ($('.user_delivery_second').val() == "") {
        $('.user_delivery_second').next('.message_display').text('Введіть по батькові  отримувача')
        $('.user_delivery_second').addClass('new_customer_register_item_input_not_valid');
      }
    }

});

$(".adress_delivery").keyup(function() {
    var value = $(this).val();

    if (value.length > 5) {
      $(this).parent().find('.message_display').css('display', 'none').text('');
      $(this).removeClass('new_customer_register_item_input_not_valid');
      
      if ($('.type_user_delivery:checked').val() == 2) {

      if (   $('.user_delivery_surname').val() != "" 
            && $('.user_delivery_second').val() != "" 
            && $('.user_delivery_name').val() != ""
            && $('.user_delivery_phone').val() != "" )
      {
      $('.button_confirm_bascket').removeClass('disabled');
      $('.button_confirm_bascket').addClass('not_disabled');
    }
    }
     if ($('.type_user_delivery:checked').val() == 1) {
          $('.button_confirm_bascket').removeClass('disabled');
          $('.button_confirm_bascket').addClass('not_disabled');

     }
    }

});

$(".user_delivery_item").keyup(function() {
       var value = $(this).val();
       if ($(this).val() != "") {
        $(this).parent().find('.message_display').text('').css('display', 'none');
        $(this).removeClass('new_customer_register_item_input_not_valid');
       }

       var errors_inputs = 0 ;
       $(".user_delivery_item").each(function() {
         if ($(this).val() == "") {
          errors_inputs = errors_inputs + 1;
         }
       });

       if ($('.type_delivery:checked').val() != 1 && $('.type_delivery:checked').parent().next('.adress_delivery').val() == "") {
           $('.type_delivery:checked').find('.adress_delivery').addClass('new_customer_register_item_input_not_valid');
          $('.type_delivery:checked').parent().next('.adress_delivery').next('.message_display').text('Введіть адресу доставки');
       }

       if (!$(".user_delivery_item").hasClass('new_customer_register_item_input_not_valid') 
            && $('.type_delivery:checked').val() == 1
            && errors_inputs == 0
            ) {
        alert('s')
        $(".button_confirm_bascket").removeClass('disabled');
        $(".button_confirm_bascket").addClass('not_disabled');
       }

       if (!$(".user_delivery_item").hasClass('new_customer_register_item_input_not_valid') 
            && $('.type_delivery:checked').val() != 1
            && $('.type_delivery:checked').parent().next('.adress_delivery').val() != ""
            && errors_inputs == 0
            ) {
        $(".button_confirm_bascket").removeClass('disabled');
        $(".button_confirm_bascket").addClass('not_disabled');
       }
})


$(document).ready(function() {
  console.log('er');

 $("body").on("click", ".not_disabled", function() {
   $(".insert_orders").submit();   

});

  $(".insert_orders").submit(function(event) {
       event.preventDefault(); 
       $.ajax({
        url: currency_url+'orders/add',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
          $(".message_submit_quick_order").html("");
          
          
          if ($('.type_payment:checked').val() == 3 || $('.type_payment:checked').val() == 2 ) {

          liqpay_work(data);
        }

       if ($('.type_payment:checked').val() == 4 ) {
      //  buy_parst(data);
       }

          if ($('.type_payment:checked').val() == 1 || $('.type_payment:checked').val() == 4 && data.status == "true")
           {
             $(".order_item").eq(1).fadeOut('fast');
             $(".order_item_top_number").eq(0).removeClass('order_item_top_number_active');
             $(".order_item").eq(0).find('.order_item_bottom').fadeIn('fast');
             $(".order_item").eq(0).find('.order_item_top_change_data').css('display', 'none');
             $(".order_item_top_title p").eq(0).text("Контактні данні");
             $(".new_customer_register_item_input input").val("");
             $(".orders_bascket_second").css('display', 'none');
             $('.orders_bascket_first').css('display', 'block');
             $(".button_confirm_bascket").removeClass('not_disabled');
             $(".button_confirm_bascket").addClass('disabled');
             $(".orders_bascket_container").text('');
             $(".total_of_bascket_submit").text('0');

             $(".code_order").text("00"+data.order);

              $("#after_add_bascket").modal({
                  show: true
            }); 
           } 
        }
     });
    }); 

  function liqpay_work(data)
  {
    var json_string = data;

     $.ajax({
        url: currency_url+'orders/get-data',
        type: 'POST',
        data: {json_string: json_string},
        success: function(data){ 
          console.log(data);
           $("#display_privat").modal({
                  show: true
            }); 
            LiqPayCheckoutCallback = function() {
    LiqPayCheckout.init({
      data: data.data,
      signature: data.signature,
      embedTo: "#liqpay_checkout",
      mode: "embed" // embed || popup,
       }).on("liqpay.callback", function(data){
      console.log(data.status);

      if (data.status == 'wait_accept') {
         confirm_order('pay',data.order_id);
      }
      console.log(data);
      }).on("liqpay.ready", function(data){
        console.log('ready')
      }).on("liqpay.close", function(data){
        console.log('closed')
    });

  }; 
  LiqPayCheckoutCallback(); 
            
        }
    });

  }

  function buy_parst(data)
  {
    var signature = ''
    $.ajax({
        url: currency_url+'orders/get-data-parts',
        type: 'POST',
        data: {json_string: ''},
        success: function(data){ 
          buy_parts_send(data.signature);
        }
  });
    
  }

function buy_parts_send(signature)
{
    var url = 'https://payparts2.privatbank.ua/ipp/v2/payment/create';
    var json_string = '{'+
    '"storeId": "BDCF7CE5E48F497DB45A",'+
    '"orderId": "34234324",'+
    '"amount": 400.00,'+
    '"partsCount": 2,'+
    '"merchantType": "PP",'+
    '"scheme": 1111,'+
    '"products": ['+
        '{'+
            '"name": "Телевизор",'+
            '"count": 2,'+
            '"price": 100.00'+
        '},'+
        '{'+
            '"name": "Микроволновка",'+
            '"count": 1,'+
            '"price": 200.00'+
        '}'+
    '],'+
    '"recipientId":"qwerty1234",'+
    '"responseUrl": "https://payparts2.privatbank.ua/ipp/sandbox/test",'+
    '"redirectUrl": "https://payparts2.privatbank.ua/ipp/sandbox/test",'+
    '"signature": "+3p+X0FHuCuIHu5+94607DKUsec="'+
'}';
     $.ajax({
     url: url,
    type: "POST",
    beforeSend: function(jqXHR, settings) {
                   jqXHR.setRequestHeader("Content-Type", "application/json; charset=UTF-8;");
                   jqXHR.setRequestHeader("Accept", "application/json;");
                   jqXHR.setRequestHeader("Accept-Encoding", "UTF-8;");

  },
    data: JSON.stringify(JSON.parse(json_string)),
    headers: {
        'Accept':'application/json; charset=utf-8',
        'Accept-Encoding':'UTF-8;',
        'Content-Type':'application/json; charset=UTF-8;',
    },
    processData: false,
    success: function(data){ 
    }
  }); 

}

  function confirm_order(action, data_id) {
         $.ajax({
        url: currency_url+'orders/updateOrder',
        type: 'POST',
        data: {data_id: data_id, action: action},
        success: function(data){ 
          console.log(data);
        }
  

});
       }

    });

	<?php echo $this->Html->scriptEnd(); ?>
</script>
