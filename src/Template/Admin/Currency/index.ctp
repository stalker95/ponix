<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
            <?= $this->Form->create($currency, ['type' => 'file','action'=>'index']); ?>
     <div class="products_container_top">
       <p class="products_container_title">Налаштування валют</p>
       <div class="product_container_buttons">
         <button class="btn-primary" type="submit">
          <i class="fa fa-save"></i>
        </button>
         <div class="create__new__user">
            <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist copy_checked" data-toggle="modal" data-target="#mediaGallery" >
                     <i class="fa fa-copy"></i>
          </button>
           <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist" data-toggle="modal" data-target="#mediaGallery" >
                     <i class="fa fa-trash"></i>
          </button>
         </div>
         
       </div>
     </div>

          <div class="playlist__managment--item">
              <div class="playlist__managment--item__left">
                Спосіб конвертації валют
              </div>
          <div class="playlist__managment--item__right">
            <div class="playlist--item--sub" style="display: flex;">
              <?php if ($currency->type == 1 ){  ?>
                <label class="custom-radio" style="display: block;">Автоматичний
  <input type="radio" checked value="1" class="change_currency" name="type">
  <span class="checkmark"></span>
</label>

<label class="custom-radio" style="display: block;">Власний
  <input type="radio" value="2" class="change_currency" name="type">
  <span class="checkmark"></span>
</label>
                

                

              <?php } else { ?>
                <label class="custom-radio" style="display: block;">Автоматичний
  <input type="radio"  value="1" class="change_currency" name="type">
  <span class="checkmark"></span>
</label>
                <label class="custom-radio" style="display: block;">Власний
  <input type="radio" checked value="2" class="change_currency" name="type">
  <span class="checkmark"></span>
</label>
              <?php } ?>
                  
                </div>
                
            </div>
          </div>


          <div class="playlist__managment--item">
              <div class="playlist__managment--item__left">
               Власний курс євро
              </div>
          <div class="playlist__managment--item__right">
            <div class="playlist--item--sub" style="display: block;">
                
                
                <div style="display: flex;align-items: center;justify-content: space-between;" >
                  <?php if($currency->type == 1){ ?>
                    <?=  $this->Form->control('value',array('label'=>false,'class'=>'input_currency form-control','required'=>'required','style'=>'width: 300px;text-align:right;','disabled' => 'disabled'));?>
                  <?php } else { ?>
                   <?=  $this->Form->control('value',array('label'=>false,'class'=>'input_currency form-control','required'=>'required','style'=>'width: 300px;text-align:right;'));?>
                 <?php } ?>
                </div>
              
           
            </div>
            </div>
          </div>

          <div class="playlist__managment--item">
              <div class="playlist__managment--item__left">
              Власний курс доллара
              </div>
          <div class="playlist__managment--item__right">
            <div class="playlist--item--sub" style="display: block;">
                
               
                 <div style="display: flex;align-items: center;justify-content: space-between;" >
                   

                   <?php if($currency->type == 1){ ?>
                    <?=  $this->Form->control('value_dollar',array('label'=>false,'class'=>'input_currency form-control','required'=>'required','style'=>'width: 300px;text-align:right;','disabled' => 'disabled'));?>
                  <?php } else { ?>
                   <?=  $this->Form->control('value_dollar',array('label'=>false,'class'=>'input_currency form-control','required'=>'required','style'=>'width: 300px;text-align:right;'));?>
                 <?php } ?>
                </div>
            </div>
            </div>
          </div>

            <?=  $this->Form->end() ?>
        </div>
      </div>
</div>
</section>

  <script>

<?php $this->Html->script('admin/jquery.dataTables.min.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/dataTables.bootstrap.min.js', ['block' => 'scriptBottom']); ?>
<?php echo $this->Html->scriptStart(['block' => true]); ?>

 $(document).ready(function() {
    $('.js-example-basic-single').select2();

    $(".change_currency").change(function() {
       
       if ($(this).val() == 1) {
          $(".input_currency").attr('disabled', 'disabled');
       } else {
         $(".input_currency").removeAttr('disabled');
       }

    });
});

<?php echo $this->Html->scriptEnd(); ?>
</script>