    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Faq</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
              
              <?php   echo  $this->Html->link('Add new',['controller'=>'faq','action'=>'add'],['class'=>'btn btn-primary create__new__user']); ?>
            </div>
              
           </div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th><input type="checkbox" id="delete-all"></th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($faq as $faq_item) {
                  echo "<tr>
                  <td><input type='checkbox' value=".$faq_item->id." class='delete_item'></td>
                  <td>".$faq_item->id."</td>
                  <td>".$faq_item->title."</td>
                  <td>".$faq_item->description."</td>
                  
                 <td class='table__flex'>";
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'faq','action' => 'edit', $faq_item->id], ['class'=>'btn change__user','escape' => false]);
                 echo  $this->Form->postLink('<i class="fa fa-trash"></i>', ['controller'=>'faq','action' => 'delete', $faq_item->id], ['class'=>'btn  delete__user','escape' => false,'confirm' => __('Are you want  to delete # {0}?', $faq_item->title)]);  
                  echo "</td>";
                  echo "</tr>";
                } ?>
                
              </tbody>
              </table>
            </div>
             <!--<?php  echo $this->Paginator->numbers(); echo $this->Paginator->counter(); ?> -->

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>

        <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Terms</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
              
              <?php   echo  $this->Html->link('Add new',['controller'=>'terms','action'=>'add'],['class'=>'btn btn-primary create__new__user']); ?>
            </div>
              
           </div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th><input type="checkbox" id="delete-all"></th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($terms as $terms_item) {
                  echo "<tr>
                  <td><input type='checkbox' value=".$terms_item->id." class='delete_item'></td>
                  <td>".$terms_item->id."</td>
                  <td>".$terms_item->title."</td>
                  <td>".$terms_item->description."</td>
                  
                 <td class='table__flex'>";
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'terms','action' => 'edit', $terms_item->id], ['class'=>'btn change__user','escape' => false]);
                 echo  $this->Form->postLink('<i class="fa fa-trash"></i>', ['controller'=>'terms','action' => 'delete', $terms_item->id], ['class'=>'btn  delete__user','escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $terms_item->title)]);  
                  echo "</td>";
                  echo "</tr>";
                } ?>
                
              </tbody>
              </table>
            </div>
             <!--<?php  echo $this->Paginator->numbers(); echo $this->Paginator->counter(); ?> -->

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  <script>

<?php $this->Html->script('admin/jquery.dataTables.min.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/dataTables.bootstrap.min.js', ['block' => 'scriptBottom']); ?>
<?php echo $this->Html->scriptStart(['block' => true]); ?>
  
  $(function () {
   
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  })
<?php echo $this->Html->scriptEnd(); ?>
</script>