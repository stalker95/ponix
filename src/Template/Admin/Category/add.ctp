<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
        <?= $this->Form->create($category,['type' => 'file']); ?>

     <div class="products_container_top">
       <p class="products_container_title">Додавання категорії</p>
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
                <p>Seo</p>
              </div>
               <div class="products_add_tabs_item">
                <p>Зображення</p>
              </div>

            </div>
                      <div class="products_container">
            <div class="product_container_item" style="display: block;">
               <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Ім'я </p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('name',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Батьківська категорія</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <select name="parent_id" id="" class="form-control">
      <option value="0">Без категорії</option>
      <?php foreach ($categories as $key => $value): ?>
        <option value="<?= $value['id'] ?>"> <?= $value['name']; ?></option>
      <?php endforeach; ?>
    </select>

    </div>
  </div>
</div>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Позиція</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('position',array('type'=>'text','label' => 'First Name','class'=>'form-control'));?>      
    </div>
  </div>
</div>
<div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Опис</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('desription',array('type'=>'textarea','label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
            </div>

            <div class="product_container_item">
            <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Slug</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('slug',array('label' => 'First Name','type'=>'text','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('title',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>   
 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Title H1</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('title_h1',array('label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>

       <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Description page</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('description_page',array('type'=>'textarea','label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>
 <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Keywords</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
    <?=  $this->Form->control('keywords',array('type'=>'textarea','label' => 'First Name','class'=>'form-control','required'=>'required'));?>

    </div>
  </div>
</div>


            </div>
            <div class="product_container_item">
        <div class="playlist__managment--item">
  <div class="playlist__managment--item__left">
    <p>Image</p>
  </div>
  <div class="playlist__managment--item__right">
    <div class="playlist--item--sub">
      <?=  $this->Form->control('image',array('type'=>'textarea','label' => 'First Name','class'=>'form-control'));?>      
    </div>
  </div>
</div>

 <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Головне зображення</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub" style="display: block;">
                  <?=  $this->Form->control('picture',array('label' => 'First Name','type'=>'file','class'=>' form-control ','style'=>'font-size: 1em;padding:0px;width:200px;','id'=>'fileimgMeal'));?>  
                  <div id="fotosViewMeal" style="position: relative;width: 100%;" class="image_gallery_preview"></div>  
                  </div>
            </div>      
            </div>
          </div>
      


        </div>
     <?=   $this->Form->end() ?>
        </div>
      </div>
      <div class="col-md-6">

      </div>  
</div>

</section>

<?php $this->Html->script('admin/jquery.dataTables.min.js', ['block' => 'scriptBottom']); ?>
<?php $this->Html->script('admin/dataTables.bootstrap.min.js', ['block' => 'scriptBottom']); ?>
<script>
<?php echo $this->Html->scriptStart(['block' => true]); ?>
 $(document).ready(function() {
    $('.js-example-basic-single').select2();
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
<?php echo $this->Html->scriptEnd(); ?>
