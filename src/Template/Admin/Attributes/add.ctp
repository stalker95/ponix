 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($attribute,['type' => 'file'])  ?>
     <div class="products_container_top">
       <p class="products_container_title">Додавання групи атрибутів</p>
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
        <div class="playlist__managment__item">
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Назва</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('name',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>

     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>


</section>
 <script>

<?php $this->Html->script('admin/jquery.dataTables.min.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/dataTables.bootstrap.min.js', ['block' => 'scriptBottom']); ?>
<?php echo $this->Html->scriptStart(['block' => true]); ?>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

   $("#add_new_variation").click(function() {
      $(".variation_list").append("<div style='display: flex;' class='delete_option_block'><button class='delete_option delete_option_button'>Видалити</button><input type='text' name='attribute_item[]'></div>")
   });

   $(".delete_option").click(function() {
       $(this).parent().remove();
   });

<?php echo $this->Html->scriptEnd(); ?>
</script>