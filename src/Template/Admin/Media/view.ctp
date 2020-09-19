          <!-- general form elements disabled -->
<div class="container">
  <div class="row">
    <h1 class="blog__title"><?= __('Media files manager') ?></h1>
  </div>
</div>
<div class="playlist__managment">
  <div class="">
    <div class="row">
           <?= $this->Form->create($media,['type' => 'file'])  ?>
            <div class="col-md-6">
        <div class="playlist__managment__item play__list__static">
          <div class="play__list__static__top">
            <p class="playlist__managment__item__title">
            Media File  
          </p>
          </div>
          <div class="play__list__static__description">
            <p>User : <span class="play__list__static__description--bold"><?= $media[0]->Users->firstname." ".$media[0]->Users->lastname  ?></span></p>
          <!--  <p>Time upload : <span class="play__list__static__description--bold">40 h</span></p> -->
            
          </div>
          <div class="play__list__static__preview">
            <?php if($media[0]->type=="image"): ?>
            <?= $this->Html->image('/uploads/files/' . $media[0]->name, ['fullBase' => true,'class'=>'play__list__static__preview__main']); ?>

          <?php elseif($media[0]->type=="video"): ?>
                          <p>Current preview</p>
            <?= $this->Html->image('/uploads/files/' . $media[0]->name, ['fullBase' => true,'class'=>'play__list__static__preview__main']); ?>
            <p>New preview</p>
             <?= $this->Form->control('imgPhoto', ['type' => 'file', 'class' => 'form-control loadsfiles', 'label' => false, 'required' => false, 'div' => false, 'style' => '', 'id' => 'fileimgMeal']); ?>
             <div id="fotosViewMeal">
          </div>
          <br>
             <p>Video</p>
            <video src="<?php echo $baseUrl ?>uploads/files/<?php echo $media[0]->file; ?>"  controls></video>
          <?php endif; ?>
            
          </div>
        </div>
      </div> 
      <div class="col-md-6">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
            <?= __('Media information') ?>
          </p>
<?php if ($user->is_abs()): ?>
   <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Choose playlists</p>
  </div>
 
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">

      
      <?php if ($media[0]->playlist==null):   ?>
       <?=  $this->Form->control('other_playlists',array('class'=>'form-control','options' => $other_playlists,'type'=>'select','multiple'=>'multiple')); ?>
      <?php   endif; ?>
    </div>
  </div>
</div>        

<?php endif; ?>

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Description</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
     <?=  $this->Form->control('Media.0.description',array('class'=>'form-control','required'=>'required','type'=>'textarea')); ?>
    </div>
  </div>
</div>
<?php if ($user->is_abs()): ?>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Playlists</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
         <div class="list--users">
          <?php  foreach ($find_media_playlist as $key => $value) : ?>
            <div class="playlist--item--sub playlist_id" id="<?= $value['Playlists']['id'] ?>">
      <p class="playlist--item--sub--name"><?= $value['Playlists']['name'] ?></p>
      <div class="playlist--item--sub--delete--playlist"  data-item="<?= $value['Playlists']['id'] ?>" data-media="<?= $media[0]->id ?>">
        <i class="fa fa-times"></i>
      </div>
    </div>
     
    <?php  endforeach; ?>
    
    </div>
     
    </div>
  </div>
</div>
<?php  endif; ?>

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Tags</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
         <div class="list--users">
          <?php  foreach ($media[0]->tags as $key => $value) : ?>
            <div class="playlist--item--sub" id="<?= $value['id'] ?>">
      <p class="playlist--item--sub--name"><?= $value['name'] ?></p>
      <div class="playlist--item--sub--delete"  data-item="<?= $value['id'] ?>" data-playlist="<?= $media[0]->id ?>">
        <i class="fa fa-times"></i>
      </div>
    </div>
     
    <?php  endforeach; ?>
    <div class="playlist--item--add--tags" id="load_popup_tags" data-toggle="modal" data-target="#mediaGallery">
      <i class="fa fa-times" style="font-size: 20px;"></i>
    </div>
    </div>
     
    </div>
  </div>
</div>
    








<?=  $this->Form->submit('Save ',['class'=>'btn  btn-primary save__changes__form__playlist']); ?>
     <?=   $this->Form->end() ?>
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

<div class="modal fade" id="mediaGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabels" data-item="<?= $media[0]->id; ?>"><?= __('Please select a tag to fill out the playlist') ?></h5>
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
                <th><?= __('Tag name') ?></th>
               
                <th>
                  <input type="text" class="form-control" id="media-file-name" placeholder="<?= __('Name Tag') ?>">
                </th>
                <th>

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



function load_media() {
      var box = $('#mediaGallery .gallery-box'),
        dataContainer = box.find('.data-container').first(),
        keyTimeOut = 0;
      $("#media-select-all").on('change', function () {
        $(".media-item-checkbox").prop('checked', this.checked);
      });
      box.pagination({
          dataSource: '<?= $this->Url->build(['controller' => 'tags', 'action' => 'search', '_full' => true]) ?>',
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
                media_id: <?= $media[0]->id; ?>,
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
                          '<td>'+data[i].name+'</td>' 
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

   var mass_media = new Array();
   var mass = new Array();
   $(document).on("click",".media-item-checkbox", function() {
       var value=$(this).attr("value");
       mass.push(value);
       mass_media = unique(mass);
       console.log(mass_media);

});
   $("#load_popup_tags").click(function() {
       load_media();
   });

 $(document).on("click","#btn-add-media-to-playlist", function() {
            
            var media_id=$("#exampleModalLabels").attr("data-item");
            var tag_id=0;
 
            /*console.log(mass_media); */
            $.ajax({
             url: "<?= $this->url->build(['controller' => 'media', 'action' => 'insertTagsInMedia']) ?>",
             data: {
              tag_ids: mass_media,
              media_id: media_id
             } ,
             success: function(data) {
             /* console.log(data); */
             mass_media = [];
              $(document).find('.media-item-checkbox').prop('checked',false);
             }
             });
            load_media();
    });

 $(".playlist--item--sub--delete").click(function() {
 var media_id=$(this).attr("data-item");
 var tag_id=$(this).attr("data-playlist");
             $.ajax({
             url: "<?= $this->url->build(['controller' => 'media', 'action' => 'deleteTagsMedia']) ?>",
             data: {
              tag_id: tag_id,
              media_id: media_id
             },
             success: function(data) {
               $("#"+media_id).css("display","none");
             }
             });
});

 $(".playlist--item--sub--delete--playlist").click(function() {
 var media_id=$(this).attr("data-media");
 var playlist_id=$(this).attr("data-item");
             $.ajax({
             url: "<?= $this->url->build(['controller' => 'playlist', 'action' => 'deleteMediaFromPlaylist']) ?>",
             data: {
              media_id: media_id,
              playlist_id: playlist_id
             },
             success: function(data) {
               $(".playlist_id#"+playlist_id).css("display","none");
             }
             });
});

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

});



        $(document).ready(function () {
     
        initOptionImg();
           });
    function initOptionImg() {


// for add new image in color
        $("#blockAddImgMeal").off();
        $("#blockAddImgMeal").on("click", function () {
            $("#fileimgMeal").click();
        });

        $("#fileimgMeal").off();
        $("#fileimgMeal").change(function () {
            readURL(this);
        });

        $('.deleteImg').off();
        $('.deleteImg').on('click', function () {
            inp = $("#fileimgMeal");
            inp.replaceWith(inp.val('').clone(true));
            $('#imgNew').remove();
            $("#blockAddImgMeal").show();
            $("#imgMainProfile").attr('src', $("#imgMainProfile").attr('data-src'));
        });

    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

                var dataURL = e.target.result;
                var mimeType = dataURL.split(",")[0].split(":")[1].split(";")[0];

                if ((mimeType != 'image/jpeg') && (mimeType != 'image/jpg') && (mimeType != 'image/png')) {
                    // not support format
                    inp = $("#fileimgMeal");
                    inp.replaceWith(inp.val('').clone(true));
                    alert("Type file not suported \nOnly PNG or JPEG/JPG");
                } else { //suport format
                    dataView = '<div class="thumbnail imgNew" id="imgNew" style="position:relative;">';
                    dataView += '<div id="img-list">';
                    dataView += '<img id="imgMain" class="img-circle" src="' + e.target.result + '" style="width: 100%;border-radius:0px;"/>';
                    dataView += '<div class="deleteImgBack"></div>';
                    dataView += '<div class="deleteImg" id="delView"></div>';
                    dataView += '</div>';
                    dataView += '</div>';
                    $("#fotosViewMeal").html(dataView);
                    $("#blockAddImgMeal").hide();
                    $("#imgMainProfile").attr('src', e.target.result);
                    //main_img = e.target.result;
                    initOptionImg();

                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    <?php echo $this->Html->scriptEnd(); ?>
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
    top: 0vh;
    right: -2vw;
    color: #FFF;
    /* background: #C6C6C6; */
    opacity: 0.5;
  }
  .modal-dialog{
    width: 100%;
    max-width: 800px;
  }
  .modal-content{
    padding: 9px 33px;
    border-radius: 9px;
  }
</style>
