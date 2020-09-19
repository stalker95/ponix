 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <div class="products_container_top">
       <p class="products_container_title">Швидкі покупки</p>
       <div class="product_container_buttons">
         
         <div class="create__new__user">
           
           <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist" data-toggle="modal" data-target="#mediaGallery" >
                     <i class="fa fa-trash"></i>
          </button>
         </div>
         
       </div>
     </div>
     <div class="box">
      <div class="box-body table-responsive no-padding">
       <div class="box-header">
        
              
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th class="first-check"> <label class="custom-checkbox">
                          <input type="checkbox" id="delete-all">
                          <span class="checkmark"></span>
                    </label></th>
                  <th>Ім'я</th>
                  <th>Телефон</th>
                  <th>Товар</th>
                  <th>Дата покупки</th>
                  <th>Замітки менеджера</th>
                  <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <?php   foreach ($quickOrders as $quickOrder): ?>
                  <tr>
                    <td class="first-check"> <label class="custom-checkbox">
                          <input type="checkbox" id="delete-all" value="<?= $quickOrder->id ?>" class='delete_item'>
                          <span class="checkmark"></span>
                    </label></td>
                    <td><?= $quickOrder->username ?></td>
                    <td><?= $quickOrder->phone ?></td>
                    <td><?= $quickOrder->product->title ?></td>
                    <td><?= $quickOrder->date ?></td>
                    <td><textarea name="" id="" class="notes_type" data-order="<?= $quickOrder->id ?>"><?= $quickOrder->notes ?></textarea></td>
                    <td>
                      <select name="change_status" data-order="<?= $quickOrder->id ?>" class="change_status">
                        <option value="0" <?php   if($quickOrder->status == 0) { echo "selected"; } ?>>Не підтверджено</option>
                        <option value="1" <?php   if($quickOrder->status == 1) { echo "selected"; } ?>>Підтверджено</option>
                        <option value="2" <?php   if($quickOrder->status == 2) { echo "selected"; } ?>>Скасовано</option>
                        <option value="3" <?php   if($quickOrder->status == 3)  { echo "selected"; } ?>>Оплачено</option>
                      </select>
                     <!-- <?php if ($quickOrder->status == 0): ?>
                        <button class="btn btn-success confirm_status" data-record="<?= $quickOrder->id ?>">Підтвердити</button>
                      <?php endif; ?>
                       <?php if ($quickOrder->status != 0): ?>
                        Підтверджено
                       <?php endif; ?> -->
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
                    <?= $this->Paginator->first('<< ' . __('Перша')) ?>
                    <?= $this->Paginator->prev('< ' . __('Попередня')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('Далі') . ' >') ?>
                <?= $this->Paginator->last(__('Остання') . ' >>') ?>
                </ul>
          <?php endif; ?>
          </div>
        </div>
      </div>

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
          <h2 style="text-align: center;">Ви хочете видалити швидкі замовлення ?</h2>
          <button class="close_modal_form close__modal" >Ні</button>
           <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'quick-orders','action' => 'deletechecked'
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
  
   $(".notes_type").keypress(function() {

    var id = $(this).attr('data-order');
    var text = $(this).val();


    $.ajax({
        url: '<?= $this->Url->build(['controller' => 'quick-orders', 'action' => 'change-notes', '_full' => true]) ?>',
        method: 'POST',
        data: { "id": id, "text": text},
        success: function(data){ 
          
        }
    });

   });


   $(".change_status").change(function() {
      
      var id_order = $(this).attr('data-order');
      var status = $(this).val();

      $.ajax({
        url: '<?= $this->Url->build(['controller' => 'quick-orders', 'action' => 'change-order', '_full' => true]) ?>',
        method: 'POST',
        data: { "id_order": id_order, status: status},
        success: function(data){ 
          
        }
    });

   });

   $(".confirm_status").click(function() {

     var id_product = $(this).attr("data-record");
     var element = $(this);

   $.ajax({
        url: '<?= $this->Url->build(['controller' => 'quick-orders', 'action' => 'check-order', '_full' => true]) ?>',
        method: 'POST',
        data: { "id_product": id_product},
        success: function(data){ 
          if (data.status == "true") {
            element.parent().html("Підтверджено");
          }
        }
    });

   });
<?php echo $this->Html->scriptEnd(); ?>
</script>