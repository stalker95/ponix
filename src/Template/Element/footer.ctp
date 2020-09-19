</main>
<footer>
	<div class="malling container">
		<div class="row align-items-center">
			<div class="col-md-2 mailing_left">
				<div>
					<img src="<?= $this->Url->build('/img/email.svg', ['fullBase' => true]) ?>" alt="">
				</div>
			</div>
			<div class="col-md-5">
				<p class="mailing_title">Підписатися на розсилку акцій та новинок </p>
			</div>
			<div class="malling_right">
				<div class="mailing_form">
					<form action="" class='create_new_customer'>
						<input type="email" placeholder="Введіть ваш email" name="user_email">
						<input type="submit" value="Підписатися">
					</form>
				</div>
			</div>
		</div>
	 </div>
	<div class="container footer_bottom background_white">
		<div class="row">
			<div class="col-md-3">
				<div class="footer_left">
					<div class="footer_left_top">
						<a href="/">
                            <img src='<?= $this->Url->build("/settings/$settings->logo", ["fullBase" => true]) ?>' alt="">
                     </a>
					</div>
					 
                     <div class="footer_left_description">
                     	<p>Постачальник професійного обладнання для громадського харчування: кафе, ресторанів, готелів, підприємств швидкого харчування.</p>
                     </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="footer_links">
					<p class="footer_links_title footer-title">Інформація</p>
					<div class="footer_links_container">
						<a href="<?= $this->Url->build(['controller' => 'about','action'   =>  'index']) ?>" class="footer_link"><span>></span>Про нас </a>
						<a href="<?= $this->Url->build(['controller' => 'change','action'   =>  'index']) ?>" class="footer_link"><span>></span>Обмін та повернення</a>

						<a href="<?= $this->Url->build(['controller' => 'delivery','action'   =>  'index']) ?>" class="footer_link"><span>></span>Доставка </a>
						<a href="<?= $this->Url->build(['controller' => 'payments','action'   =>  'index']) ?>" class="footer_link"><span>></span>Оплата</a>
						<a href="<?= $this->Url->build(['controller' => 'public-offerta','action'   =>  'index']) ?>" class="footer_link"><span>></span>Публічна оферта</a>
						<a href="<?= $this->Url->build(['controller' => 'contacts','action'   =>  'index']) ?>" class="footer_link"><span>></span>Контакти</a>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="footer_contacts">
				    <p class="footer_links_title footer-title">Будемо на звязку</p>
				    <div class="footer_contacts_container">
				    	
				   
					<div class="footer_contacts_item">
						<div class="footer_contacts_icon">
							<i class="fa fa-map-marker"></i>
						</div>
						<div class="footer_contacts_title">
							<p><?= $settings->address ?></p>
						</div>
					</div>
					<div class="footer_contacts_item">
						<div class="footer_contacts_icon">
							<i class="fa fa-phone"></i>
						</div>
						<div class="footer_contacts_title">
							<p>
								<?php
                    			$arr = explode('<br>', $settings->phones);
								   foreach($arr as $item): if (!empty($item)): ?>
                                     <a href="tel:<?= $item ?>" > <?= $item."<br>" ?> </a>
                                   <?php endif; endforeach; ?>
                            </p>
						</div>
					</div>
					<div class="footer_contacts_item">
						<div class="footer_contacts_icon">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="footer_contacts_title">
							<a href="mailto:<?= $settings->email ?>"><?= $settings->email ?></a>
						</div>
					</div>
					<div class="footer_contacts_item">
						<div class="footer_contacts_icon">
							<i class="far fa-clock"></i>
						</div>
						<div class="footer_contacts_title">
							<p><?= $settings->time ?></p>
						</div>
					</div>
					 </div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="social_links">
					<p class="social_links_title footer-title">Ми в соц мережах</p>
					<div class="social_links_container">

						<?php foreach ($socials as $key => $value):?>
							<?php if (!empty($value['url'])): ?>
							<div class="social_links_item">
								<a href="<?= $value['url'] ?>"><img src="<?= $this->Url->build('/img/'.$value['image'].'', ['fullBase' => true]) ?>" alt=""></a>
							</div>
						<?php endif; ?>
						<?php endforeach; ?>

						
					</div>
					<div class="payment_methods">	
						<p class="social_links_title footer-title">Способи оплати</p>
						<div class="social_links_payments">
							<div class="social_links_payments_item">
								<img src="<?= $this->Url->build('/img/bezn-symb.png', ['fullBase' => true]) ?>" alt="">
							</div>
							<div class="social_links_payments_item">
								<img src="<?= $this->Url->build('/img/logo-opcha.png', ['fullBase' => true]) ?>" alt="">
							</div>
							<div class="social_links_payments_item">
								<img src="<?= $this->Url->build('/img/liqpay.png', ['fullBase' => true]) ?>" alt="">
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
<!--	<div class="wrap__call" data-toggle="modal" data-target="#get_mobile">
  <div></div>
  <div></div>
  <span>
    <i class="fa fa-phone fa-3x" aria-hidden="true"></i>
  </span>
</div> -->
<div class="footer_two">
	<div class="container">
		<div class="footer_two_title">
			<p>Copyright &#169; Poniks 2020. Всі права захищено.</p>
		</div>
	</div>
</div>
</footer>
<script>var telerWdWidgetId="02ee9277-5994-4b5c-8054-ac205af24931";var telerWdDomain="proftorg.phonet.com.ua";</script> <script src="//proftorg.phonet.com.ua/public/widget/call-catcher/lib-v3.js"></script> 
