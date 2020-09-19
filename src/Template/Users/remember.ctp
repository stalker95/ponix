<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<div class="breadcrums">
    <div class="breadcrums_list">
       <p class="breadcrums_title">Особистий кабінет</p>
        <div class="breadcrums_list_item">
            <a href="">Головна</a>
            <span> / </span>
            <a href="">Мій аккаунт</a>
            
        </div>
    </div>
</div>

<div class="white_container container ">
    <div class="user_form">
        <div class="user_authorization" style="flex-basis: 100%;">
            <p class="user_form_title">Якщо ви забули пароль введіть свою електронну пошту. </p>
            <form action="" class="user_register_new_user">
                <label for="login">Логін або Email</label>
                <input type="email" name="email" class="login_input" required="required">

 <button class="login_submit remember_pass">
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
                    <span class="hide_submit">Скинути пароль</span>
                </button><br>
                                <output class="display_message_register"></output>
                  
            </form>
        </div>

    </div>
</div>


<script>
    <?php echo $this->Html->scriptStart(['block' => true]); ?>
     
    $(".register_new_user").submit(function() {
       event.preventDefault(); 
       
       var element = $(this);
        $(element).parent().parent().find('.display_message_register').html();
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'users', 'action' => 'register-ajax', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
          $(element).parent().find('.hide_submit').css("display",'block');
          $(element).parent().find(".loader_svg").css('display','none');

          if (data.status == "false" ) {
            $(element).parent().find('.display_message_register').html('<p class="display_message_register_alert btn-danger"><strong>Увага</strong> '+data.message+'</p>');
          }
           if (data.status == "true" ) {
            $(element).parent().find('.display_message_register').html('<p class="display_message_register_alert btn-success"><strong>Увага</strong> '+data.message+'</p>');
          }

        }
      });
     });

       $('.user_register_new_user').submit(function() {
       event.preventDefault(); 

       var element = $(this);
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'users', 'action' => 'remember-password', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                   $(element).parent().find('.hide_submit').css("display",'block');
       $(element).parent().find(".loader_svg").css('display','none');
        if (data.status == false ) {
            $(element).parent().find('.display_message_register').html('<p class="display_message_register_alert btn-danger"><strong>Увага</strong> '+data.message+'</p>');
          }
         if (data.status == true) {
             $(element).parent().find('.display_message_register').html('<p class="display_message_register_alert btn-success"><strong>Увага</strong> '+data.message+'</p>');
         }
        }
     });
     });
    <?php echo $this->Html->scriptEnd(); ?>
</script>