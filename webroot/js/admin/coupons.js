 $(document).ready(function() {


//
 $('body').on('click', ".search_coupon", function() {
   $(this).parent().find(".attributes_list").css('display','block');
 });

 $('body').on('click',".choose_coupon", function() {
   let price_product = $(".price-product").attr('value');
   var name_attribute = $(this).attr("data-name");
   var id_attribute = $(this).attr('data-coupon');
   $(this).parent().parent().parent().parent().find('.search_coupon').val(name_attribute);
   $(this).parent().parent().parent().parent().find('.search_coupons_id').attr("value", id_attribute);
   $(this).parent().parent().parent().parent().find('.attributes_list').css("display","none");
 });

 $('body').on('keypress',".discount_value", function() {
     let el = $(this);

   setTimeout(function() {
 let price_product = $(".price-product").val();
     let val =el.val();
  console.log(price_product);
  persent = price_product / 100;
  if (price_product != undefined) {
   let  product_price = price_product - (persent * val);
  $(el).parent().parent().find('.new_price_product').text(product_price);   
    console.log(product_price);
  }
   }, 350);
   

 });


 $('body').on("keypress" ,".search_coupon", function (e)  {
  var value = $(this).val();
  $.ajax({
  url: coupons_url,
  data: { "attribute": value },
  success: function(data){ 
      
      var html = '';
      
      if (data.type == 1) {
       for (i = 0; i < data.attributes.length; i++) {
        var list_attributes = "";
        if (data.attributes[i]['attributes_items'].length != 0) {
         list_attributes = '<p class="attributes_list_item_list_item choose_coupon" data-attribute="'+data.attributes[i]['attributes_items'][0]['id']+'" data-name="'+data.attributes[i]['attributes_items'][0]['name']+'">'+data.attributes[i]['attributes_items'][0]['name']+'</p>';
        } else { list_attributes = "";}
        html = html + '<div class="attributes_list_item">'+
                              '<p class="attributes_list_item_title">'+data.attributes[i]['name']+'</p>'+
                              '<div class="attributes_list_item_list">'+
                                  list_attributes+
                              '</div>'+
                            '</div>';
      }
      }
      if (data.type == 2) {
        console.log(data.attributes);
        for (i = 0; i < data.attributes.length; i++) {
        html = html + '<div class="attributes_list_item">'+
                              '<p class="attributes_list_item_title">'+data.attributes[i]['parent_attributes_item']['name']+'</p>'+
                              '<div class="attributes_list_item_list">'+
                                  '<p class="attributes_list_item_list_item choose_attribute" data-attribute="'+data.attributes[i]['id']+'" data-name="'+data.attributes[i]['name']+'">'+data.attributes[i]['name']+'</p>'+
                              '</div>'+
                            '</div>';
      }
    }
    $(".attributes_list").html(html);
  }
  });
});

$(".add_new_promo").click(function() {
  $(".coupons_list").css("display","none");
  html_attributes = $('.coupons_list_parent').html();
   html = '<tr>'+
                      '<td style="width: 30%;position: relative;">'+
                        '<input type="text" class="search_coupon" name="attribute" autocomplete="off">'+
                        '<input type="text" class="search_coupons_id" name="coupons[]" style="display: none;">'+
                        '<div class="attributes_list" style="display: none;">'+
                         html_attributes+
                        '</div>'+
                      '</td>'+
                      '<td>'+
                        '<input type="text" name="coupons_values[]" class="discount_value">'+
                      '</td>'+
                      '<td> <p class="new_price_product"> </p>'+
                      '</td>'+
                      '<td style="text-align: center;">'+
                        '<button class="delete_new_coupon  btn-danger">'+
                         '<i class="fa fa-trash"></i>'+
                        '</button>'+
                      '</td>'+
                    '</tr>';

  $('.coupons_table tbody').append(html);
});

$('body').on("click" ,".delete_new_coupon",  function() {
   $(this).parent().parent().remove();
});
});