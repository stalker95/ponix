       <div class="attributes_list attributes_list_parent" style="display: none;">
                          <?php  foreach ($attributes as $key => $value): ?>
                            <div class="attributes_list_item">
                              <p class="attributes_list_item_title"><?= $value['name']; ?></p>
                              <div class="attributes_list_item_list">
                                <?php foreach ($value['attributes_items'] as $key => $item): ?>
                                  <p class="attributes_list_item_list_item choose_attribute" data-attribute="<?= $item['id'] ?>" data-name="<?= $item['name'] ?>"> <?= $item['name']; ?></p>
                                <?php endforeach; ?>
                              </div>
                            </div>
                          <?php   endforeach; ?>
                        </div>
    <!-- Main content -->
    <section class="content white_background products_container">
                  <?= $this->Form->create($product,['type' => 'file']); ?>
    <div class="row">
      <div class="col-md-12">
<div class="products_container_top">
          <p class="products_container_title">Редагування товару</p>
          <div class="product_container_buttons">
         
        <a class="display_product" href="/products/<?= $product->slug  ?>" class="propose_slider_item_image" target="_blanck"
          >
          <i class="fa fa-eye"></i>
          </a>
        <button class="btn-primary">
          <i class="fa fa-save"></i>
        </button>
        <a class="redirect_back" href="<?= $this->Url->build(['controller' => 'products','action'=>'index']) ?>"><svg xmlns="http://www.w3.org/2000/svg" width="21.263" height="15" viewBox="0 0 25.263 20"><defs><style>.a{fill:#222d32;}</style></defs><g transform="translate(10 -56)"><path class="a" d="M89.257,113.908a11.925,11.925,0,0,0-3.2-8.928c-2.316-2.329-5.283-3.513-9.428-3.7V96L64,104.421l12.632,8.421v-5.25a13.279,13.279,0,0,1,5.7,1.316c2.033.908,3.638,2.895,4.987,5.039L88.586,116h.678C89.263,115.336,89.257,114.493,89.257,113.908Z" transform="translate(-74 -40)"/></g></svg></a>
       </div>
     </div>         <div class="playlist__managment__item">


            <div class="products_add_tabs">
              <div class="products_add_tabs_item active_add_tabs_item">
                <p>Загальна інформація</p>
              </div>
              <div class="products_add_tabs_item">
                <p>Данні</p>
              </div>
               <div class="products_add_tabs_item">
                <p>Звязки</p>
              </div>
              <div class="products_add_tabs_item">
                <p>Знижки</p>
              </div>
              <div class="products_add_tabs_item">
                <p>Атрибути</p>
              </div>
              <div class="products_add_tabs_item">
                <p>Опції</p>
              </div>
             
              <div class="products_add_tabs_item">
                <p>Фото та відео</p>
              </div>
            </div>
          <div class="products_container">
            <div class="product_container_item" style="display: block;">
              <div class="playlist__managment--item">
                  <div class="playlist__managment--item__left">
                    <p><span class="important">*</span>Найменування товару</p>
                  </div>
                  <div class="playlist__managment--item__right">
                    <div class="playlist--item--sub">
                        <?=  $this->Form->control('title',array('label' => 'Назва','type'=>'text','class'=>'form-control','required'=>'required'));?>
                    </div>
                  </div>
                </div>
                        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Опис</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                <?=  $this->Form->control('description',array('label' => 'First Name','type'=>'textarea','class'=>'form-control','id' => 'editor1'));?>    
              </div>
        </div>
        </div>  

        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p><span class="important">*</span>Slug</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('slug',array('label' => 'Slug','type'=>'text','class'=>'form-control','required'=>'required'));?>    
              </div>
            </div>
        </div>

        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>HTML тег title</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('title_page',array('label' => 'Заголовок сторінки','type'=>'text','class'=>'form-control'));?>    
              </div>
            </div>
        </div>

         <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>HTML тег description</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('page_description',array('label' => 'First Name','type'=>'textarea','class'=>'form-control'));?>    
              </div>
            </div>
        </div>      

          <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Ключові слова</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('keywords',array('label' => 'First Name','type'=>'textarea','class'=>'form-control'));?>    
              </div>
            </div>
        </div>

        

       
         
        

            </div>
                                    <div class="product_container_item" style="display: none;">

                           <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p><span class="important">*</span>Артикул (Код товару)</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('cod',array('label' => 'Кількість','type'=>'text','class'=>'form-control','required'=>'required'));?>    
              </div>
            </div>
        </div>

        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p><span class="important">*</span>Ціна</p>
            </div>
            <div class="playlist__managment--item__right currency_flex">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('price',array('label' => 'Ціна','type'=>'number','min'=>0,'class'=>'form-control'));?>    
              </div>
              <div class="choose_currency">
                <div class="choose_currency_title"><p>Виберіть валюту</p></div>

                <label for="first_currency">Гривня
                  <input type="radio" name="currency_id" class="change__currency" value="1" <?php if ($product['currency_id'] == 1){ ?> checked="checked" <?php } ?>>
                </label>
                <label for="first_currency">Євро
                  <input type="radio" name="currency_id" class="change__currency"  value="2"<?php if ($product->currency_id == 2){ ?> checked="checked"  <?php } ?>>
                </label>
                <label for="first_currency">Доллари
                  <input type="radio" name="currency_id" class="change__currency" value="3" <?php if ($product->currency_id == 3){ ?> checked="checked"    <?php } ?>>
                </label>
              </div>
            </div>
        </div>
         <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p><span class="important">*</span>Кількість</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('amount',array('label' => 'Кількість','type'=>'number','min'=>0,'class'=>'form-control','required'=>'required'));?>    
              </div>
            </div>
        </div>
        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Хіт продажу</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                 
                <?=  $this->Form->checkbox('hit',array('style' => "width:auto;")); ?>

              </div>
            </div>
        </div>

        <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Під замовлення</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                <?=  $this->Form->checkbox('in_orders',array('style' => "width:auto;")); ?>
              </div>
            </div>
        </div>

                        </div>
                                    <div class="product_container_item" style="display: none;">
 <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p><span class="important">*</span>Виберіть категорію </p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('category_id',array('label' => 'Категорія','type'=>'select','min'=>0,'class'=>'form-control', 'options'=>$category_id, 'required'=>'required','empty'=>'Виберіть катгорію','id'=>'choose_category'));?>    
              </div>
            </div>
        </div>
         <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p><span class="important">*</span>Виберіть виробника</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <?=  $this->Form->control('producer_id',array('label' => 'Категорія','type'=>'select','min'=>0,'class'=>'form-control', 'options'=>$producer_id, 'required'=>'required','empty'=>'Виберіть виробника','id'=>'choose_category'));?>    
              </div>
            </div>
        </div>
            </div>
                        <div class="product_container_item" style="display: none;">
               <div class="discounts_container">
                 <table>
                   <thead>
                     <th>Ціна, <span class="selected_currency">
                      <?php   if ($product->currency_id == 1): ?>
                                Гривні
                      <?php   endif; ?>
                      <?php   if ($product->currency_id == 2): ?>
                                Євро
                      <?php   endif; ?>
                      <?php   if ($product->currency_id == 3): ?>
                                Доллари
                      <?php   endif; ?>
                   </span></th>
                     <th>Початок знижки</th>
                     <th>Кінець знижки</th>
                     <th>Дія</th>
                   </thead>
                   <tbody>
                    <?php foreach ($discounts as $key => $value):?>
                    <tr>
                       <td><input type="number" name="discount_price[]" value="<?= $value['price'] ?>"></td>
                       <td> 
                        <div class="">
                          <div class='input-group date datetimepicker' >
                            <input type='text' class="" name="date_begin[]" required="required" value="<?php echo $value['start_data']->i18nFormat('YYY-MM-dd'); ?>" />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                      </td>
                       <td>
                        <div class="">
                          <div class='input-group date datetimepicker' >
                            <input type='text' class="" name="date_end[]" required="required" value="<?= $value['end_data']->i18nFormat('YYY-MM-dd'); ?>" />
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                      </td>
                       <td style="text-align: center;">
                        <button class="delete_discount">
                         <i class="fa fa-trash"></i>
                       </button>
                     </td>
                     </tr> 
                   <?php endforeach;  ?>
                   </tbody>
                 </table>
                 <div class="add_new_attribute_container">
                    <button class="add_new_discount btn-primary" type="button">
                      <i class="fa fa-plus"></i>
                    </button>
              </div>
               </div>
            </div>
            <div class="product_container_item">
                           <div class="attributes_products">
                <p class="attributes_products_title">Атрибути</p>
                <table class="attributes_table">
                  <thead>
                    <th>Атрибут</th>
                    <th>Значення</th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php foreach ($attributes_products as $key => $value): ?>
                      <tr>
                        <td style="width: 30%;position: relative;">
                        <input type="text" class="search_attribute" name="attribute" autocomplete="off" value="<?= $value['attributes_item']['name'] ?>">
                        <input type="text" class="search_attribute_id" name="attributes[]" style="display: none;" value="<?= $value['attribute_id'] ?>">
                        </td>
                        <td>
                          <input type="text" name="attributes_values[]" value="<?= $value['value']  ?>"></td>
                          <td style="text-align: center;">
                            <button class="delete_new_attribute btn-danger"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <div class="add_new_attribute_container">
                <button class="add_new_attribute btn-primary" type="button">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
              </div>
            </div>

             <div class="product_container_item">
                           <div class="product_options">
                <div class="product_options_left">
                  <div class="selected_options_products">
                    <?php foreach ($option_group as $key => $value): ?>
                      <?php if (!empty($value)) { ?>
                        <div class="selected_options_products_item ">
                      <button type="button" class="selected_options_delete_option"><i class="fa fa-minus"></i></button>
                      <p><?= $key ?></p>
                    </div>
                  <?php } ?>
                   <?php endforeach; ?>
                    
                  </div>
                  <div class="selected_options_products_add">
                    <select name="selected_option" id="selected_option" >
                      <option value="0" >Виберіть опцію</option>
                       <?php  foreach ($first_options as $key => $value): ?>

                        <option value="<?= $value['id'] ?>" data-option="<?= $value['id'] ?>" data-name="<?= $value['name'] ?>" ><?=  $value['name'] ?></option>
                        
                      <?php   endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="product_options_right">
                  <div class="product_options_right_list">

                   <?php foreach ($option_group as $key_parent => $value): ?>
                    <?php
                    if (!isset($value[0]['option_id'])) {
                      continue;
                    }
                     $id_option = $value[0]['option_id']; ?>

                      <div class="product_options_right_list_item" style="display: none;">
                        <p><?= $key_parent ?></p>
                        <table>
                          <thead>
                            <tr>
                              <th>Значення опції</th>
                              <th>Ціна</th>
                              <th>Дії</th>
                            </tr></thead>
                            <tbody>
                             <?php foreach ($value as $key => $item): ?>
                              <tr>
                                <td>
                                  <select name="options_item[]" id="" class="choose_option">
                                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                                    <? ?>
                                    
                                  </select></td>
                                  <td>
                                    <?php foreach ($item['products_options'] as $key => $item_value): ?>
                                      <?php if ($item_value['product_id'] == $id) { ?>
                                    <input type="number" name="amount_option[]" value="<?= $item_value['value'] ?>" step="0.01">

                                      <?php } ?>

                                    <?php endforeach; ?>
                                  </td>
                                  <td style="text-align: center;">
                                    <button class="delete_item_option" type="button">
                                      <i class="fa fa-trash"></i>
                                    </button>
                                  </td>
                                </tr>
                                                      <?php endforeach; ?>
                              </tbody>
                            </table>
                            <div style="text-align: right;">
                              <button class="add_new_edit" type="button" data-option="<?= $id_option; ?>"><i class="fa fa-plus"></i></button>
                            </div>
                          </div>
                      
                   <?php endforeach; ?>

                  </div>
                </div>
              </div>
            </div>

             

            <div class="product_container_item" style="display: none;">

              <div class="top_new_pictures">
                <div class="top_new_pictures_left">
                  <div id="fotosViewMeal" style="position: relative;width: 100%; min-height: 200px;" class="image_gallery_preview">
                     <img src="<?= $this->Url->build('/products/'.$product->image.'', ['fullBase' => true]) ?>" alt="" style="max-width: 500px;">
                  </div>  
                </div>
                <div class="top_new_pictures_right">
                  <div class="top_new_pictures_right_top">
                    <?=  $this->Form->control('image',array('label' => false,'type'=>'file','class'=>' form-control ','style'=>'font-size: 1em;padding:0px;width:200px;','id'=>'fileimgMeal'));?>  
                  </div>
                  <div class="top_new_pictures_right_bottom">
                    <p>Відеогляд</p>
                    <?=  $this->Form->control('video', array('label' => false,'type'=>'text','min'=>0,'class'=>'form-control'));?>   
                  </div>
                </div>
              </div>
                  <!--    <div class="playlist__managment--item">
            <div class="playlist__managment--item__left">
              <p>Головне зображення</p>
            </div>
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub" style="display: block;">
                  <?=  $this->Form->control('image',array('label' => 'First Name','type'=>'file','class'=>' form-control ','required'=>'required','style'=>'font-size: 1em;padding:0px;width:200px;','id'=>'fileimgMeal'));?>  
                  <div id="fotosViewMeal" style="position: relative;width: 33%;" class="image_gallery_preview"></div>  
                  </div>
            </div>
        </div> -->
                
        <div class="playlist__managment--item" style="display: block;">
            
            <div class="playlist__managment--item__right">
              <div class="playlist--item--sub">
                  <div class="input-file-container" style="display: block;">  
                    
                    <table class="products_add_table">
                      <thead>
                        <th>Галерея зображень</th>
                        <th>Позиція</th>
                        <th>Alt</th>
                        <th>Дії</th>
                      </thead>
                      <tbody>
                         <?php foreach ($products_gallery as $key => $value): ?>
                          <td>
                            <div class="input-file-container-item">
                               <?=  $this->Form->control('image_gallery[]',array('type'=>'file','label' =>'false','id'=>'file_'.$key.'','class'=>'upload_gallery_item form-control','style' => 'display:none;'));?> 
                                <label tabindex="0" for="file_<?= $key ?>" class="input-file-trigger"><i class="fa fa-close"> </i></label>
                                 <div class="image_gallery_preview">
                                  <?php   if(isset($products_gallery[$key]['name'])): ?>
                                    <div class="thumbnail imgNew" style="width: 100%;text-align:center;"> 
                                     <div id="img-list">
                                      <img src="<?= $this->Url->build('/products_gallery/'.$products_gallery[$key]['name'].'', ['fullBase' => true]) ?>" alt="" style="width: 100%;height:238px;object-fit:cover;border-radius:0px;">
                                     </div>
                                     <div class="deleteImg"> </div>
                                    </div>
                                  <?php endif; ?>
                                 </div>
                           </div>
                          </td>
                          <td class="products_add_table_padding">
                            <input type="number" name="position[]" value="<?= $value['position'] ?>">
                          </td>
                          <td class="products_add_table_padding">
                            <input type="text" name="alts[]" value="<?= $value['alt'] ?>">
                          </td>
                           <td class="products_add_table_padding">
                            <button type="button" class="delete_row btn-danger"><i class="fa fa-minus"></i></button>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                    

                  
                    <div class="add_new_attribute_container">
                   <button class="add_row_for_gallery btn-primary" type="button"><i class="fa fa-plus"></i></button>
                      
                    </div>
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
  
  var option_url = '<?= $this->Url->build(['controller' => 'options', 'action' => 'get-list-options', '_full' => true]) ?>';
  var attributes_url = '<?= $this->Url->build(['controller' => 'attributes', 'action' => 'get-list-attributes', '_full' => true]) ?>';
</script>
<?= $this->Html->script('admin/options.js?v=123'); ?>
<?= $this->Html->script('admin/attributes.js?v=123'); ?>
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
$('body').on('change', ".upload_gallery_item", function() {
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

          if ((mimeType != 'image/jpeg') && (mimeType != 'image/jpg') && (mimeType != 'image/png') && (mimeType != 'image/webp')) {

                    // not support format
                    inp = $("#fileimgMeal");
                    inp.replaceWith(inp.val('').clone(true));
                    alert("Type file not suported \nOnly PNG or JPEG/JPG");
                } else { //suport format
                    dataView = '<div class="thumbnail imgNew" id="imgNew" style="width: 100%;text-align:center;">';
                    dataView += '<div id="img-list">';
                    dataView += '<img id="imgMain" class="img-circle" src="' + e.target.result + '" style="width: 100%;height:213px;object-fit:cover;border-radius:0px;"/>';
                    dataView += '<div class="deleteImgBack" style="display:none;"></div>';
                    dataView += '<div class="deleteImg" id="delView"></div>';
                    dataView += '</div>';
                    dataView += '</div>';
                    $(element).parent().parent().parent().parent().find('.image_gallery_preview').html(dataView);
                    $("#blockAddImgMeal").hide();
                    $(this).parent().parent().parent().parent().find('.image_gallery_preview').attr('src', e.target.result);
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
      
/*button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  */


$(document).ready(function() {
$(".products_add_tabs_item").click(function() {
  $(".products_add_tabs_item").removeClass('active_add_tabs_item');
  var index = $(this).index();

  $(".product_container_item").css("display","none");
  $(".product_container_item").eq(index).css("display", "block");
 $(this).addClass("active_add_tabs_item")
});
 
 $("#selected_option").click(function() {
   $(".selected_options_products_list").css("display", "block");
 });

 $("#selected_option").on('blur', function(event) {
   
 });

var count = $(".products_add_table tbody tr").length;

$(".add_row_for_gallery").click(function() {
   count++;

  $(".products_add_table tbody").append('<tr>'+
                          '<td>'+
                            '<div class="input-file-container-item"><div><div><div>'+
                                '<input type="file" name="image_gallery[]" id="file_first_'+count+'" class="upload_gallery_item form-control" style="display:none;">'+
                                '<label tabindex="0" for="file_first_'+count+'" class="input-file-trigger"><i class="fa fa-close"> </i></label>'+
                                '<div class="image_gallery_preview">  </div>'+
                           '</div></div></div></div>'+
                          '</td>'+
                          '<td class="products_add_table_padding">'+
                            '<input type="number" name="position[]" value="'+count+'">'+
                          '</td>'+
                          '<td class="products_add_table_padding">'+
                            '<input type="text" name="alts[]">'+
                          '</td>'+
                           '<td class="products_add_table_padding">'+
                            '<button type="button" class="delete_row btn-danger"><i class="fa fa-trash"></i></button>'+
                          '</td>'+
                        '</tr>');
});

$('body').on('click', ".delete_row", function() {
   $(this).parent().parent().remove();
});

});

$(document).ready(function() {
  $('body').on('click', ".datetimepicker", function() {
    $(this).datetimepicker({format: 'YYYY-MM-DD hh:mm'});
  });
       
       

  $(".add_new_discount").click(function() {
    
    $(".discounts_container tbody").append('<tr>'+
                       '<td><input type="number" name="discount_price[]"></td>'+
                       '<td>'+
                        '<div class="">'+
                          '<div class="input-group date datetimepicker" >'+
                            '<input type="text" class="" name="date_begin[]" required="required" />'+
                            '<span class="input-group-addon">'+
                              '<span class="glyphicon glyphicon-calendar"></span>'+
                            '</span>'+
                          '</div>'+
                        '</div>'+
                     '</td>'+
                       '<td>'+
                        '<div class="">'+
                          '<div class="input-group date datetimepicker" >'+
                            '<input type="text" class="" name="date_end[]" required="required" />'+
                            '<span class="input-group-addon">'+
                              '<span class="glyphicon glyphicon-calendar"></span>'+
                            '</span>'+
                          '</div>'+
                        '</div>'+
                      '</td>'+
                       '<td style="text-align: center;">'+
                        '<button class="delete_discount">'+
                         '<i class="fa fa-trash"></i>'+
                       '</button>'+
                     '</td>'+
                     '</tr>');
  });

$('body').on('click', ".delete_discount", function() {
   $(this).parent().parent().remove();
});
  
  $(".selected_options_products_item:last-child").addClass('selected_options_products_item_active');
  $(".product_options_right_list_item:last-child").css("display","block");


  $(".change__currency").change(function() {
  
  var currency_value = "";
  if ($(this).val() == 1) {
    currency_value = "Гривні";
  } 
  if ($(this).val() == 2 ) {
    currency_value = "Євро";
  }
  if ($(this).val() == 3 ) {
    currency_value = "Доллари";
}
 $(".selected_currency").text(currency_value);
});
});
</script>