    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Logos </h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
            
            </div>
              
</div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  
                  <th>ID</th>
                  <th>Image</th>
                  <th>Location</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($logos as $logo) {
                  echo "<tr>
                  <td>".$logo->id."</td>";
                  echo "<td>"; 
                   echo $this->Html->image("logos/".$logo['image'], ['label'=>'true','style'=>'width: 100px; border-radius:0px;', 'alt' => __('User Image')]);
                  echo "</td>";
                  echo "<td>".$logo->location."</td>";
                
                echo " <td class='table__flex'>";
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $logo->id], ['class'=>'btn change__user','escape' => false]);
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
  
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Logos </h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
            
            </div>
              
</div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  
                  <th>ID</th>
                  <th>Image</th>
                  <th>Location</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
           
                <?php   foreach ($logos_player as $logo) {
                  echo "<tr>
                  <td>".$logo->id."</td>";
                  echo "<td>"; 
                   echo $this->Html->image("logos/".$logo['image'], ['label'=>'true','style'=>'width: 100px; border-radius:0px;', 'alt' => __('User Image')]);
                  echo "</td>";
                  echo "<td>".$logo->location."</td>";
                
                echo " <td class='table__flex'>";
                 echo   $this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $logo->id], ['class'=>'btn change__user','escape' => false]);
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