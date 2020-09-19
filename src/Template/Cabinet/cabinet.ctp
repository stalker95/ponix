<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
<div class="breadcrums">
	<div class="breadcrums_list">
		<div class="breadcrums_list_item">
			<a href="<?= $this->Url->build(['controller' => 'main','action'    =>  'index']) ?>">Головна</a>
			<span> / </span>
			<a href="<?= $this->Url->build(['controller' => 'cabinet','action'    =>  'cabinet']) ?>">Особистий кабінет</a>
			
			
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
				 <?= $this->element('cabinet_user', array('item' => 'main')); ?>
				
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="cabinet_title">Особисті данні</div>
		<div class="cabinet_data">

		<div class="cabinet_data_first">
			



			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Ім'я</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->firstname ?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Прізвище</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->lastname ?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Електронна пошта</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->mail ?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Телефони</p>
				</div>
				<div class="cabinet_data_item_description">
					<p class="user_phone_item"><?= $_user->phone ?></p>
					
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Адреса доставки</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->adress ?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Нова пошта</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->new_post_city." ".$_user->new_post_delivery ?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Дата народження</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->date_of_birth ?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Стать</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?php  if ($_user->male == 1){ 
                       echo "Чоловіча";
					 }
					 if ($_user->male == 2){ 
                       echo "Жіноча ";
					 }
					 if ($_user->male == 0){ 
                       echo "Не вибрано";
					 } ?></p>
				</div>
			</div>
            <p class="cabinet_data_title">Інформація для юридичних осіб. </p>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Повна назва юридичної особи </p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->full_name ?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Код ЄДПРО</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?= $_user->code ?></p>
				</div>
			</div>
			<div class="cabinet_data_bottom">
				<input type="button" value="Редагувати профіль" class="cabinet_data_bottom_submit change_form">
				<button type="button" class="cabinet_data_bottom_button"  data-toggle="modal" data-target="#exampleModal">Змінити пароль</button>
			</div>
		</div>

		<div class="cabinet_data_second">
    <?= $this->Form->create($_user, ['type' => 'file','action' => 'change-data']); ?>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Ім'я</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?=  $this->Form->control('firstname',array('label' => false,'required'=>'required','type'=>'text'));?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Прізвище</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?=  $this->Form->control('lastname',array('label' => false,'required'=>'required','type'=>'text'));?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Електронна пошта</p>
				</div>
				<div class="cabinet_data_item_description">
					<p><?=  $this->Form->control('mail',array('label' => false,'required'=>'required','type'=>'email'));?></p>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Телефони</p>
				</div>
				<div class="cabinet_data_item_description">
					<p class="user_phone_item"><?=  $this->Form->control('phone',array('label' => false,'required'=>'required','type'=>'text'));?></p>
					
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Адреса доставки</p>
				</div>
				<div class="cabinet_data_item_description cabinet_data_item_description_new_post">
					<?=  $this->Form->control('adress_city',array('label' => false,'style' => 'margin-right:20px; display: inline-block;','type'=>'text'));?>
					<?=  $this->Form->control('adress',array('label' => false,'type'=>'text','style' => 'display: inline-block;',));?>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Нова пошта</p>
				</div>
				<div class="cabinet_data_item_description cabinet_data_item_description_new_post">
					<?=  $this->Form->control('new_post_city',array('label' => false,'style' => 'margin-right:20px; display: inline-block;','type'=>'text'));?>
					<?=  $this->Form->control('new_post_delivery',array('label' => false,'style' => 'display: inline-block;','type'=>'text'));?>
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Дата народження</p>
				</div>
				<div class="cabinet_data_item_description cabinet_data_item_birth_day">
					<input type="text" name="date_of_birth[day]" min="1" max="31" value="<?= date("d", strtotime($_user->created)) ?>">
					<select name="date_of_birth[month]" id="">
						<option value=""><?= $_user->month_begin ?></option>
						<?php foreach ($_monthsList as $key => $value): ?>
							<option value="<?= $key ?>"  <?php 	if ($value == $_user->month_begin) { echo 'selected'; } ?>><?= $value ?></option>
						<?php endforeach ?>
					</select>
					<select name="date_of_birth[year]" id="">
						<?php if (isset($_user->date_of_birth->year)){ ?>
						<?php for ($i= 1980; $i	< date('Y') + 1; $i++): ?>
							<option value="<?= $i ?>" <?php 	if ($i == $_user->date_of_birth->year) { echo 'selected'; } ?>><?= $i ?></option>
						<?php 	endfor; ?>
					<?php } else {?>
						<?php for ($i= 1980; $i	< date('Y') + 1; $i++): ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php 	endfor; ?>
					<?php } ?>
					</select>
					
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Стать</p>
				</div>
				<div class="cabinet_data_item_description">
					<div>
					<select name="male"  >
						<option value="0">Виберіть стать</option>
						<option value="1">Чоловіча</option>
						<option value="2">Жіноча</option>
					</select>
					</div>
				</div>
			</div>
            <p class="cabinet_data_title filter_elements_items">
            	<input id="information" name="info" type="checkbox" <?php if ($_user->info): ?> checked <?php endif; ?>>
            	<label for="information">Інформація для юридичних осіб.</label> </p>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Повна назва юридичної особи </p>
				</div>
				<div class="cabinet_data_item_description">

					<?php if ($_user->info) { ?>
						

					<p><?=  $this->Form->control('full_name',array('label' => false,'id'=>'full_name','type'=>'text','disabled' => 'false'));?></p>

					<?php } else {  ?>
						<p><?=  $this->Form->control('full_name',array('label' => false,'id'=>'full_name','disabled' => 'disabled','type'=>'text'));?></p>
					<?php } ?>

					
				</div>
			</div>

			<div class="cabinet_data_item">
				<div class="cabinet_data_item_title">
					<p>Код ЄДПРО</p>
				</div>
				<div class="cabinet_data_item_description">
					<?php if ($_user->info) { ?>
						

					<p><?=  $this->Form->control('code',array('label' => false,'id'=>'code','type'=>'text','disabled' => 'false'));?></p>

					<?php } else {  ?>
						<p><?=  $this->Form->control('code',array('label' => false,'id'=>'code','disabled' => 'disabled','type'=>'text'));?></p>
					<?php } ?>
				</div>
			</div>
			<div class="cabinet_data_bottom">
				<input type="submit" value="Зберегти" class="cabinet_data_bottom_submit save_cabinet_data">
				<button type="button" class="cabinet_data_bottom_button close_second_form" >Скасувати</button>
			</div>
			     <?=   $this->Form->end() ?>

		</div>




		</div>
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
        	<p class="quick_buy_form_title">Для зміни паролю введіть старий пароль та двічі новий</p>
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
<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>
    
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
                '<strong>Увага!</strong> Ваш пароль змінено'+
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