 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($attribute,['type' => 'file'])  ?>
     <div class="products_container_top">
       <p class="products_container_title">Редагування атрибута</p>
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
            <?= $this->Form->create($attribute); ?>
              <div class="playlist__managment--item">
                  <div class="playlist__managment--item__left">
                   <p>Ім'я</p>
                  </div>
                  <div class="playlist__managment--item__right">
                    <div class="playlist--item--sub">
                        <?=  $this->Form->control('name',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>
                    </div>
                  </div>
              </div>
                        <?=  $this->Form->end() ?>
        </div>
      </div>
</div>
</section>

