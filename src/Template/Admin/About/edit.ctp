    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
             <h1 class="blog__title"><?=   __('Main block'); ?></h1>
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="text-align: right;">
          <div class="box-header">
            <div class="create__new__user">
             
            </div>
              
</div>

       <?= $this->Form->create($about,['url'   => array(
               'controller' => 'about','action' => 'edit'
           ), 'type' => 'file'])  ?>

       <div class="marque__box">
          <p>:Current image </p>
          <?php echo $this->Html->image("/img/about/".$about['image'], ['label'=>'true','style'=>'width:100px;height:100px;', 'alt' => __('User Image')]); ?> 
          <br>
          <br>
                    <div id="fotosViewMeal">
          </div>
          <?= $this->Form->control('image', ['type' => 'file', 'class' => 'form-control loadsfiles', 'label' => false, 'required' => false, 'div' => false, 'style' => '', 'id' => 'fileimgMeal']); ?>
          <br>
          <?=  $this->Form->textarea('name',array('label' => 'Title','class'=>'form-control','min'=>6));?>
          <?=  $this->Form->submit('Save ',['class'=>'btn  btn-primary save__changes__form__playlist']); ?>
       </div>
               

         <?= $this->Form->end()  ?>










<div class="marquee__container">

<!--
<?php   

foreach ($playlists as $key => $value) {

    foreach ($value->media as $key => $values) {
      echo  $this->Html->link('
     <div class="marquee_image">
       <img src="/'.$values->file.'" alt="">
     </div>
     <div class="marquee_bottom">
       <p class="marquee_bottom_title" style="color: red;">'.$value->name.'</p>
       <p class="marquee_bottom_time">40 h</p>
     </div>
  ', ['action' => 'edit', $value->id], ['class'=>'btn  marquee__item','escape' => false]);  
      
      break;

    }
  
}


 ?> -->
 </div>
             </div>
             
          </div>
       
        </div>
      </div>
    </section>

        <script>
      <?php echo $this->Html->scriptStart(['block' => true]); ?>

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
                    dataView = '<div class="thumbnail imgNew" id="imgNew" style="position:relative;width: 160px;">';
                    dataView += '<p>:New image </p>';
                    dataView += '<div id="img-list">';
                    dataView += '<img id="imgMain" class="img-circle" src="' + e.target.result + '" style="width: 150px;border-radius:0px;"/>';
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