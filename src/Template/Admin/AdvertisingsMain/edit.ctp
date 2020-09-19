
 

    <div class="row">

      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('Edit Advertisings') ?>
          </p>
     <?= $this->Form->create($advertisingsMain,['type' => 'file'])  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('name',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Description</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('description',array('label' => false,'type'=>'textarea','class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div> 

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Current image</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Html->image('/img/advertising_main/' . $advertisingsMain->image, ['class' => 'img-circle', 'style' => 'width: 100px; border-radius:0px;', 'fullBase' => true]); ?>
    </div>
  </div>
</div> 

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>New Image</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('image',array('label' => false,'type'=>'file','class'=>'form-control','min'=>6));?>
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