 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <div class="products_container_top">
       <p class="products_container_title">Замовлення</p>
       <div class="product_container_buttons">
        
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
                  <th>Номер замовлення</th>
                  <th>Покупець</th>
                  <th>Дата покупки</th>
                  <th>Сума грн.</th>
                  <th>Статус</th>
                  <th>Дії</th>
                </tr>
                </thead>
                <tbody>
                <?php   foreach ($orders as $order): ?>
                  <tr>
                    <td class="first-check">
                       <label class="custom-checkbox">
                          <input type="checkbox" id="delete-all" value="<?= $order->id ?>" class='delete_item'>
                          <span class="checkmark"></span>
                    </label>
                    </td>

                    <td><?= $order['id'] ?></td>
                    <td><?= $order['username'] ?></td>
                    <td><?= $order['created'] ?></td>
                    <td><?= $order['total'] ?></td>
                    <td><?php if ($order['status'] == 0): ?> Новий <?php endif; ?>
                    <?php if ($order['status'] == 1): ?> Оплачено <?php endif; ?>
                    <?php if ($order['status'] == 2): ?> Виконано <?php endif; ?>
                    <?php if ($order['status'] == 3): ?> Відмінено <?php endif; ?>
                      
                    </td>

                    <td class='table__flex'>
                      <?php
                        echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $order->id], ['class'=>'btn change__user','escape' => false]);

                         echo   $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $order->id], ['class'=>'btn change__user','escape' => false]);

                         echo "<button class='btn  delete__user' data-toggle='modal' data-target='#mediaGallery_".$order->id."'><i class='fa fa-trash'></i></button>"; ?>
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


<?php   foreach ($orders as $order): ?>

  <div class="modal fade" id="mediaGallery_<?= $order->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="gallery-box form__inline" style="text-align: center;">
          <h2 style="text-align: center;">Ви хочете видалити замовлення №<?= $order->id ?> ?</h2>
          <button class="close_modal_form close__modal" >Ні</button>
           <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'orders','action' => 'delete/'.$order->id
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
          <h2 style="text-align: center;">Ви хочете видалити замовлення ?</h2>
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