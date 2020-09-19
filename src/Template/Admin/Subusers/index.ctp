    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">SubUS </h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
                <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist" style="display: none;margin-top: 0px;
    background: #ffeaef;
    margin-top: 0px;
    color: red;
    padding: 6px 30px;"  data-toggle="modal" data-target="#mediaGallery" >
                     Delete
                   </button>
              <?php   echo  $this->Html->link('Add new',['action'=>'add'],['class'=>'btn btn-primary create__new__user']); ?>
              <div class="search-form-find">
                <?= $this->Form->create('Search',['url'   => array(
               'controller' => 'subusers','action' => 'search'
                 )]);
                echo  $this->Form->control('name',array('label' => false,'class'=>'form-control','min'=>6));
                echo  $this->Form->end(); 
             ?>
               <p class="search-form-find-title">Users</p>
            </div>
            </div>
              
</div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th><input type="checkbox" id="delete-all"></th>
                  <th>FirstName</th>
                  <th>LastName</th>
                  <th>Email</th>
                  <th>Parent</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php   foreach ($users as $user) : ?>
                <tr>
                  <td><input type='checkbox' value="<?= $user->id ?>" class='delete_item'></td>
                  <td><?= $user->firstname ?></td>
                  <td><?= $user->lastname ?></td>
                  <td><?= $user->mail ?></td>
                  <td><?= $user->parent['firstname']." ".$user->parent['lastname']; ?></td>
                  <td>
                    <?php    
                  if ($user->active==1) {
                    echo "<p class='active__status'>Active<p>";
                  }
                  else if ($user->active==0) { 
                    echo "<p class='not__active__status'>Not active<p>";
                  }
                  ?>
                 </td>
                 <td class='table__flex'>
                  <?php   
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $user->id], ['class'=>'btn change__user','escape' => false]);
                 echo  $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $user->id], ['class'=>'btn  delete__user','escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $user->firstname." ".$user->lastname)]);  
                  ?>
                  </td>
                  </tr>
             <?php  endforeach; ?>
                
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
          <h2 style="text-align: center;">Do you want to delete users ?</h2>
           
                   <button class="close_modal_form close__modal" >No</button>
                   <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'subusers','action' => 'deletesubus'
           )])  ?>
                   <div class="delete_form_checked_inputs"> </div>
                   <?=  $this->Form->submit('Yes ',['class'=>'btn  btn-dangeres save__changes__form__playlist','style'=>'margin-top:0px;margin-left:auto;margin-right:auto;']); ?>
                  
                   <?=   $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>
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
  });


<?php echo $this->Html->scriptEnd(); ?>
</script>