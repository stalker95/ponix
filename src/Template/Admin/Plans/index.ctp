    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <h1 class="blog__title">New Plans</h1>
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
          <div class="box-header">
            <div class="create__new__user">
              <div class="delete_form_checked">
                <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist" style="display: none;margin-top: 0px;
    background: #ffeaef;
    margin-top: 0px;
    color: red;
    padding: 6px 30px;"  data-toggle="modal" data-target="#mediaGallery" >
                     Delete
                   </button>
              </div>
                   

              
            </div>
            </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th><input type="checkbox" id="delete-all"></th>
                  <th>User</th>
                  <th>Old plan</th>
                  <th>New plan</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
           
                <?php  foreach ($plans as $plan): ?>
                <tr>
                 <td><input type='checkbox' value="<?= $user->id ?>" class='delete_item'></td>
                  <td><?= $plan->user['firstname']." ".$plan->user['lastname'] ?></td>
                  <td><?= $plan->user->program['title'];     ?></td>
                  <td><?= $plan->program['title'] ?></td>
                  
                  <td><?php if($plan['status']==0): echo "New"; endif;  ?></td>
                  <td class='table__flex'>
                 <?php  
                 echo $this->Html->link('Confirm', ['action' => 'confirm', $plan->user['id'],$plan->id,$plan->program['id']], ['class'=>'btn  change__user','escape' => false]);  
                  echo   $this->Html->link('Cancel', ['action' => 'cancel', $plan->user['id'],$plan->id,$plan->program['id']], ['class'=>'btn  delete__user','escape' => false]); 
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
       
      </div>
      <div class="modal-body">
        <div class="gallery-box form__inline" style="text-align: center;">
          <h2 style="text-align: center;">Do you want to delete users ?</h2>
         
                   <button class="close_modal_form close__modal" >No</button>
                    <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'employee','action' => 'deletechecked'
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
 
<?php echo $this->Html->scriptEnd(); ?>
</script>