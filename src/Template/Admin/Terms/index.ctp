    <!-- Main content -->
        <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Title</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($title as $item) {
                  echo "<tr>
                  <td>".$item->title."</td>
                
                  
                 <td class='table__flex'>";
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit_title', $item->id], ['class'=>'btn change__user','escape' => false]);
                
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
          <h1 class="blog__title">Terms page</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
              <?php   echo  $this->Html->link('Add new',['action'=>'add'],['class'=>'btn btn-primary create__new__user']); ?>
            </div>
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th><input type="checkbox" id="delete-all"></th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($terms as $item): ?>
                  <tr>
                   <td><input type='checkbox' value=".$item->id." class='delete_item'></td>
                   <td><?= $item->id ?></td>
                   <td><?= $item->title ?></td>
                   <td><?= $item->description ?></td>
                  
                 <td class='table__flex'>
                 <?php  echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $item->id], ['class'=>'btn change__user','escape' => false]);
                 echo  $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $item->id], ['class'=>'btn  delete__user','escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $item->id)]);  ?>
                 </td>
                  </tr>
                <?php endforeach; ?>
                
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