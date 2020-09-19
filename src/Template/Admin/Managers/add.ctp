 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($_user,['type' => 'file'])  ?>
     <div class="products_container_top">
       <p class="products_container_title">Додавання менеджера</p>
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

     <?= $this->Form->create($_user)  ?>
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
    <p>Роль </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub" style="display: block;">

      <?php  if ($user->is_admin == 3):  ?>
      <label for="role" style="display: flex;width: 175px;justify-content: space-between;" >Адміністратор
        <input type="radio" name="is_admin" value="2" style="display: inline-block;width: auto;">
      </label><br>
      <label for="role" style="display: flex;width: 175px;justify-content: space-between;">Менеджер
        <input type="radio" name="is_admin" value="1" style="display: inline-block;width: auto;">
      </label>
    <?php endif; ?>

          <?php  if ($user->is_admin == 2):  ?>
     
      <label for="role" style="display: none;">
        <input type="radio" name="is_admin" value="1">
      </label>
    <?php endif; ?>



    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>password </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('password',['type'=>'password','label' => 'Password', 'class'=>'form-control']); ?>
    </div>
  </div>
</div>  


     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>
</div>