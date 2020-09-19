 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <div class="products_container_top">
       <p class="products_container_title">Товари</p>
       <div class="product_container_buttons">
         <a href="<?= $this->Url->build(['controller' => 'products','action'=>'add']) ?>" class="product_container_buttons_add btn-primary">
           <i class="fa fa-plus"></i>
         </a>
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
     <div class="box">
      <div class="box-body table-responsive no-padding">
       <div class="box-header">
        <div class="create__new__user">
         <!-- <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist" data-toggle="modal" data-target="#mediaGallery" >
                     Delete
          </button> -->
          <!--<?php   echo  $this->Html->link('Додати ',['action'=>'add'],['class'=>'btn btn-primary create__new__user']); ?> -->
           <?php /*   <div class="search-form-find">
               <?= $this->Form->create('Search',['url'   => array(
               'controller' => 'products','action' => 'search'
                 )]);
                echo  $this->Form->control('name',array('label' => false,'class'=>'form-control','min'=>6));
                echo  $this->Form->end(); 
             ?>
               <p class="search-form-find-title"> Пошук </p>
            </div> */ ?>
            </div>
              
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th class="first-check" >
                    <label class="custom-checkbox">
                          <input type="checkbox" id="delete-all">
                          <span class="checkmark"></span>
                    </label>
                  </th>
                  <th>Зображення</th>
                  <th>Найменування товару </th>
                  <th>Кількість</th>
                  <th>Категорія</th>
                  <th>Ціна на сайті</th>
                  <th>Дії</th>
                </tr>
                </thead>
                <tbody>
                <?php   foreach ($products as $product): ?>
                  <tr>
                    <td class="first-check">
                       <label class="custom-checkbox">
                          <input type="checkbox" id="delete-all" value="<?= $product->id ?>" class='delete_item'>
                          <span class="checkmark"></span>
                    </label>
                    </td>
                    <td>
                      <img style="max-width: 75px; max-height: 70px;" src="<?= $this->Url->build('/products/'.$product->image, ['fullBase' => true]) ?>" alt="" class="img-fluid">
                    </td>
                    <td><?= $product['title'] ?></td>
                    <td><?= $product['amount'] ?></td>
                    
                    <td><?= $product->category->name ?></td>
                    <td>
                      <span class="translate_price_two" data-currency="<?= $product->currency_id ?>">
                        <?php if (!empty($product['products_options'])): ?>
                          <?= $product['products_options'][0]['value']; ?>
                        <?php else: ?>
                          <?= $product->price ?>
                        <?php endif; ?>
                        </span>
                   грн</td>
                    <td class='table__flex'>
                      <?php
                        echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $product->id], ['class'=>'btn change__user','escape' => false]);
                         echo   $this->Html->link('<i class="fa fa-copy"></i>', ['action' => 'copy-element', $product->id], ['class'=>'btn copy_product','escape' => false]);
                         echo "<button class='btn  delete__user' data-toggle='modal' data-target='#mediaGallery_".$product->id."'><i class='fa fa-trash'></i></button>"; ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
              </table>
            </div>
             <?php
              $params = $this->Paginator->params();
              if ($params['pageCount'] > 1): ?>
                <ul class="pagination pagination-sm">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
          <?php endif; ?>
          </div>
        </div>
      </div>



<?php   foreach ($products as $product): ?>

  <div class="modal fade" id="mediaGallery_<?= $product->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="gallery-box form__inline" style="text-align: center;">
          <h2 style="text-align: center;">Ви хочете видалити товар <?= $product->title ?> ?</h2>
          <button class="close_modal_form close__modal" >Ні</button>
           <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'products','action' => 'delete/'.$product->id
           )])  ?>
           <div class="delete_form_checked_inputs"> </div>
           <?=  $this->Form->submit('Так ',['class'=>'btn  btn-dangeres save__changes__form__playlist','style'=>'margin-top:0px;margin-left:auto;margin-right:auto;']); ?>
           <?=   $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php endforeach; ?>

<div class="modal fade" id="mediaGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="gallery-box form__inline" style="text-align: center;">
          <h2 style="text-align: center;">Ви хочете видалити товари ?</h2>
          <button class="close_modal_form close__modal" >Ні</button>
           <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'products','action' => 'deletechecked'
           )])  ?>
           <div class="delete_form_checked_inputs"> </div>
           <?=  $this->Form->submit('Так ',['class'=>'btn  btn-dangeres save__changes__form__playlist','style'=>'margin-top:0px;margin-left:auto;margin-right:auto;']); ?>
           <?=   $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>

    </section>
  <script>

<?php $this->Html->script('admin/jquery.dataTables.min.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/dataTables.bootstrap.min.js', ['block' => 'scriptBottom']); ?>
<?php echo $this->Html->scriptStart(['block' => true]); ?>
 
<?php echo $this->Html->scriptEnd(); ?>
</script>