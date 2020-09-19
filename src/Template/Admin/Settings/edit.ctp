 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
     <?= $this->Form->create($settingssa, ['type' => 'file'])  ?>
     <div class="products_container_top">
       <p class="products_container_title">Загальні налаштування</p>
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
                      <div class="products_add_tabs">
              <div class="products_add_tabs_item active_add_tabs_item">
                <p>Загальна інформація</p>
              </div>
              <div class="products_add_tabs_item">
                <p>Контатні данні</p>
              </div>
              <div class="products_add_tabs_item">
                <p>Переваги</p>
              </div>
            </div>
                      <div class="products_container">
            <div class="product_container_item" style="display: block;">
                   <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Найменування </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('name',array('label' => false,'class'=>'form-control','min'=>6,'type'=>'text'));?>
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


                  <div id="fotosViewMeal" style="position: relative;flex-basis: 300px;object-fit: contain;" class="image_gallery_preview">
                    <img  style="object-fit: contain;" src="<?= $this->Url->build('/settings/'.$settings->logo, ['fullBase' => true]) ?>" alt="">
                  </div>  
                  <div class="right_buttons">
                    
                 
                   <label for="fileimgMeal"  class="choose_file_settings choose_file_pencil" style="display:block!important;"><i class="fa fa-pencil"></i></label>
                   </div>
                  </div>
                </div>
            </div>
        </div>

                <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Favicon</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub" style="display: block;">
                 <div class="choose_image_block">
                  <?=  $this->Form->control('favicon',array('label' => 'First Name','type'=>'file','class'=>' form-control upload_gallery_item','required'=>'false','style'=>'font-size: 1em;padding:0px;width:300px;opacity:0;display:none;','id'=>'fileimgMeal2'));?>  


                  <div id="fotosViewMeal" style="position: relative;flex-basis: 300px;" class="image_gallery_preview">
                    <img src="<?= $this->Url->build('/settings/'.$settings->favicon, ['fullBase' => true]) ?>" alt="">
                  </div>  
                  <div class="right_buttons">
                    
                 
                   <label for="fileimgMeal2"  class="choose_file_settings choose_file_pencil" style="display:block!important;"><i class="fa fa-pencil"></i></label>
                   </div>
                  </div>
                  </div>
            </div>
        </div>

</div>
</div>

 
<div class="product_container_item">
  <div class="settings_container_flex">
  <div class="settings_container_column">
      <div class="settings_container_item">
        <span class="settings_container_item_title">Контактні данні</span>
      

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Email </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('email',array('label' => false,'class'=>'form-control','min'=>6));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
    <p>Адреса </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('address',array('label' => false,'class'=>'form-control','min'=>6, 'type' => 'text'));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
    <p>Адреса LAT</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('adress_lat',array('label' => false,'class'=>'form-control','min'=>6, 'type' => 'text'));?>
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
    <p>Адреса LNG</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('adress_lng',array('label' => false,'class'=>'form-control','min'=>6, 'type' => 'text'));?>
    </div>
  </div>
</div>

<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Графік роботи </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('time',array('label' => false,'class'=>'form-control','min'=>6, 'type' => 'text'));?>
    </div>
  </div>
</div>


      </div>

            <div class="settings_container_item">
        <span class="settings_container_item_title">Соціальні мережі</span>

        <?php foreach ($socialsa as $key => $value): ?>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p><?= $value['name'] ?></p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
       <input type="text" name="social_name[]" value="<?= $value['name']  ?>" class="form-control" style="display: none;">
      <input type="text" name="social_value[]" value="<?= $value['url']  ?>" class="form-control">
    </div>
  </div>
      </div>
  <?php endforeach; ?>

  </div>
   </div>

   <div class="settings_container_column">
           <div class="settings_container_item settings_container_item_phones">
        <span class="settings_container_item_title">Телефони</span>
        <div class="settings_container_item_phones_container">
                <?php foreach ($phones as $key => $value): ?>
                  <?php if (!empty($value)): ?>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Номер</p>
     <input type="text" name="phones_numbers[]" value="<?= $value  ?>" class="form-control">
  </div>
  <div class="playlist__managment--item__right">
     <button type="button" class="btn btn-danger delete_phone"><i class="fa fa-trash"></i></button>
  </div>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
  </div>

  <div class="playlist__managment--item new_phone_record">
  <div class="playlist__managment--item__left">
    <p style="opacity: 0;">s</p>
    <input type="text" name="phones_numbers[]" class="form-control">
  </div>
  <div class="playlist__managment--item__right">
     <button type="button" class="btn btn-primary add_new_record"><i class="fa fa-plus"></i></button>
  </div>
      </div>

      </div>
   </div>

</div>

        </div>
  <div class="product_container_item">

    <?php foreach ($advantages as $key => $value): ?>
    <div class="col-md-6">

      <div class="advanteges_item">
        <p>Перевага 1</p>
        <input type="hidden" name="advantages_hidden[]" value="<?= $value['id'] ?>">
        <textarea name="advantages_name[]" id="" ><?= $value['title'] ?></textarea>
      </div>
      
    </div>
    <div class="col-md-6">
      <div class="advanteges_item">
        <p>SVG іконка</p>
        <textarea name="advantages_svg[]" id="" ><?= $value['svg'] ?></textarea>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
      </div>
    </div>
         <?=   $this->Form->end() ?>
      </div>

</div>

  
<script>
        $(document).ready(function () {
 $("body").on("click",'.delete_phone', function() {
            
           $(this).parent().parent().remove();
  
          });

          $(".add_new_record").click(function() {
            $(".settings_container_item_phones_container").append('<div class="playlist__managment--item">'+
  '<div class="playlist__managment--item__left">'+
    '<p>Номер</p>'+
     '<input type="text" name="phones_numbers[]" value="<?= $value  ?>" class="form-control">'+
  '</div>'+
  '<div class="playlist__managment--item__right">'+
     '<button type="button" class="btn btn-danger delete_phone"><i class="fa fa-trash"></i></button>'+
  '</div>'+
      '</div>');
          });

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
            inp = $("#fileimgMeal");
            inp.replaceWith(inp.val('').clone(true));
            $('#imgNew').remove();
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

                if ((mimeType != 'image/jpeg') && (mimeType != 'image/jpg') && (mimeType != 'image/png') && (mimeType != 'image/x-icon')) {
                    // not support format
                    inp = $("#fileimgMeal");
                    inp.replaceWith(inp.val('').clone(true));
                    alert("Type file not suported \nOnly PNG or JPEG/JPG");
                } else { //suport format
                    dataView = '<div class="thumbnail imgNew" id="imgNew" style="width: 300px;text-align:center;">';
                    dataView += '<div id="img-list">';
                    dataView += '<img id="imgMain" class="img-circle" src="' + e.target.result + '" style="width: 300px;height:200px;object-fit:cover;border-radius:0px;"/>';
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