 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <div class="products_container_top">
       <p class="products_container_title">Блог</p>
       <div class="product_container_buttons">
         <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'xml','action' => 'index'
           )])  ?>
                      <div class="delete_form_checked_inputs"> </div>
<button class="btn delete_form_checked btn-dangeres save__changes__form__playlist" data-toggle="modal" data-target="#mediaGallery" style="background:  blue!important;">
                     Створити Xml файл
          </button>
           <?=   $this->Form->end() ?>
       </div>
     </div>
     <div class="box">
      <div class="box-body table-responsive no-padding">
       <div class="box-header">
              
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th class="first-check">
                    <label class="custom-checkbox">
                          <input type="checkbox" id="delete-all">
                          <span class="checkmark"></span>
                    </label>
                  </th>
                  <th>ID</th>
                  <th>Заголовок</th>
                  <th>Зображення</th>
                 </tr>
                </thead>
                <tbody>
                <?php   foreach ($Categories as $item): ?>
                  <tr>
                    <td class="first-check">
                       <label class="custom-checkbox">
                          <input type="checkbox" id="delete-all" value="<?= $item->id ?>" class='delete_item'>
                          <span class="checkmark"></span>
                    </label>
                    </td>
                    <td><?= $item->id ?></td>
                    <td><?= $item->title ?></td>
                    <td>
                      <img style="max-width: 100px; max-height: 100px;" src="<?= $this->Url->build('/categories/'.$item->image, ['fullBase' => true]) ?>" alt="" class="img-fluid">
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

    </section>
  <script>

<?php $this->Html->script('admin/jquery.dataTables.min.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/dataTables.bootstrap.min.js', ['block' => 'scriptBottom']); ?>
<?php echo $this->Html->scriptStart(['block' => true]); ?>
 
<?php echo $this->Html->scriptEnd(); ?>
</script>