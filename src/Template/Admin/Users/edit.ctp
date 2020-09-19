 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($_user,['type' => 'file'])  ?>
     <div class="products_container_top">
       <p class="products_container_title">Інформація  про клієнта</p>
       <div class="product_container_buttons">
         <button class="btn-primary" type="submit">
          <i class="fa fa-save"></i>
        </button>
         <div class="create__new__user">
            <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist copy_checked" data-toggle="modal" data-target="#mediaGallery" >
                     <i class="fa fa-copy"></i>
          </button>
           <button class="btn delete_form_checked  btn-dangeres save__changes__form__playlist" data-toggle="modal" data-target="#mediaGallery" >
                     <i class="fa fa-trash"></i>
          </button>
         </div>
         
       </div>
     </div>
        <div class="playlist__managment__item">
                <div class="playlist__managment--item">
                  <div class="playlist__managment--item__left">
                    <p>Firs name</p>
                  </div>
                  <div class="playlist__managment--item__right">
                    <div class="playlist--item--sub">
                        <?=  $this->Form->control('firstname',array('label' => 'First Name','type'=>'text','class'=>'form-control','required'=>'required'));?>
                    </div>
                  </div>
                </div>
                 <div class="playlist__managment--item">
                  <div class="playlist__managment--item__left">
                    <p>Last name</p>
                  </div>
                  <div class="playlist__managment--item__right">
                    <div class="playlist--item--sub">
                        <?=  $this->Form->control('lastname',array('label' => 'First Name','type'=>'text','class'=>'form-control','required'=>'required'));?>
                    </div>
                  </div>
                </div>
                 
                 <div class="playlist__managment--item">
                  <div class="playlist__managment--item__left">
                    <p>Реєстрація</p>
                  </div>
                  <div class="playlist__managment--item__right">
                    <div class="playlist--item--sub">
                        <?=  $this->Form->control('created',array('label' => 'First Name','type'=>'text','class'=>'form-control','required'=>'required'));?>
                    </div>
                  </div>
                </div>
                        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Логотип</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub" style="display: block;">
                  
                  <div class="choose_image_block">
                  <?=  $this->Form->control('image',array('label' => 'First Name','type'=>'file','class'=>' form-control ','required'=>'false','style'=>'font-size: 1em;padding:0px;width:300px;opacity:0;display:none;','id'=>'fileimgMeal'));?>  


                  <div id="fotosViewMeal" style="position: relative;flex-basis: 200px;object-fit: contain;" class="image_gallery_preview">
                    <?php   if (!empty($_user->avatar)): ?>
                        <img  style="object-fit: contain;" src="<?= $this->Url->build('/avatars/'.$_user->avatar, ['fullBase' => true]) ?>" alt="">
                    <?php   else: ?>
                       <img  style="object-fit: contain;" src="<?= $this->Url->build('/img/profile_default.png', ['fullBase' => true]) ?>" alt="">
                    <?php   endif; ?>
                  </div>  
                  <div class="right_buttons">
                    
                 
                   <label for="fileimgMeal"  class="choose_file_settings choose_file_pencil" style="display:block!important;"><i class="fa fa-pencil"></i></label>
                   </div>
                  </div>
                </div>
            </div>
        </div>
       
        </div>
        <?=   $this->Form->end() ?>
       </div>
    </div>
</div>


</section>
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script>
    $(document).ready(function () {
       CKEDITOR.replace( 'editor1');
    });
</script>

<script>
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
            readURL($(this), this);
        });

        $(".upload_gallery_item").change(function () {
            readURL($(this), this);
        });

        $('.deleteImg').off();
        $('.deleteImg').on('click', function () {
            inp = $(this).parent().parent().find("#fileimgMeal");
            inp.replaceWith(inp.val('').clone(true));
            $(this).parent().parent().find('.imgNew').remove();
            $("#blockAddImgMeal").show();
            $("#imgMainProfile").attr('src', $("#imgMainProfile").attr('data-src'));
        });

    }

    function readURL(element, input) {

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
                    dataView = '<div class="thumbnail imgNew" id="imgNew" style="width: 100%;text-align:center;">';
                    dataView += '<div id="img-list">';
                    dataView += '<img id="imgMain" class="img-circle" src="' + e.target.result + '" style="width: 100%;height:253px;object-fit:cover;border-radius:0px;"/>';
                    dataView += '<div class="deleteImgBack" style="display:none;"></div>';
                    dataView += '<div class="deleteImg" id="delView"></div>';
                    dataView += '</div>';
                    dataView += '</div>';
                    $(element).parent().parent().find('.image_gallery_preview').html(dataView);
                    $("#blockAddImgMeal").hide();
                    $(this).parent().find('.image_gallery_preview').attr('src', e.target.result);
                   // $("#imgMainProfile").attr('src', e.target.result);

                    //main_img = e.target.result;
                    initOptionImg();

                }
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});  

$("#choose_category").change(function() {

  var id_category = $(this).val();

  $.ajax({
    data: { "id_category": id_category},
      url: '<?= $this->Url->build(['controller' => 'products', 'action' => 'get-attributes', '_full' => true]) ?>',
      success: function(data){ 
        html = '';
        
        console.log(data);
        for (var i=0; i < data.result.length; i++) {
          html = html + '<div class="attributes_list_item">'+
                      '<p class="attributes_list_item_title">'+data.result[i]['Attributes']['name']+'</p>'+
                      '<input type="text" name="attributes_'+data.result[i]['Attributes']['id']+'">'+
                    '</div>';
        }
        $(".attributes_list").html(html);
      }
    });

})
</script>