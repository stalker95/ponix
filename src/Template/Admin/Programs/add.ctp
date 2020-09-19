
 

    <div class="row">

      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('New Program add') ?>
          </p>
     <?= $this->Form->create($program)  ?>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('title',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Price</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('price',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title bottom</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('title_two',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Description</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('description',array('label' => false,'type'=>'textarea','class'=>'form-control','min'=>6,
      'default'=>'<p>Hello</p>
<p>Hello</p>
<p>Hello</p>'));?>
    </div>
  </div>
</div>   

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Button text</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('button_text',array('label' => false,'class'=>'form-control','min'=>6));?>
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