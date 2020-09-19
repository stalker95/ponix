 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1 class="blog__title">Users Permitions</h1>
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
           <div class="box-header">
            <div class="create__new__user">
               <?= $this->Form->create('CancelAll',['url'   => array(
               'controller' => 'usersPermitions','action' => 'cancelAll'),'class'=>'delete_form_checked ','style'=>'display:none;'])  ?>
                   <div class="delete_form_checked_inputs">  </div>
                   <?=  $this->Form->submit('Cancel all ',['class'=>'btn  btn-dangeres save__changes__form__playlist']); ?>
     <?=   $this->Form->end() ?>

     <?= $this->Form->create('ConfirmAll',['url'   => array(
               'controller' => 'usersPermitions','action' => 'confirmAll'),'class'=>'delete_form_checked_confirm delete_form_checked','style'=>'display:none;'])  ?>
                   <div class="delete_form_checked_inputs">  </div>
                   <?=  $this->Form->submit('Confirm all ',['class'=>'btn   delete__user']); ?>
     <?=   $this->Form->end() ?>

            </div>
              
           </div>

              <table class="table table-bordered table-striped" id="example1">
                 <thead>
                <tr>
                  <th><input type="checkbox" id="delete-all"></th>
                  <th>User</th>
                  <th>Name Permition</th>
                  <th>New value</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php   foreach ($usersPermitions as $list) : ?>
                  <tr>
                    <td><input type='checkbox' value="<?php echo $list->id;   ?>" class='delete_item'></td>
                    <td><?php echo $list->user['firstname']." ".$list->user['lastname'] ?></td>
                    <td><?php echo $list->name_permition ?></td>
                    <td><?php if  ($list->new_value==1) {echo "true";} else { echo "false";} ?></td>
                    <td class='table__flex'>
                 <?php  
                 echo $this->Html->link('Confirm', ['action' => 'confirm', $list->id,$list->user['id']], ['class'=>'btn  change__user','escape' => false]);  
                  echo   $this->Html->link('Cancel', ['action' => 'cancel', $list->id,$list->user['id']], ['class'=>'btn  delete__user','escape' => false]); 
                    ?>
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
  
<div class="modal fade" id="mediaGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabels" ><?= __('Please select a file to fill out the ABS playlist') ?></h5>
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

 <?php $this->Html->script('admin/jquery-ui/jquery-ui.min.js', ['block' => 'scriptBottom']); ?>
 <?php $this->Html->script('admin/jquery.iframe-transport.js', ['block' => 'scriptBottom']); ?>
 <?php $this->Html->script('admin/jquery.galleryManager_playlist.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('pagination.min.js', ['block' => 'scriptBottom']) ?>

<script>
<?php echo $this->Html->scriptStart(['block' => true]); ?>



    




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
          dataSource: '<?= $this->Url->build(['controller' => 'absMedia', 'action' => 'search', '_full' => true]) ?>',
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
            
            
            /*console.log(mass_media); */
            $.ajax({
             url: "<?= $this->url->build(['controller' => 'absMedia', 'action' => 'insertMediaInABSPlaylist']) ?>",
             data: {
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
  .modal-content{
    padding: 9px 33px;
    border-radius: 9px;
  }
</style>
