    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Programs</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
               <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'programs','action' => 'deletechecked'),'class'=>'delete_form_checked','style'=>'display:none;'])  ?>
                   <div class="delete_form_checked_inputs">  </div>
                   <?=  $this->Form->submit('Delete ',['class'=>'btn  btn-dangeres save__changes__form__playlist']); ?>
     <?=   $this->Form->end() ?>
              <?php   echo  $this->Html->link('Add new',['action'=>'add'],['class'=>'btn btn-primary create__new__user']); ?>
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
           
                <?php   foreach ($programs as $program) {
                  echo "<tr>
                  <td><input type='checkbox' value=".$program->id." class='delete_item'></td>
                  <td>".$program->id."</td>
                  <td>".$program->name."</td>
                  
                 <td class='table__flex'>";
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $program->id], ['class'=>'btn change__user','escape' => false]);
                 echo  $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $program->id], ['class'=>'btn  delete__user','escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $program->id)]);  
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