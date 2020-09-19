 <section class="content white_background products_container">
  <div class="row">
   <div class="col-xs-12">
            <?= $this->Form->create($blog,['type' => 'file']); ?>
     <div class="products_container_top">
       <p class="products_container_title">Редагування блога</p>
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
                    <p>Заголовок</p>
                  </div>
                  <div class="playlist__managment--item__right">
                    <div class="playlist--item--sub">
                        <?=  $this->Form->control('title', array('label' => 'Назва','type'=>'text','class'=>'form-control','required'=>'required'));?>
                    </div>
                  </div>
                </div>
				<div class="playlist__managment--item">
  					<div class="playlist__managment--item__left">
    					<p>Slug</p>
  					</div>
  					<div class="playlist__managment--item__right">
    					<div class="playlist--item--sub">
      						<?=  $this->Form->control('slug', array('label' => 'Slug','type'=>'text','class'=>'form-control','required'=>'required'));?>    
    					</div>
  					</div>
				</div>
                 <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Категорія</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('category_id',array('label' => 'Категорія','type'=>'select','min'=>0,'class'=>'form-control', 'options'=>$category_id, 'required'=>'required','empty'=>'Виберіть катгорію','id'=>'choose_category'));?>    
              </div>
            </div>
        </div>
        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Title сторінки </p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('title_page', array('label' => 'Ціна','type'=>'text','min'=>0,'class'=>'form-control','required'=>'required'));?>    
              </div>
            </div>
        </div>
             
        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Ключові слова</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('keywords',array('label' => 'First Name','type'=>'textarea','class'=>'form-control','required'=>'required'));?>    
              </div>
            </div>
        </div>

         <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Description</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('description',array('label' => 'First Name','type'=>'textarea','class'=>'form-control','required'=>'required'));?>    
              </div>
            </div>
        </div>
        
				<div class="playlist__managment--item">
  					<div class="playlist__managment--item__left">
    					<p>Головне зображення</p>
  					</div>
  					<div class="playlist__managment--item__right">
    					<div class="playlist--item--sub">
      						<?=  $this->Form->control('image',array('label' => 'First Name','type'=>'file','class'=>'input-file-trigger form-control upload_gallery_item input-file-trigger','value'=>$blog->image,'style'=>'font-size: 1em;padding:0px;width:200px;','id'=>'fileimgMeal'));?>    
    					
    					
              </div>
              <div id="fotosViewMeal" class="image_gallery_preview" style="position: relative;width: 200px;">
                <img src="<?= $this->Url->build('/blogs/'.$blog->image.'', ['fullBase' => true]) ?>" alt="" id="imgNew">
                <div class="deleteImg" id="delView"></div>
              </div>
  					</div>
				</div>
				<div class="playlist__managment--item">
  					<div class="playlist__managment--item__left">
    					<p>Текст</p>
  					</div>
  					<div class="playlist__managment--item__right">
    					<div class="playlist--item--sub">
     					 	<?=  $this->Form->control('text',array('label' => 'First Name','type'=>'textarea','class'=>'form-control','id' => 'editor1','required'=>'required'));?>    
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
                    dataView = '<div class="thumbnail imgNew" id="imgNew" style="width: 200px;text-align:center;">';
                    dataView += '<div id="img-list">';
                    dataView += '<img id="imgMain" class="img-circle" src="' + e.target.result + '" style="width: 100%;height:253px;object-fit:cover;border-radius:0px;"/>';
                    dataView += '<div class="deleteImgBack" style="display:none;"></div>';
                    dataView += '<div class="deleteImg" id="delView"></div>';
                    dataView += '</div>';
                    dataView += '</div>';
                    $(element).parent().parent().parent().find('.image_gallery_preview').html(dataView);
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
</script>