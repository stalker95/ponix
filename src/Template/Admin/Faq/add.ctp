
 

    <div class="row">

      <div class="col-md-10">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('New Faq add') ?>
          </p>
     <?= $this->Form->create($faq,['novalidate'=>'novalidate'])  ?>
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
    <p>Description</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('description',array('label' => false,'type'=>'textarea','class'=>'form-control','min'=>6,'id'=>'editText'));?>
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


<script>
   <?php $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.11/jquery.tinymce.min.js', ['block' => 'scriptBottom']); ?>
</script>