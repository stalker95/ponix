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
        <div class="user_authorization">
            <p class="user_form_title">Авторизаці</p>
            <form action="" class="user_register">
                <label for="login">Логін або Email</label>
                <input type="email" name="email" class="login_input" required="required">

                <label for="password"></label>
                <input type="password" name="password" class="login_input"  required="required">
                
                <div class="user_form_checkbox">
                    <input type="checkbox"> Запамятати мене
                </div>
                <div class="user_form_checkbox">
                  <a href="<?= $this->Url->build(['controller' => 'users','action'    =>  'remember']) ?>">Забули пароль?</a>
                </div>


 <button class="login_submit">
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
                                <output class="display_message_register"></output>
                  
            </form>
        </div>
        <div class="user_registration">
            <p class="user_form_title">Новий користувач</p>
            <form class="register_new_user">
                <label for="email">Email</label>
                <input type="text" name="email" class="login_input" required="true" type="email">

                <div class="user_form_description">
                    <p>Створення облікового запису допоможе робити наступні придбання швидше (не треба буде знову вводити адресу та контактну інформацію), бачити стан замовлення, а також бачити замовлення, зроблені раніше.</p>
                </div>
                <button class="login_submit">
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
                    <span class="hide_submit">Рестрація</span>
                </button>    
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

       $('.user_register').submit(function() {
       event.preventDefault(); 

       var element = $(this);
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');
       $.ajax({
        url: '<?= $this->Url->build(['controller' => 'users', 'action' => 'auth-ajax', '_full' => true]) ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                   $(element).parent().find('.hide_submit').css("display",'block');
       $(element).parent().find(".loader_svg").css('display','none');
        if (data.status == false ) {
            $(element).parent().find('.display_message_register').html('<p class="display_message_register_alert btn-danger"><strong>Увага</strong> '+data.message+'</p>');
          }
         if (data.status == true) {
           window.location.href = '<?= $baseUrl ?>'+'/cabinet/cabinet';
         }
        }
     });
     });
    <?php echo $this->Html->scriptEnd(); ?>
</script>