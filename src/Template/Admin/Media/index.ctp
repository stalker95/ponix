<?= $this->Html->css('admin/galleryManager.css') ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Media library</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Actions">
                            <i class="fa fa-wrench"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">                            
                            <li><a href="/admin/auctions/edit/5c7d2644e848a7362628d133">Edit</a></li>
                            <li><a href="/admin/auctions/view/5c7d2644e848a7362628d133">View</a></li>
                            <li><a href="/admin/auctions/edit-sale-info/5c7d2644e848a7362628d133">Edit sale info</a></li>
                            <li><a href="/admin/auctions/view/5c7d2644e848a7362628d133">Back to auction</a></li>
                            <li class="divider"></li>
                            <li><a href="/admin/auctions">Back to list</a></li>
                            <li class="divider"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div id="auction-images" class="gallery-manager no-desc">
                    <div style="margin-top: 13px;float: right;margin-right: 13px;">
                        
                    </div>
                    <div class="btn-toolbar" style="padding:4px">
                        <?php   if ($_user->allow_write): ?>
                        <div class="btn-group" style="display: inline-block;">
                             <a href="<?= $this->Url->build(['action' => 'uploadpicture', '_full' => true]) ?>"  class="btn btn-success btn-file" style="margin-right: 10px;"><i class="glyphicon glyphicon-plus"></i> Upload pictures</a>
                        <a href="<?= $this->Url->build(['action' => 'uploadvideo', '_full' => true]) ?>" class="btn btn-success btn-file"><i class="glyphicon glyphicon-plus"></i> Upload video</a> 
                        <a href="<?= $this->Url->build(['action' => 'uploadaudio', '_full' => true]) ?>" style="margin-left: 10px;" class="btn btn-success btn-file"><i class="glyphicon glyphicon-plus"></i> Upload audios</a> 
                        </div>
                    <?php endif; ?>
                        <div class="btn-group" style="display: inline-block;">
                             <?php   if ($user->is_abs()): ?>
                            <label class="btn btn-default" style="margin-right: 10px;">
                             <input type="checkbox" style="margin-right: 4px; margin-left: 10px; margin-top: 1px;" class="select_all"><span  style="margin-top: 5px;">Select all</span>
                            </label>
                             <?php  endif; ?>
                            <!--
                            <div class="btn btn-default disabled edit_selected">
                                <i class="glyphicon glyphicon-pencil"></i> Edit                            </div> -->
                               
                            <div class="btn btn-default disabled remove_selected" data-toggle="false" data-target="#mediaGallery">
                                <i class="glyphicon glyphicon-remove"></i> Delete</div>
                           
                        </div>
                    </div>

                    <hr>
                    <div id="upload-block-preview" style="display: none;">
                        <div class="upload-block-preview__left">
                            <p>Video</p>
                           <video  controls id="video-block"  src='' >
                             <source src=''>
                           </video>
                         </div>
                    <div class="upload-block-preview__right">
                        <p>Preview</p>
                     <div class="upload-block" id="" data-id="" >
                      <canvas id="video-canvas" style="display:none;"></canvas>
                      <img width="352px" src="" id="thumb-img"/>
                      <div class="btn-group btn-group-video float-right margin-bottom-10">
                       <a class="btn btn-link text-primary" id="btn-updatePreview" style="display: none;">Update Preview</a>
                      </div>
                    </div>
                    <button class="btn btn-primary" id="save__video">Save video</button>
                    </div>
                      

                    </div>

                    <div class="sorter">
                        <div class="images ">
                        	</div>
                        <br style="clear: both;">
                    </div>

                    <!-- Modal window to edit photo information -->
                    <div class="editor-modal modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a class="close" data-dismiss="modal">×</a>

                                    <h3 class="modal-title">Edit information</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="form"></div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-primary save-changes">
                                        Save changes                                    </a>
                                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overlay">
                        <div class="overlay-bg">&nbsp;</div>
                        <div class="drop-hint">
                            <span class="drop-hint-info">Drop Files Here…</span>
                        </div>
                    </div>
                    <div class="progress-overlay">
                        <div class="overlay-bg">&nbsp;</div>
                        <!-- Upload Progress Modal-->
                        <div class="modal progress-modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Uploading images…</h3>
                                    </div>
                                    <div class="modal-body">
                                        <div class="progress ">
                                            <div class="progress-bar progress-bar-info progress-bar-striped active upload-progress" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mediaGallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabels" data-item=""><?= __('') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p class="media__title__delete">
           Are you sure you want to delete media files ?
       </p>
       <div class="media__title__delete--buttons">
                   <button class="close__modal cancel_button" >No</button>
           <button class="delete_all_media" style="margin-right: 10px;">Yes</button>
       </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mediaGallerys" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabels" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabels" data-item=""><?= __('') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p class="media__title__delete">
           Are you sure you want to delete media files ?
       </p>
       <div class="media__title__delete--buttons">
                   <button class="close__modal cancel_button">No</button>
           <button class="delete_media" style="margin-right: 10px;">Yes</button>
       </div>
      </div>
    </div>
  </div>
</div>

        <?php $this->Html->script('admin/jquery-ui/jquery-ui.min.js', ['block' => 'scriptBottom']); ?>
                <?php $this->Html->script('admin/jquery.iframe-transport.js', ['block' => 'scriptBottom']); ?>
    <?php $this->Html->script('admin/jquery.galleryManager.js', ['block' => 'scriptBottom']); ?>
    <script>
    	<?php echo $this->Html->scriptStart(['block' => true]); ?>
     $(function(){
        $('#auction-images').galleryManager(
            {
                "is_sold":false,
                "hasName":true,
                "hasDesc":false,
                "allow_read": '<?= $_user->allow_read ?>',
                "allow_write": '<?= $_user->allow_write ?>',
                "allow_edit": '<?= $_user->allow_edit ?>',
                "allow_delete": '<?= $_user->allow_delete ?>',
                "is_abs": '<?php if ($user->is_abs()){echo "1";}else {echo "0";}  ?>',
                "user_id": '<?= $_user->id;  ?>',
                "can_delete": '<?php if ($user->is_abs()){echo "1";}else {echo "0";}  ?>',
            	"uploadUrl": "<?= $this->Url->build(['action' => 'add', '_full' => true]) ?>",
            	"deleteUrl": "<?= $this->Url->build(['action' => 'delete', '_full' => true]) ?>",
            	"updateUrl": "<?= $this->url->build(['action' => 'edit', '_full' => true]) ?>/",
            	"arrangeUrl": "<?= $this->Url->build(['action' => 'rename', '_full' => true]) ?>/",
            	"nameLabel": "Name",
            	"descriptionLabel": "Description",
            	"photos": <?= json_encode(array_map(function($m){ return ['id' => $m['id'], 'name' => $m['name'], 'description' => '', 'rank' => 0, 'preview' => $m['file'], 'type' => $m['type'], 'file' => $m['file'],'user_id' => $m['user_id']]; }, $medias->toArray())) ?>
            }
        );
    });


// Get handles on the video and canvas elements
        //var video = document.querySelector('video');
                var video = document.getElementById("video-block");//document.querySelector('video');
        var canvas = document.querySelector('canvas');
        // Get a handle on the 2d context of the canvas element
        var context = canvas.getContext('2d');
        // Define some vars required later
        var w, h, ratio;
        
        // Add a listener to wait for the 'loadedmetadata' state so the video's dimensions can be read
        video.addEventListener('loadedmetadata', function() {
            // Calculate the ratio of the video's width to height
            ratio = video.videoWidth / video.videoHeight;
            // Define the required width as 100 pixels smaller than the actual video's width
            w = video.clientWidth; //video.videoWidth - 190;
            // Calculate the height based on the video's width and the ratio
            h = parseInt(w / ratio, 10);
            // Set the canvas width and height to the values just calculated
            canvas.width = w;
            canvas.height = h;     
               setTimeout(function() {snap();},1000);     
        }, false);
        
        // Takes a snapshot of the video
        function snap() {
            // Define the size of the rectangle that will be filled (basically the entire element)
            context.fillRect(0, 0, w, h);
            // Grab the image from the video
            context.drawImage(video, 0, 0, w, h);
                        to_image();
        }
                
             function to_image(){
                var canvas = document.getElementById("video-canvas");
                var new_image=canvas.toDataURL();
                $("#preview").attr("value",new_image);
                document.getElementById("thumb-img").src = canvas.toDataURL();
                
                //Canvas2Image.saveAsPNG(canvas);
                var d = new Date();
            /*$.ajax({
                type: "POST",
                url: "/admin/media/savePicture/",
                data: {
                    thumb: $("#thumb-img").prop('src'),
                },
                success: function (response) {
                   
                    if (response.success == false) {
                        alert(response.error.message);
                        return false;
                    }
                },
                error() {
                    console.log($("#thumb-img").prop('src'));
                }
            }); */
}
$("#video-files").change(function() {
   var reader = new FileReader();
   $("#upload-block-preview").css("display",'flex');
    reader.onload = function (e) {
     
      $('#video-block')
        .attr('src', e.target.result)
        .width(300)
        .height(200);
            
    };
    reader.readAsDataURL($(this).get(0).files[0]);
   setTimeout(function() {
    snap();
},3000);
});

$("#save__video").click(function() {
    $("#btn-load-video").trigger("click");
});

     
    	<?php echo $this->Html->scriptEnd(); ?>
    </script>