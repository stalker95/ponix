 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($seo, ['action' => 'edit'])  ?>
     <div class="products_container_top">
       <p class="products_container_title">Seo</p>
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
<div class="row">

      <div class="col-md-12">
        <div class="playlist__managment__item">
    <div class="products_container">      
    
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
      <?=  $this->Form->control('description',array('label' => false,'type'=>'textarea','class'=>'form-control','min'=>6));?>
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
  

  
</div>

        </div>
      </div>

</div>
     <?=   $this->Form->end() ?>
       </div>
     </div>
   </section>