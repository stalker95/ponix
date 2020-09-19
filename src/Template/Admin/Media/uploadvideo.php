          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Upload picture</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <?= $this->Form->create($media, ['type'=>'file']); ?>
<?=  $this->Form->control('Users',array('label' => 'Users','class'=>'form-control','options' => $users,'required'=>'required','multiple'=>'multiple')); ?>
<?=  $this->Form->control('file',array('type'=>'file','id'=>'video-files','label' => 'Choose file','class'=>'form-control','required'=>'required')); ?>
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
<?=  $this->Form->control('Categories',array('label' => 'Categories','options' => $categories,'class'=>'form-control','required'=>'required','empty'=>'Choose category')); ?>
<?=  $this->Form->control('description',array('label' => 'Description','class'=>'form-control','required'=>'required','multiple'=>'multiple')); ?>

 <?=  $this->Form->control('thumb', ['style'=>'display:none;','id'=>'preview']); ?>
<?=  $this->Form->control('tags._ids', ['options' => $tags,'label' => 'Tags','class'=>'form-control','required'=>'required','multiple'=>'multiple']); ?>
<?=  $this->Form->submit('Upload file',['class'=>'btn  btn-primary save__changes__form']); ?>
<?=   $this->Form->end() ?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
              <script>
      <?php echo $this->Html->scriptStart(['block' => true]); ?>
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