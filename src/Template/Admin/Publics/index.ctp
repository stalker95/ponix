 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($publics)  ?>
     <div class="products_container_top">
       <p class="products_container_title">Публічна оферта</p>
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
    <p>Title page</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('title_page',array('label' => false,'type'=>'text','class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

     

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Description Page</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('description_page',array('label' => false,'type'=>'textarea','class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>   

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Keywords</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('keywords',array('label' => false,'type'=>'textarea','class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

  <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title Page</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('title',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Text </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('description',array('label' => false,'type'=>'textarea','class'=>'form-control','min'=>6,'id' => 'editor1','required'=>'required'));?>
    </div>
  </div>
</div>

     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script>
    $(document).ready(function () {
       CKEDITOR.replace( 'editor1');
    });
</script>