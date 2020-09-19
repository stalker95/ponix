          <!-- general form elements disabled -->
     <div class="container">
       <div class="row">
         <h3 class="box-title"><?= __('Edit data') ?></h3>
       </div>
     </div>
              

           
            	


<div class="playlist__managment">
  <div class="">
    <div class="row">
      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
          <?php echo debug($Playlist->playlists__media); ?>
            <?php foreach ($Playlist->playlists__media as  $value) {
             echo $value->media."<br>";
             
            } ?>
            <?= __('Playlist information') ?>
          </p>
     <?= $this->Form->create($Playlist)  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Name</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('name',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>
      <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Categories</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('Categories.0.category_id',array('class'=>'form-control','required'=>'required')); ?>
    </div>
  </div>
</div>        
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Theme</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <select name="" id="" class="form-control">
        <?php    if (!empty($Playlist->categories)): 
                                 foreach ($Playlist->categories as $category):
           echo "<option value=".$category->id.">".$category->name."</option>" ;      
         endforeach;
                           endif;
         ?>
        
        <?php   foreach ($categories as $category) {
          echo "<option value=".$category->id.">".$category->name."</option>" ;
        } ?>
        <option value=""></option>
      </select>
    </div>
  </div>
</div>
<!--<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Attach to</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="list--users">
    <div class="playlist--item--sub">
      <p class="playlist--item--sub--name">Test Test</p>
      <div class="playlist--item--sub--delete">
        <i class="fa fa-times"></i>
      </div>
    </div>
     <div class="playlist--item--sub">
      <p class="playlist--item--sub--name">Test Test</p>
      <div class="playlist--item--sub--delete">
        <i class="fa fa-times"></i>
      </div>
    </div>
     <div class="playlist--item--sub">
      <p class="playlist--item--sub--name">Test Test</p>
      <div class="playlist--item--sub--delete">
        <i class="fa fa-times"></i>
      </div>
    </div>
    <div class="playlist--item--sub">
      <p class="playlist--item--sub--name">Test Test</p>
      <div class="playlist--item--sub--delete">
        <i class="fa fa-times"></i>
      </div>
    </div>
    <div class="playlist--item--sub">
      <p class="playlist--item--sub--name">Test Test</p>
      <div class="playlist--item--sub--delete">
        <i class="fa fa-times"></i>
      </div>
    </div>
     <div class="playlist--item--sub">
      <p class="playlist--item--sub--name">Test Test</p>
      <div class="playlist--item--sub--delete">
        <i class="fa fa-times"></i>
      </div>
    </div>
    </div>
  </div>
</div> -->
    
<?=  $this->Form->submit('Save ',['class'=>'btn  btn-primary save__changes__form__playlist']); ?>
     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="playlist__managment__item play__list__static">
          <div class="play__list__static__top">
            <p class="playlist__managment__item__title">
            Playlist 
          </p>
          <div class="play__list__static__top__right">
            <a  class="play__list__static--edit"  data-toggle="modal" data-target="#exampleModal">Edit</a>

            <a href="#" class="play__list__static--delete">Delete</a>
          </div>
          </div>
          <div class="play__list__static__description">
            <p>PlayList name: <span class="play__list__static__description--bold">Greens and flowers</span></p>
            <p>Duration: <span class="play__list__static__description--bold">40 h</span></p>
            <p>Numbers of videos: <span class="play__list__static__description--bold">50</span></p>
            <p>Amount of users: <span class="play__list__static__description--bold">8</span></p>
            <p>City: <span class="play__list__static__description--bold">Kfasaba</span></p>
            <p>Region: <span class="play__list__static__description--bold">Ha'sharon</span></p>
          </div>
          <div class="play__list__static__preview">
            <img src="/uploads/files/1556277300Nuu0n8xz-y0.jpg" alt="" class="play__list__static__preview__main">
            <div class="play__list__static__preview--bottom">
              <p class="play__list__static__preview--bottom--title" style="color: red;">Playlist: Greens and flowers</p>
              <p class="play__list__static__preview--bottom--timing"><span><i class="fa fa-clock"></i></span>40 h</p>
            </div>
          </div>
        </div>
      </div>  
</div>
<div class="row">
   <div class="col-md-6">
        <div class="playlist__managment__item">
          <!-- AREA CHART -->
          <div class=" ">
            <div class="box-header">
              <h3 class="box-title">Plays</h3>

             
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="revenue-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>  
      <div class="col-md-6">
        <div class="playlist__managment__item">
          
        </div>
      </div>
</div>
     
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body sorter">
        <div id="auction-images" class="playlists images  no-desc">
           <div class="sorter">
                        <div class="images ">
                          </div>
                        <br style="clear: both;">
                    </div>
          
          
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<?php $this->Html->script('admin/raphael/raphael.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/chart.js/Chart.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/morris.js/morris.js', ['block' => 'scriptBottom']); ?>

 <?php $this->Html->script('admin/jquery-ui/jquery-ui.min.js', ['block' => 'scriptBottom']); ?>
 <?php $this->Html->script('admin/jquery.iframe-transport.js', ['block' => 'scriptBottom']); ?>
 <?php $this->Html->script('admin/jquery.galleryManager_playlist.js', ['block' => 'scriptBottom']); ?>

<script>
<?php echo $this->Html->scriptStart(['block' => true]); ?>


 $(function(){
        $('#auction-images').galleryManager(
            {"is_sold":false,
            "hasName":true,
            "hasData":true,
            "hasTime":true,
            "hasDesc":false,
          "uploadUrl":"http:\/\/omry\/admin\/media\/add/",
          "deleteUrl":"http:\/\/omry\/admin\/media\/delete",
          "updateUrl":"http:\/\/omry\/admin\/media\/edit/",
          "arrangeUrl":"http:\/\/omry\/admin\/playlist\/rename/",
          "nameLabel":"Name",
          "descriptionLabel":"Description",
          "photos":[
           <?php foreach ($Playlist->playlists__media as  $value) : ?>
             {
           "id": 1,
           "name":"<?php echo $value->_joinData->name; ?>",
           "description":"rthtyj",
           "rank": "<?php echo $value->_joinData->rank; ?>",
           "data": "<?php echo $value->media->created; ?>",
           "time": "1"+" h",
           "preview":"<?php echo $value->media->file; ?>"
          },
             
           <?php endforeach; ?>
          
        
             ]});
    });
    // AREA CHART
    var area = new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666 },
        {y: '2011 Q2', item1: 2778 },
        {y: '2011 Q3', item1: 4912 },
        {y: '2011 Q4', item1: 3767},
        {y: '2012 Q1', item1: 6810},
        {y: '2012 Q2', item1: 5670},
        {y: '2012 Q3', item1: 4820},
        {y: '2012 Q4', item1: 15073},
        {y: '2013 Q1', item1: 10687},
        {y: '2013 Q2', item1: 8432}
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1', ],
      lineColors: ['#a0d0e0'],
      hideHover: 'auto'
    });




    <?php echo $this->Html->scriptEnd(); ?>
</script>