    <div class="row">
      <div class="col-md-5">  </div>
      <div class="col-md-7">
        <div class="playlist__managment__item">
          <p class="playlist__managment__item__title">
         
            
            <?= __('Upload audio') ?>
          </p>
    <?= $this->Form->create($media, ['url'   => array(
               'controller' => 'media','action' => 'uploadfile'),'type'=>'file']); ?>
     <?php    if ($user->is_abs()): ?>
       <?=  $this->Form->control('Users',array('label' => 'Users','class'=>'form-control','options' => $users,'multiple'=>'multiple')); ?>
      <?php   endif; ?>
<?=  $this->Form->control('file',array('type'=>'file','accept'=>'audio/mpeg,audio/x-wav,audio/mpeg','id'=>'video-files','label' => 'Choose file','class'=>'form-control','required'=>'required')); ?>

<?=  $this->Form->control('Categories',array('label' => 'Categories','options' => $categories,'class'=>'form-control','required'=>'required','empty'=>'Choose category')); ?>
<?=  $this->Form->control('description',array('label' => 'Description','type'=>'textarea','class'=>'form-control','multiple'=>'multiple')); ?>
<?=  $this->Form->control('tags._ids', ['options' => $tags,'label' => 'Tags','class'=>'form-control']); ?>
<?=  $this->Form->submit('Upload audio',['class'=>'btn  btn-primary save__changes__form']); ?>
<?=   $this->Form->end() ?>

            </div>
            <!-- /.box-body -->
          </div>
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



        

      <?php echo $this->Html->scriptEnd(); ?>
    </script>