<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<section class="content">
    <div class="row">
      <div class="col-md-6">
         <h1 class="blog__title">Редагування категорії</h1>
         <div class="playlist__managment__item">
            <?= $this->Form->create($category, ['type' => 'file']); ?>
                    <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Ім'я </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('name',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Slug</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('slug',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('title',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title H1</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('title_h1',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Description page</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('description_page',array('type'=>'textarea','label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Опис</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('desription',array('type'=>'textarea','label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Keywords</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('keywords',array('type'=>'textarea','label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
            <div class="playlist__managment--item">
              <div class="playlist__managment--item__left">
                <p>Батьківська категорія </p>
              </div>
              <div class="playlist__managment--item__right">
                <div class="playlist--item--sub">
                  <select name="parent_id" id="" class="form-control">
                    <option value="<?= $parent_category->id  ?>"><?= $parent_category->name ?></option>
                    <?php  foreach ($categories as $key => $value): ?>
                      <option value="<?= $value['id'] ?>"> <?= $value['name']; ?> </option>
                    <?php  endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Image</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('image',array('type'=>'textarea','label' => 'First Name','class'=>'form-control','required'=>'required'));?>      
    </div>
  </div>
</div>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Позиція</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('position',array('type'=>'textarea','label' => 'First Name','class'=>'form-control'));?>      
    </div>
  </div>
</div>
<div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Головне зображення</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub" style="display: block;">
                  <?=  $this->Form->control('picture',array('label' => 'First Name','type'=>'file','class'=>' form-control ','required'=>'false','style'=>'font-size: 1em;padding:0px;width:200px;','id'=>'fileimgMeal'));?>  
                  <div id="fotosViewMeal" style="position: relative;width: 100%;" class="image_gallery_preview">
                    <img src="<?= $this->Url->build('/categories/'.$category->picture, ['fullBase' => true]) ?>" alt="">
                  </div>  
                  </div>
            </div>
        </div>
            <?=  $this->Form->submit('Зберегти зміни',['class'=>'btn  btn-primary save__changes__form']); ?>
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
});

<?php echo $this->Html->scriptEnd(); ?>
</script>