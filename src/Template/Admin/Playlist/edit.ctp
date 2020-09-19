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
            <?= __('Playlist information') ?>
          </p>
     <?= $this->Form->create($Playlist)  ?>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Name</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('Playlist.0.name',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Categories</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <br>
     <br>
      <?=  $this->Form->control('Playlist.0.Categories',array('class'=>'form-control','required'=>'required','default'=>'sdfsdf')); ?>
    </div>
  </div>
</div>  

 

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Themes</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('Playlist.0.Themes',array('class'=>'form-control','required'=>'required')); ?>
    </div>
  </div>
</div>  

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>City</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('Playlist.0.city',array('class'=>'form-control')); ?>
    </div>
  </div>
</div>     

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Region</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('Playlist.0.region',array('class'=>'form-control')); ?>
    </div>
  </div>
</div>  

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
            <?php if ($_user->allow_write): ?>
             <a  class="play__list__static--edit"  data-toggle="modal" data-target="#mediaGallery"><?= __('Add') ?></a>
            <?php endif; ?>
            <a  class="play__list__static--edit"  data-toggle="modal" data-target="#exampleModal">Edit</a>
            <!-- <a href="#" class="play__list__static--delete">Delete</a> -->
          </div>
          </div>
          <div class="play__list__static__description">
            
            <p>PlayList name: <span class="play__list__static__description--bold"><?= $Playlist[0]->name ?></span></p>
            <p>Duration: <span class="play__list__static__description--bold">40 h</span></p>
            <p>Numbers of videos: <span class="play__list__static__description--bold"><?= $count ?></span></p>
            <p>City: <span class="play__list__static__description--bold"><?= $Playlist[0]->city ?></span></p>
            <p>Region: <span class="play__list__static__description--bold"><?= $Playlist[0]->region ?></span></p>
          </div>
          <div class="play__list__static__preview">
            <img src="<?= $baseUrl; ?>/uploads/files/<?= $Playlist[0]->Media['name'] ?>" alt="" class="play__list__static__preview__main">
            <div class="play__list__static__preview--bottom">
              <p class="play__list__static__preview--bottom--title" style="color: red;">Playlist: <?= $Playlist[0]->name ?></p>
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

<div class="modal fade" id="mediaGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabels" data-item="<?= $Playlist[0]->id ?>"><?= __('Please select a file to fill out the playlist') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="gallery-box">
          <!-- <div class="data-container"></div> -->
          <table class="table">
            <thead>
              <tr>
                <th>
                  <input type="checkbox" id="media-select-all">
                </th>
                <th><?= __('Media file') ?></th>
                <th>
                  <select class="form-control" id="media-file-type">
                    <option value=""><?= __('Type of file') ?></option>
                    <option value="png">png</option>
                    <option value="jpg">jpg</option>
                    <option value="mp4">mp4</option>
                  </select>
                </th>
                <th>
                  <input type="text" class="form-control" id="media-file-name" placeholder="<?= __('File name') ?>">
                </th>
                <th>
                  <input type="text" class="form-control" id="media-category-name" placeholder="<?= __('Category') ?>">
                </th>
              </tr>
            </thead>
            <tbody class="data-container"></tbody>
          </table>
        </div>
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
<?php $this->Html->script('pagination.min.js', ['block' => 'scriptBottom']) ?>

<script>
<?php echo $this->Html->scriptStart(['block' => true]); ?>


 $(function(){
        $('#auction-images').galleryManager(
            {"is_sold":false,
            "hasName":true,
            "hasData":true,
            "hasTime":true,
            "hasDesc":false,
            "role": '<?= $_user->is_admin ?>',
            "baseurl": '<?php echo $baseUrl; ?>',
            "allow_read": '<?= $_user->allow_read ?>',
            "allow_write": '<?= $_user->allow_write ?>',
            "allow_edit": '<?= $_user->allow_edit ?>',
            "allow_delete": '<?= $_user->allow_delete ?>',
            "uploadUrl": "<?= $this->Url->build(['action' => 'add', '_full' => true]) ?>",
              "deleteUrl": "<?= $this->Url->build(['action' => 'delete_media', '_full' => true]) ?>",
              "updateUrl": "<?= $this->url->build(['action' => 'edit', '_full' => true]) ?>/",
              "arrangeUrl": "<?= $this->Url->build(['action' => 'rename', '_full' => true]) ?>/",
          "nameLabel":"Name",
          "descriptionLabel":"Description",
          "photos":[
           <?php foreach ($Playlist as $key =>  $value) : ?>
             {
           "id": "<?php echo $value->media; ?>",
           "name":"<?php echo $value->Media['name']; ?>",
           "description":"rthtyj",
           "rank": "<?php echo $value->rank; ?>",
           "data": "<?php echo $value->Media['created']; ?>",
           "time": "1"+" h",
           "preview":"<?php echo $value->Media['file']; ?>",
           "is_admin":"<?php echo $value->is_abs; ?>",
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

<script>
  <?php echo $this->Html->scriptStart(['block' => true]); ?>
function load_media() {
      var box = $('#mediaGallery .gallery-box'),
        dataContainer = box.find('.data-container').first(),
        keyTimeOut = 0;
      $("#media-select-all").on('change', function () {
        $(".media-item-checkbox").prop('checked', this.checked);
      });
      box.pagination({
          dataSource: '<?= $this->Url->build(['controller' => 'media', 'action' => 'search', '_full' => true]) ?>',
          locator: 'result',
          totalNumberLocator: function(response) {
              return response.nbRows;
          },
          showNavigator: true,
          formatNavigator: '<button  id="btn-add-media-to-playlist"   class="ajax-insert"><?= __('Add') ?></button>',
          pageSize: 5,
          afterInit: function (el) {
            // console.log(el);
            // $("#btn-add-media-to-playlist").on('click', function (e) {

            // });
            $('#media-file-type').on('change', function (e) {
              box.pagination('go', 1);
            });
            $("#media-file-name, #media-category-name").on('keyup', function (e) {
              // e.keyCode =
              if (keyTimeOut) {
                clearTimeout(keyTimeOut);
              }
              keyTimeOut = setTimeout(function(){ box.pagination('go', 1); }, 500);
            });
          },
          prevText: '<span>&laquo;</span>',
          nextText: '<span>&raquo;</span>',
          ajax: function () {
            return {
              type: 'post',
              data: {
                fileName: document.getElementById('media-file-name').value,
                fileType: document.getElementById('media-file-type').value,
                categoryName: document.getElementById('media-category-name').value,
                playlistid: <?= $Playlist[0]->id ?>,
                exclude: []
              },
              beforeSend: function() {
                  dataContainer.html('<tr><td colspan="5"><?= __('Loading data ...') ?></td></tr>');
              }
            };
          },
          callback: function(data, pagination) {
            console.log('data', data);
            console.log('pagination', pagination);
            var html = '';
            if (data.length > 0) {
              for (var i=0; i<data.length; i++) {
                html += '<tr>' +
                          '<td>' +
                            '<input class="media-item-checkbox" type="checkbox" value="'+ data[i].id +'" />' +
                          '</td>' +
                          '<td><img class="media-preview" src="'+baseUrl+"uploads/files/"+data[i].name+'"/></td>' +
                          '<td>'+data[i].extension+'.</td>' +
                          '<td>' + data[i].name + '</td>' +
                          '<td>' + data[i].category   + '</td>' +
                      '</tr>';
              }
            } else {
              html = '<tr><td colspan="5"><?= __('Media data not found.') ?></td></tr>';
            }
            // console.log(html);
            dataContainer.html(html);
          }
      });
    }
          
$(document).ready(function() {
  var mass_media= new Array();
  var mass = new Array();
   $(document).on("click",".media-item-checkbox", function() {
       var value=$(this).attr("value");
       mass.push(value);
       mass_media = unique(mass);
       console.log(mass_media);
       checkMedia();
  });
   
   $(".play__list__static--edit").click(function() {
load_media();
   });

 $(document).on("click","#btn-add-media-to-playlist", function() {
            
            var id=$("#exampleModalLabels").attr("data-item");
            
            /*console.log(mass_media); */
            $.ajax({
             url: "<?= $this->url->build(['controller' => 'playlist', 'action' => 'insertMediaInPlaylist']) ?>",
             data: {
              id: id,
              media: mass_media
             } ,
             success: function(data) {
             /* console.log(data); */
             mass_media = [];
              $(document).find('.media-item-checkbox').prop('checked',false);
              checkMedia();
             }
             });
            load_media();
    });

 function unique(arr) {
  var result = [];

  nextInput:
    for (var i = 0; i < arr.length; i++) {
      var str = arr[i]; // для каждого элемента
      for (var j = 0; j < result.length; j++) { // ищем, был ли он уже?
        if (result[j] == str) continue nextInput; // если да, то следующий
      }
      result.push(str);
    }

  return result;
}

function checkMedia() {
 if($('.media-item-checkbox').is(':checked')) {
    $("#btn-add-media-to-playlist").prop('disabled',false);
 } 
 else {
  $("#btn-add-media-to-playlist").prop('disabled',true);
 }
}

$("#media-select-all").click(function() {
  if($(this).is(':checked')) {
      $(".media-item-checkbox").each(function() {
    var value=$(this).attr("value");
    mass.push(value);
    mass_media = unique(mass);
    console.log(mass_media);
    $(document).find('.media-item-checkbox').prop('checked',true);
  });
}
  else {
 $("#btn-add-media-to-playlist").prop('disabled',false);
    $(".media-item-checkbox").prop('disabled',false);
    mass = [];
    mass_media = [];
}
});

$(".playlist-item").eq(0).addClass("fixed");
   });
  <?php echo $this->Html->scriptEnd() ?>
</script>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style type="text/css">
  .gallery-box {
    font-family: 'Roboto', sans-serif;
    color: #868E96;
  }
  .gallery-box table {
    direction: rtl;
  }
  .gallery-box th {
    font-weight: normal;
    font-size: 12px;
    white-space: nowrap;
        vertical-align: middle !important;
        color: #566182;
  }
  .gallery-box th, .gallery-box td {
    text-align: right;
  }
  .gallery-box .paginationjs {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .gallery-box .paginationjs-pages {
    order: 2;
  }
  .gallery-box .paginationjs-pages ul {
    list-style: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0;
  }
  .gallery-box .paginationjs-pages ul li {
    background: #E6F2FF;
    border-radius: 5px;
    padding: 5px 9px;
    margin-left: 7px;
    line-height: 1.0;
    color: #007BFF;
  }
  .gallery-box .paginationjs-pages ul li.active {
    color: #FFF;
    background: #007BFF;
  }
  .gallery-box .paginationjs-pages ul li a {
    color: inherit;
    font-size: 13px;
    line-height: 15px;
    font-family: inherit;
  }
  .gallery-box .paginationjs-pages ul li a span {
    font-size: 18px;
    line-height: 1.0;
  }
  .gallery-box .media-preview {
    max-width: 45px;
    max-height: 45px;
  }
  .gallery-box .form-control{
    background: #FFFFFF;
    border: 1px solid #BECAD6;
    box-sizing: border-box;
    border-radius: 8px;
    color: #566182;
    font-weight: 500;
    font-size: 12px;
    line-height: 14px;
  }
  .gallery-box select.form-control {
        border: none;
      -webkit-appearance: none;
      background: url(http://softsprint.pp.ua/omry-tv/img/arrow_drop_down.png) 95%/13% no-repeat transparent;
      padding-right: 15px;
          background-size: 9%;
              padding-left: 0px;
    min-width: 85px;
  }
  #btn-add-media-to-playlist {
    background: #E3FFF1;
    border-radius: 5px;
    padding: 13px 48px 9px 48px;
    font-family: Helvetica;
    font-size: 13px;
    border: none;
    line-height: 16px;/* identical to box height, or 123% */
    letter-spacing: -0.408571px;
    display: inline-block;
    color: #17C671;
    font-weight: bold;
  }
  #btn-add-media-to-playlist:hover,
  #btn-add-media-to-playlist:focus,
  #btn-add-media-to-playlist:active {
    text-decoration: none;
  }
  #mediaGallery .modal-title {
    font-family: Helvetica;
    font-size: 18px;
    line-height: 22px;/* identical to box height, or 122% */
    letter-spacing: -0.45004px;
    text-align: right;
    color: #3D5170;
  }
  #mediaGallery .modal-header .close {
    position: absolute;
    top: -5vh;
    right: -2vw;
    color: #FFF;
    /* background: #C6C6C6; */
    opacity: 0.5;
  }
  .modal-dialog{
    width: 100%;
    max-width: 800px;
  }
  .modal-content {
    padding: 9px 33px;
    border-radius: 9px;
  }
</style>
