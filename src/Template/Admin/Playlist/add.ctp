


 

    <div class="row">

      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('New Playlist add') ?>
          </p>
     <?= $this->Form->create($Playlist)  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Name of playlist </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
<?=  $this->Form->control('name',array('label' => 'Name Playlist','class'=>'form-control','required'=>'required'));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Choose User </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
<?=  $this->Form->control('Users.0.user_id',array('label' => 'Users','class'=>'form-control','required'=>'required','default'=>'Choose User')); ?>
    </div>
  </div>
</div>   

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Category</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
<?=  $this->Form->control('Categories.0.category_id',array('label' => 'Category','class'=>'form-control','required'=>'required')); ?>
    </div>
  </div>
</div>  
  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Themes</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('themes',['label' => 'Password', 'class'=>'form-control','required'=>'required','style'=>'width:100%;']); ?>
    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Adress </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('address',['type'=>'text','label' => 'Password', 'class'=>'form-control']); ?>
    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>City </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('city',['type'=>'text','label' => 'Password', 'class'=>'form-control']); ?>
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