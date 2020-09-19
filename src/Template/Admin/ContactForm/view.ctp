 <div class="row">

      <div class="col-md-8">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title"> 
            <?= __('Contact form information') ?>
          </p>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Name</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <p><?= $contactForm->name; ?></p>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Email</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
       <?= $contactForm->email; ?>
    </div>
  </div>
</div>   

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Message</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?= $contactForm->message; ?>
    </div>
  </div>
</div>   
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>