  
 

    <div class="row">

      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('New SubUS add') ?>
          </p>
     <?= $this->Form->create($_user)  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Firstname </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('firstname',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Lastname </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('lastname',array('label' => 'Last Name','class'=>'form-control','required'=>'required')); ?>
    </div>
  </div>
</div>   

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>email </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
<?=  $this->Form->control('mail',['type'=>'email','label' => 'Email', 'class'=>'form-control','required'=>'required']); ?>
    </div>
  </div>
</div>  
<?php   if ($user->is_abs()): ?>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Choose US </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('users', array('label' => 'Choose US','required'=>'required','class'=>'form-control','empty'=>'Choose US')); ?>
    </div>
  </div>
</div> 
<?php   endif; ?>
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

 

 

  

  






<?=  $this->Form->submit('Add new user',['class'=>'btn  btn-primary save__changes__form']); ?>
     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>



