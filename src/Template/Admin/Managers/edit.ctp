 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($_user,['type' => 'file'])  ?>
     <div class="products_container_top">
       <p class="products_container_title">Редагування опції</p>
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
    <p>Ім'я </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('firstname',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Прізвище</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('lastname',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>   

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Email </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
   <?=  $this->Form->control('mail',['type'=>'email','label' => 'Email', 'class'=>'form-control']); ?>
    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Новий пароль </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
   <?=  $this->Form->control('new_password',['type'=>'text','label' => 'Email', 'class'=>'form-control', 'min' => '6']); ?>
    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Статус </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?php   if ($_user->status == 1):  ?>
        <select name="active" id="" class="form-control">
          <option value="1">Активний</option>
          <option value="0">Не активний</option>
        </select>
      <?php   endif; ?>
      <?php   if ($_user->status == 0):  ?>
        <select name="active" id="">
          <option value="0">Не активний</option>
          <option value="1">Активний</option>
        </select>
      <?php   endif; ?>
    </div>
  </div>
</div>  


     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>