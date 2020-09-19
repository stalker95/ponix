<div class="modal  fade" id="basket" tabindex="-1" role="dialog" aria-labelledby="basketlabel" aria-hidden="true">
    <?php if (!isset($_SESSION['cart']) OR isset($_SESSION['cart']) AND empty($_SESSION['cart']) ) { ?>
  <div class="modal-dialog  modal-dialog-centered" role="document">

      <div class="modal-content ">
              <div class="modal-body  quick_buy_form ">
                  <div class="empty_basckets">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="empty_basckets empty_bascket_container">
                        <img src="<?= $this->Url->build('/img/empty_bucket.svg', ['fullBase' => true]) ?>" alt="">
                        <p><strong>Кошик порожній (</strong></p>
                    </div>
                  </div>
              </div>
        </div>

<?php   } else { ?>
 <div class="modal-dialog basket_modal modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="basketlabel">Корзина</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body quick_buy_form baskets_items">
            <div class="bascket_container"> 
            <?php //debug($_SESSION['cart']); ?>
            <?php   foreach ($_SESSION['cart'] as $key => $value): ?>
          
           <div class="bascket_item">
            <button class="bascket_delete">
              <i class="fa fa-trash display_bascket_popup"></i>
              <div class="popup_bascket_item">
                <div class="popup_bascket_item_top">
                  <div class="popup_bascket_item_wishlist add_product_to_wishlist" data-product="<?= $value['product']['id'] ?>">
                    <div class="popup_bascket_item_icon">
                      <i class="fa fa-heart"></i>
                    </div>
                    <div class="popup_bascket_item_description">
                      <p>Перемістити до списку бажань </p>
                    </div>
                  </div>
                  <div class="popup_bascket_item_delete" data-product="<?= $key ?>">
                    <div class="popup_bascket_item_icon">
                      <i class="fa fa-trash"></i>
                    </div>
                    <div class="popup_bascket_item_description">
                      <p>Видалити без збереження</p>
                    </div>
                  </div>
                  </div>
                  <div class="popup_bascket_item_bottom">
                    <p>Скасувати</p>
                  </div>
                
              </div>
            </button>
             <div class="bascket_item_left">
               <img src="<?= $this->Url->build('/products/'.$value['product']['image'], ['fullBase' => true]) ?>" alt="">
             </div>
             <div class="bascket_item_right">
               <div class="bascket_item_right_title">
                 <p><?= $value['product']['title'] ?></p>
               </div>
               <div class="bascket_item_right_prices">
                 <div class="bascket_item_price">
                   <p><span class="translate_price" data-currency="<?= $value['product']['currency_id'] ?>" data-first="<?= $_SESSION['cart'][$key]['one_price'] ?>"><?= $_SESSION['cart'][$key]['one_price']  ?></span> грн</p>
                 </div>
                 <div class="bascket_item_buttons">
                   <div class="bascket_item_buttons_inside">
                     <div class="bascket_item_buttons_minus">
                       <i class="fa fa-minus"></i>
                     </div>
                     <output class="bascket_item_buttons_output"><?= $value['count'] ?></output>
                     <div class="bascket_item_buttons_plus">
                       <i class="fa fa-plus"></i>
                     </div>
                   </div>
                 </div>
                 <div class="bascket_item_price_total">
                   <p><span class="translate_price total_basket" data-currency="<?=$value['product']['currency_id'] ?>"><?= ($value['count'] * $_SESSION['cart'][$key]['one_price']) + (array_sum($value['array_option_value']) * $value['count']); ?></span> грн</p>
                 </div>
               </div>
             </div>
           </div>
         <?php  endforeach; ?>


        </div>
        <div class="bascet_total">
          <div class="bascet_total_left"></div>
          <div class="bascet_total_right">
            <span>Разом: </span><span><strong class="total_of_bascket"></strong> грн</span>
          </div>
          
        </div>
        <div class="bascket_bottom">
          <div class="bascet_bottom_left">
            <a href="#" data-dismiss="modal">Продовжити покупки</a>
          </div>
          <div class="bascet_bottom_right">
                <a href="<?= $this->Url->build(['controller' => 'orders','action'=>'index']) ?>" class="bascet_bottom_right_link">Оформити
                </a>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <?php   } ?>
</div> 
</div>

<div class="modal fade"  id="after_add_bascket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog basket_modal modal-dialog-centered" role="document">
        <div class="modal-content ">
     <div class="modal-header ">
      <div class="modal-header_left">
        <img src="<?= $this->Url->build('/img/35c3623714226214e0d47ead41c6053b.png', ['fullBase' => true]) ?>" alt="">
        <p>Дякуємо за замовлення</p>
      </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class=" quick_buy_modal">
      <div class="modal-body quick_buy_form added_to_cart_modal">
        <div class="added_to_cart_modal_message_top">
          <p>Персонал магазину підтвердить його, зв'язавшись з Вами по телефону чи через Email, який Ви вказали при оформленні замовлення.  </p>
          
        </div>
        <div class="added_to_cart_modal_message">
          <p>Номер Вашого замовлення</p>
          <p class="code_order">888</p>
        </div>
        <div class="to_home_page_link">
          <a href="<?= $this->Url->build(['controller' => 'main','action'    =>  '/']) ?>" class="to_home_page">Повернутись на головну</a>
        </div>
        
      </div>
    </div>
</div>
  </div>
</div> 

<div class="modal fade"  id="auth_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content ">
     <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body quick_buy_form added_to_cart_modal">
    <div class="user_form">
        <div class="user_authorization">
            <form action="" class="user_register">
                <label for="login">Логін або Email</label>
                <input type="email" name="email" class="login_input" required="required">

                <label for="password">Пароль </label>
                <input type="password" name="password" class="login_input"  required="required">
                
                <div class="user_form_checkbox">
                    <input type="checkbox"> Запам'ятати мене
                </div>
                <div class="user_form_checkbox">
                  <a href="<?= $this->Url->build(['controller' => 'users','action'    =>  'remember']) ?>">Забули пароль?</a>
                </div>
                <div class="users_bottom_register">

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
                <a href="/" class="new_user_register">Реєстрація</a>

                </div>
                                <output class="display_message_register"></output>
                  
            </form>
        </div>
      </div>
      </div>
    </div>
</div>
</div> 

<div class="modal fade"  id="added_wishlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content ">
     <div class="modal-header ">
      <div class="modal-header_left">
        <img src="<?= $this->Url->build('/img/35c3623714226214e0d47ead41c6053b.png', ['fullBase' => true]) ?>" alt="">
        <p>Товар додано в список бажаних.</p>
      </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class=" quick_buy_modal">
      <div class="modal-body quick_buy_form added_to_cart_modal">
        <div class="added_to_cart_modal_message_top">
          <p>Всі додані товари в список бажаних ви можете переглянути <a href="<?= $this->Url->build(['controller' => 'cabinet','action'    =>  'wishlist']) ?>" >тут</a></p>
          
        </div>
        <div class="to_home_page_link">
          <a href="<?= $this->Url->build(['controller' => 'main','action'    =>  '/']) ?>" class="to_home_page">Повернутись на головну</a>
        </div>
        
      </div>
    </div>
</div>
  </div>
</div> 

<div class="modal fade"  id="added_compare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content ">
     <div class="modal-header ">
      <div class="modal-header_left">
        <img src="<?= $this->Url->build('/img/35c3623714226214e0d47ead41c6053b.png', ['fullBase' => true]) ?>" alt="">
        <p>Товар додано в список порівнянь.</p>
      </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class=" quick_buy_modal">
      <div class="modal-body quick_buy_form added_to_cart_modal">
        <div class="added_to_cart_modal_message_top">
          <p>Всі додані товари в список порівнянь ви можете переглянути <a href="" class="link_to_compare">тут</a></p>
          
        </div>
        <div class="to_home_page_link">
          <a href="<?= $this->Url->build(['controller' => 'main','action'    =>  '/']) ?>" class="to_home_page">Повернутись на головну</a>
        </div>
        
      </div>
    </div>
</div>
  </div>
</div> 

<div class="modal fade"  id="wish_auth_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content ">
     <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body quick_buy_form added_to_cart_modal">
    <div class="user_form">
        <div class="user_authorization">
            <form action="" class="wish_auth_modal">
                <label for="login">Логін або Email</label>
                <input type="email" name="email" class="login_input" required="required">

                <label for="password">Пароль </label>
                <input type="password" name="password" class="login_input"  required="required">
                
                <div class="user_form_checkbox">
                    <input type="checkbox"> Запам'ятати мене
                </div>
                <div class="user_form_checkbox">
                  <a href="<?= $this->Url->build(['controller' => 'users','action'    =>  'remember']) ?>">Забули пароль?</a>
                </div>
                <div class="users_bottom_register">

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
                <a href="<?= $this->Url->build(['controller' => 'users','action'    =>  'login']) ?>" class="new_user_register">Реєстрація</a>

                </div>
                                <output class="display_message_register"></output>
                  
            </form>
        </div>
      </div>
      </div>
    </div>
</div>
</div> 

<div class="modal  fade" id="added_after_follow" tabindex="-1" role="dialog" aria-labelledby="basketlabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    
      <div class="modal-content ">
              <div class="modal-body  quick_buy_form ">
                  <div class="empty_basckets">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="new_follower_container">
                      <div>
                        <p>Дякуємо що ви з нами.</p>
                        <p>Ваша пошта <span class="email_follower"></span> пройде модерацію і Ви отримуватиме листи із <a href="<?= $this->Url->build(['controller' => 'promotions','action'    =>  '/']) ?>">Акціями</a> та новинками нашого магазину. </p>
                        </div>
                    </div>
                  </div>
              </div>
        </div>
      </div>
    </div>

  <div class="modal  fade" id="added_after_rewiev" tabindex="-1" role="dialog" aria-labelledby="basketlabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content ">
     <div class="modal-header ">
      <div class="modal-header_left">
        <img src="<?= $this->Url->build('/img/35c3623714226214e0d47ead41c6053b.png', ['fullBase' => true]) ?>" alt="">
        <p>Ваш відгук додано. </p>
      </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class=" quick_buy_modal">
      <div class="modal-body quick_buy_form added_to_cart_modal">
        <div class="added_to_cart_modal_message_top">
          <p>Дякуємо за  відгук. Ваш відгук буде опубліковано після модерації</p>
          
        </div>
        <div class="to_home_page_link">
          <a href="<?= $this->Url->build(['controller' => 'main','action'    =>  '/']) ?>" class="to_home_page">Повернутись на головну</a>
        </div>
        
      </div>
    </div>
</div>
  </div>
    </div>