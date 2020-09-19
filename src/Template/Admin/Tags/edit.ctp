            	
<?= $this->Form->create($tag)  ?>
    <div class="row">

      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('New Tag edit') ?>
          </p>
    <?= $this->Form->create($tag); ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Name </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('name',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
<?=  $this->Form->submit('Save changes',['class'=>'btn  btn-primary save__changes__form']); ?>
     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>