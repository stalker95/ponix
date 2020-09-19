
 

    <div class="row">

      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('New Faq add') ?>
          </p>
     <?= $this->Form->create($socialIcon)  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Name</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('name',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Url</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('url',array('label' => false,'class'=>'form-control','min'=>6));?>
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