<?php   $baseUrl = \Cake\Routing\Router::url('/', true);
      $baseUrl = rtrim($baseUrl, '/').'/';

      $str = file_get_contents($baseUrl.'/currency/get-type-currency');
      $json = json_decode($str, true);
     //debug($json['result']);

      $kurs_dollar = 1;
      $kusr_euro = 1;

      if ($json['result']['type'] == 1) {
        $str = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
         $data = json_decode($str, true);
         $kurs_dollar = $data[0]['buy'];
         $kusr_euro = $data[1]['buy'];
      }
       if ($json['result']['type'] == 2) {
         $kurs_dollar = $json['result']['value_dollar'];
         $kusr_euro = $json['result']['value'];
       }
        ?>
    <!-- Main content -->
    <section class="content white_background products_container">
    <div class="row">
      <div class="col-md-12">
<div class="products_container_top">
          <p class="products_container_title">Замовлення/Перегляд замовлення (№00<?= $order->id  ?>)</p>
          <div class="product_container_buttons">
            <a class="redirect_back" href="<?= $this->Url->build(['controller' => 'products','action'=>'index']) ?>">
              <i class="fa fa-pencil">  </i>
            </a>
        <a class="redirect_back" href="<?= $this->Url->build(['controller' => 'products','action'=>'index']) ?>"><svg xmlns="http://www.w3.org/2000/svg" width="21.263" height="15" viewBox="0 0 25.263 20"><defs><style>.a{fill:#222d32;}</style></defs><g transform="translate(10 -56)"><path class="a" d="M89.257,113.908a11.925,11.925,0,0,0-3.2-8.928c-2.316-2.329-5.283-3.513-9.428-3.7V96L64,104.421l12.632,8.421v-5.25a13.279,13.279,0,0,1,5.7,1.316c2.033.908,3.638,2.895,4.987,5.039L88.586,116h.678C89.263,115.336,89.257,114.493,89.257,113.908Z" transform="translate(-74 -40)"/></g></svg></a>
       </div>
     </div>         
     <div class="playlist__managment__item">
       <div class="quick_orders_top">
         <div class="quick_orders_top_item">
           <div class="quick_orders_top_item_title">
            <p><i class="fa fa-shopping-basket"></i></p>
            <p>Дата замовлення </p></div>
           <div class="quick_orders_top_item_container">
             <div class="quick_orders_top_item_information_item">
               <div class="quick_orders_top_item_information_item_icon">
                 <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="quick_orders_top_item_information_item_title">
                 <p><?= $order->created ?></p>
               </div>
             </div>
             <div class="quick_orders_top_item_information_item">
               <div class="quick_orders_top_item_information_item_icon">
                 <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="quick_orders_top_item_information_item_title">
                 <p><?php  if ($order->delivery_id == 1) {
       echo "Самовивіз";
      }

      if ($order->delivery_id == 2) {
         echo "Нова пошта: ". $order->dostavka;
      }

      if ($order->delivery_id == 3) {
        echo "МІстЕкспрес: ". $order->dostavka;
      }

      if ($order->delivery_id == 4) {
        echo "Інтайм: ". $order->dostavka;
      }  ?></p>
               </div>
             </div>
             <div class="quick_orders_top_item_information_item">
               <div class="quick_orders_top_item_information_item_icon">
                 <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="quick_orders_top_item_information_item_title">
                 <p><?php         if ($order->oplata_id == 1) {
        echo "Готівкою";
      }
      if ($order->oplata_id == 2) {
        echo "Visa або MasterCard";
      }
      if ($order->oplata_id == 3) {
        echo "LiqPay";
      }

      if ($order->oplata_id == 4) {
        echo "Наложений платіж";
      }

      if ($order->oplata_id == 5) {
        echo "Безготівковий розрахунок";
      } ?></p>
               </div>
             </div>
           </div>
         </div>
                  <div class="quick_orders_top_item">
           <div class="quick_orders_top_item_title">
            <p><img src="<?= $this->Url->build('/img/people_order.svg', ['fullBase' => true]) ?>" alt=""></p>
            <p>Відомість про покупця</p></div>
           <div class="quick_orders_top_item_container">
             <div class="quick_orders_top_item_information_item">
               <div class="quick_orders_top_item_information_item_icon">
                 <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="quick_orders_top_item_information_item_title">
                 <p><?= $order->username ?></p>
               </div>
             </div>
             <div class="quick_orders_top_item_information_item">
               <div class="quick_orders_top_item_information_item_icon">
                 <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="quick_orders_top_item_information_item_title">
                 <p><?= $order->email ?></p>
               </div>
             </div>
             <div class="quick_orders_top_item_information_item">
               <div class="quick_orders_top_item_information_item_icon">
                 <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="quick_orders_top_item_information_item_title">
                 <p><?= $order->phone ?></p>
               </div>
             </div>
           </div>
         </div>

                  <div class="quick_orders_top_item">
           <div class="quick_orders_top_item_title">
            <p><img src="<?= $this->Url->build('/img/new_setting_two.svg', ['fullBase' => true]) ?>" alt=""></p>
            <p>Статус замовлення </p></div>
           <div class="quick_orders_top_item_container">
             <div class="quick_orders_top_item_information_item quick_orders_top_item_information_item_order_status">
               <p>Статус замовлення: </p>
               <div class="quick_orders_top_item_information_item_title">
                 <select name="" id="">
                  <?php if ($order['status'] == 0): ?> 
                    <option value="">Новий</option> 
                  <?php endif; ?>
                  <?php if ($order['status'] == 1): ?> 
                      <option value="">Оплачено</option> 
                    <?php endif; ?>
                    <?php if ($order['status'] == 2): ?>  
                      <option value="">Виконано</option>  
                    <?php endif; ?>
                    <?php if ($order['status'] == 3): ?> 
                      <option value="">Відмінено</option>   
                    <?php endif; ?>
                 </select>
               </div>
             </div>
             <div class="quick_orders_top_item_information_item quick_orders_top_item_information_item_order_status">
               <p>Сповістити покупця</p>
               <div class="quick_orders_top_item_information_item_title">
                 <input type="checkbox">
               </div>
             </div>
             <div class="quick_orders_top_item_information_item">
               
             </div>
           </div>
         </div>

       </div>
<div class="orders_container">
  <div class="orders_container_top">
      <p><i class="fa fa-shopping-basket"></i></p>
      <p>Дата замовлення </p>
  </div>
  <div class="orders_container_inside">
  <table>
    <thead>
      <th>Артикул</th>
      <th>Товар</th>
      <th>Кількість</th>
      <th>Ціна, грн</th>
      <th>Сумма, грн</th>
    </thead>
    <tbody>
      <?php  $total = 0;foreach ($order['orders_items'] as $key => $value):  ?>
      <?php   $price = 0;
        if ($value['currency_id'] == 2) {
            $price = ($value['amount'] * $value['summa']) * $kusr_euro;
        } if  ($value['currency_id'] == 3) {
             $price = ($value['amount'] * $value['summa']) * $kurs_dollar;
         } if  ($value['currency_id'] == 1) {
            $price = $value['amount'] * $value['summa'];
        } 

        $total = $total + $price; ?>
        <tr>
        <td>001</td>
        <td><?= $value['product']['title'] ?></td>
        <td><?= $value['amount'] ?></td>
        <td><span class="translate_price" data-currency="<?= $value['currency_id'] ?>"><?= floor($value['summa']) ?>  </span> грн</td>
        <td>
          <span class="" data-currency="<?= $value['currency_id'] ?>">
          <?= round($price, 2); ?>  
        </span> грн</td>
      </tr>
      <?php endforeach; ?>
      
      <tr>
        <td class="b-none"></td>
        <td class="b-none"></td>
        <td class="b-none"></td>
        <td>Підсумок</td>
        <td><?= round($total) ?> грн</td>
      </tr>
      <tr>
        <td class="b-none"></td>
        <td class="b-none"></td>
        <td class="b-none"></td>
        <td>Доставка</td>
        <td>0 грн</td>
      </tr>
       <tr>
        <td class="b-none"></td>
        <td class="b-none"></td>
        <td class="b-none"></td>
        <td >Загальна сумма</td>
        <td><?= round($total) ?> грн</td>
      </tr>
    </tbody>
  </table>
  </div>
</div>
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