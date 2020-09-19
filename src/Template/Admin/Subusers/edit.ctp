<div class="row">
      <div class="col-md-6">  </div>
      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('SubUser information') ?>
          </p>
     <?= $this->Form->create($_user)  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Firstname </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('firstname',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Lastname </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('lastname',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>   

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>email </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
   <?=  $this->Form->control('mail',['type'=>'email','label' => 'Email', 'class'=>'form-control']); ?>
    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>password </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('new_password',['type'=>'password','label' => 'Password', 'class'=>'form-control']); ?>
    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Choose US</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
              
      <select name="Parent" id="" class="form-control">
        <?php if ($_user->parent): ?>
         <option value="<?= $_user->parent->id ?>"><?= $_user->parent->firstname." ".$_user->parent->lastname ?></option>
       <?php endif; ?>
       <?php if (!$_user->parent): ?>
         <option value="0">Choose US</option>
       <?php endif; ?>
      <?php   foreach ($Parents as $value): ?>
        <option value="<?=  $value['id'] ?>"> <?= $value['firstname']." ".$value['lastname'] ?> </option>
      <?php   endforeach; ?>
        </select>
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

  