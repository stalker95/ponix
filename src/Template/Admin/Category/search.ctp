    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Categories</h1>
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
               'controller' => 'category','action' => 'search'
                 )]);
                echo  $this->Form->control('name',array('label' => false,'class'=>'form-control','min'=>6));
                echo  $this->Form->end(); 
             ?>
               <p class="search-form-find-title">Categories</p>
            </div>
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
           
                <?php   foreach ($categories as $category) {
                  echo "<tr>
                  <td><input type='checkbox' value=".$category->id." class='delete_item'></td>
                  <td>".$category->id."</td>
                  <td>".$category->name."</td>
                  
                 <td class='table__flex'>";
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $category->id], ['class'=>'btn change__user','escape' => false]);
                  echo "<button class='btn  delete__user' data-toggle='modal' data-target='#mediaGallery_".$category->id."'><i class='fa fa-trash'></i></button>"; 
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

      <?php   foreach ($categories as $category): ?>

  <div class="modal fade" id="mediaGallery_<?= $category->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="gallery-box form__inline" style="text-align: center;">
          <h2 style="text-align: center;">Ви хочете видалити категорію <?= $category->title ?> ?</h2>
          <button class="close_modal_form close__modal" >Ні</button>
           <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'category','action' => 'delete/'.$category->id
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
          <h2 style="text-align: center;">Do you want to delete categories ?</h2>
         
                   <button class="close_modal_form close__modal" >No</button>
                    <?= $this->Form->create('Delete',['url'   => array(
               'controller' => 'category','action' => 'deletechecked'
           )])  ?>
                   <div class="delete_form_checked_inputs"> </div>
                   <?=  $this->Form->submit('Yes ',['class'=>'btn  btn-dangeres save__changes__form__playlist','style'=>'margin-top:0px;margin-left:auto;margin-right:auto;']); ?>
                  
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