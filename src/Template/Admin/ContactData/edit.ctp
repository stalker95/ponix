
 

    <div class="row">

      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('Contact data edit') ?>
          </p>
     <?= $this->Form->create($contactData)  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Email</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('email',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Phone</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('phone',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>   

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Location</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('location',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>
  

<?=  $this->Form->submit('Save ',['class'=>'btn  btn-primary save__changes__form__playlist']); ?>
     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>