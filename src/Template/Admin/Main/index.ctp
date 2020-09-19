    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Top Block</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($main_block as $item) : ?>
                 <tr>
                  <td><?=  $this->Html->image('/img/home-top-bg/' . $item->image, ['class' => 'img-circle', 'style' => 'width: 100px; border-radius:0px;', 'fullBase' => true]); ?>
                  </td>
                  <td><?= $item->name ?></td>
                 <td class='table__flex'>
               <?php    echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'topBlock','action' => 'edit', $item->id], ['class'=>'btn change__user','escape' => false]);
                  echo "</td>";
                  echo "</tr>";
                  ?>
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

   <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">About</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($about as $item) : ?>
                 <tr>
                  <td><?=  $this->Html->image('/img/about/' . $item->image, ['class' => 'img-circle', 'style' => 'width: 100px; border-radius:0px;', 'fullBase' => true]); ?>
                  </td>
                  <td><?= $item->title ?></td>
                  <td><?= $item->description ?></td>
                 <td class='table__flex'>
               <?php    echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'about','action' => 'edit', $item->id], ['class'=>'btn change__user','escape' => false]);
                  echo "</td>";
                  echo "</tr>";
                  ?>
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

     <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Solution</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Link</th>
                  <th>URL</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($solution as $item) : ?>
                  <tr>
                  <td><?=  $this->Html->image('/img/home-top-bg/' . $item->image, ['class' => 'img-circle', 'style' => 'width: 100px; border-radius:0px;', 'fullBase' => true]); ?>
                  </td>
                  <td><?= $item->title ?></td>
                  
                  <td><?= $item->link ?></td>
                   <td><?= $item->url ?></td>
                 <td class='table__flex'>
               <?php    echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'solution','action' => 'edit', $item->id], ['class'=>'btn change__user','escape' => false]);
                  echo "</td>";
                  echo "</tr>";
                
                endforeach; ?>
                
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
          <h1 class="blog__title">Advertisings</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
           </div>
              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($advertisingsMain as $item) : ?>
                  <tr>
                  <td><?=  $this->Html->image('/img/advertising_main/' . $item->image, ['class' => 'img-circle', 'style' => 'width: 100px; border-radius:0px;', 'fullBase' => true]); ?>
                  </td>
                  <td><?= $item->name ?></td>
                  
                  <td><?= $item->description ?></td>
                   
                 <td class='table__flex'>
               <?php    echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'advertisings_main','action' => 'edit', $item->id], ['class'=>'btn change__user','escape' => false]); ?>
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
        <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Statistic</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            
              
           </div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>

                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php   foreach ($statistics as $statistic) : ?>
                  <tr>
                  <td><?= $statistic->title;  ?></td>
                  <td><?= $statistic->description;  ?></td>
                  <td><?=  $this->Html->image('/img/statistics/' . $statistic->image, ['class' => 'img-circle', 'style' => 'width: 100px; border-radius:0px;', 'fullBase' => true]); ?>
                  </td>

                 <td class='table__flex'>
               <?php    echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'statistics','action' => 'edit', $statistic->id], ['class'=>'btn change__user','escape' => false]); ?>

                 </td>
                  </tr>
               <?php endforeach;  ?>
                
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
              <?php   echo  $this->Html->link('Add new',['controller'=>'programs','action'=>'add'],['class'=>'btn btn-primary create__new__user']); ?>
            </div>
              
           </div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Title under price</th>
                  <th>Description</th>
                  <th>Text button</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($programs as $program) : ?>
                  <tr>
                  <td><?= $program->title;  ?></td>
                  <td><?= $program->price;  ?></td>
                  <td><?= $program->title_two;  ?></td>
                  <td><?= $program->description;  ?></td>
                  <td><?= $program->button_text;  ?></td>
                 <td class='table__flex'>
               <?php    echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=>'programs','action' => 'edit', $program->id], ['class'=>'btn change__user','escape' => false]); ?>

               <?php    echo   $this->Html->link('<i class="fa fa-trash"></i>', ['controller'=>'programs','action' => 'delete', $program->id], ['class'=>'btn delete__user','escape' => false]); ?>
                 </td>
                  </tr>
               <?php endforeach;  ?>
                
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