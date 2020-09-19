$(document).ready(function() {

  setTimeout(function() {
    $(".lazy_load").each(function() {
      var data = $(this).attr('data-load');
        $(this).attr('src', data);
    });
  });

setTimeout(function(){ 
    $('header .propose_item').eq(2).find('.propose_item_list_item_float').eq(2).css('top','33%');
    $('main .propose_item').eq(2).find('.propose_item_list_item_float').eq(2).css('top','33%');

     $('header .propose_item').eq(11).find('.propose_item_list_item_float').eq(1).css('left','4%').css('top','69%');
    $('main .propose_item').eq(11).find('.propose_item_list_item_float').eq(1).css('left','4%').css('top','69%');

    

 $('.propose_item.Lіnіyi.rozdachі').each(function() {
    $(this).find('.propose_item_list_item_float').eq(1).css('left','2%').css('top','5%');
      $(this).find('.propose_item_list_item_float').eq(0).css('right','-2%');
 });

 $('.propose_item.Kukhonnyi.inventar.ta.aksesuary').each(function() {
    $(this).find('.propose_item_list_item_float').eq(1).css('left','4%').css('top','54%');
 });


}, 500);

});

var global_curs = 1;
var global_curs_dollar = 1;
var x, i, j, selElmnt, a, b, c;


var type_currency = 1;
var custom_currency;
var custom_currency_dollar;




  function update_count_cart() 
  {
    setTimeout(function(){
  current_count = parseInt($('.bascket_item').length);
  
  $(".count_of_bascket").text(current_count);
    }, 400);


}
function update_bascket_list() {
  $.ajax({
        url: ''+currency_url+'/carts/list',
        type: 'POST',
        success: function(data){ 
             console.log(data.products);   
              var html = '<div class="modal-dialog basket_modal modal-dialog-centered" role="document">'+
    '<div class="modal-content ">'+
      '<div class="modal-header">'+
        '<h5 class="modal-title" id="basketlabel">Корзина</h5>'+
        '<button type="button" class="close close-backet" data-dismiss="modal" aria-label="Close">'+
          '<span aria-hidden="true">&times;</span>'+
        '</button>'+
      '</div>'+
      '<div class="modal-body quick_buy_form baskets_items">'+
            '<div class="bascket_container">';
          
          console.log(data.products.length);
          for (i = 0; i < data.products.length; i++) {
           // html  = html + data.products[i];
           console.log(data.products[i]);
            html  = html +'<div class="bascket_item">'+
            '<button class="bascket_delete">'+
              '<i class="fa fa-trash display_bascket_popup"></i>'+
              '<div class="popup_bascket_item">'+
                '<div class="popup_bascket_item_top">'+
                  '<div class="popup_bascket_item_wishlist add_product_to_wishlist" data-product="'+data.products[i]['product']['id']+'">'+
                    '<div class="popup_bascket_item_icon">'+
                      '<i class="fa fa-heart"></i>'+
                    '</div>'+
                    '<div class="popup_bascket_item_description">'+
                      '<p>Перемістити до списку бажань </p>'+
                    '</div>'+
                  '</div>'+
                  '<div class="popup_bascket_item_delete " data-product="'+data.products[i]['product']['id']+'">'+
                    '<div class="popup_bascket_item_icon">'+
                      '<i class="fa fa-trash"></i>'+
                    '</div>'+
                    '<div class="popup_bascket_item_description">'+
                      '<p>Видалити без збереження</p>'+
                    '</div>'+
                  '</div>'+
                  '</div>'+
                  '<div class="popup_bascket_item_bottom">'+
                    '<p>Скасувати</p>'+
                  '</div>'+
              '</div>'+
            '</button>'+
             '<div class="bascket_item_left">'+
               '<img src="'+currency_url+'/products/'+data.products[i]['product']['image']+'" alt="">'+
             '</div>'+
             '<div class="bascket_item_right">'+
               '<div class="bascket_item_right_title">'+
                 '<p>'+data.products[i]['product']['title']+'</p>'+
               '</div>'+
               '<div class="bascket_item_right_prices">'+
                 '<div class="bascket_item_price">'+
                   '<p><span class="translate_price_search translate_price" data-currency="'+data.products[i]['product']['currency_id']+'">'+(data.products[i]['one_price']).toFixed(2)+'</span> грн</p>'+
                 '</div>'+
                 '<div class="bascket_item_buttons">'+
                   '<div class="bascket_item_buttons_inside">'+
                     '<div class="bascket_item_buttons_minus">'+
                       '<i class="fa fa-minus"></i>'+
                     '</div>'+
                     '<output class="bascket_item_buttons_output">'+data.products[i]['count']+'</output>'+
                     '<div class="bascket_item_buttons_plus">'+
                       '<i class="fa fa-plus"></i>'+
                     '</div>'+
                   '</div>'+
                 '</div>'+
                 '<div class="bascket_item_price_total">'+
                   '<p><span class="translate_price_search total_basket" data-currency="'+data.products[i]['product']['currency_id']+'">'+data.products[i]['total_sum']+'</span> грн</p>'+
                 '</div>'+
               '</div>'+
             '</div>'+
           '</div>';
          } 

          html = html + '</div>'+
        '<div class="bascet_total">'+
          '<div class="bascet_total_left"></div>'+
          '<div class="bascet_total_right">'+
            '<span>Разом: </span><span><strong class="total_of_bascket"></strong> грн</span>'+
          '</div>'+
        '</div>'+
        '<div class="bascket_bottom">'+
          '<div class="bascet_bottom_left">'+
            '<a href="#" data-dismiss="modal">Продовжити покупки</a>'+
          '</div>'+
          '<div class="bascet_bottom_right">'+
            '<a href="'+currency_url+'/orders" class="bascet_bottom_right_link">Оформити'+
                '</a>'+
          '</div>'+
        '</div>'+
      '</div>'+
    '</div>'+
  '</div>';
          $("#basket").html(html);
          $(".bascket_container_empty").html(html);
          setTimeout(function(){
        change_currency();
          }, 600);

          setTimeout(function(){
        update_bascket();
          }, 1000);
        }
     });
}

 $("body").on("click", '#basket .close-backet', function() {
       $('#basket').removeClass('show');
       $(".modal-backdrop").css('display', 'none');
       $("body").removeClass('modal-open');
        $('#basket').modal('hide');
        $('#basket').css('opacity', 0);
        $('#basket').css('z-index', -1);
});

function update_bascket() {
  setTimeout(function() {
  var total_basket_new = 0;

  $("#basket .total_basket").each(function() {
     total_basket_new =  total_basket_new + parseInt($(this).text());
  });
  
  total_basket_new = parseInt(total_basket_new);
  
  $(".total_of_bascket").text(total_basket_new);
  $(".total_of_bascket").css('opacity', 1);
}, 600);
}

function update_cart() {

    $.ajax({
        url: ''+currency_url+'/carts/cart',
        type: 'POST',
        success: function(data){ 
           

             cart = data;
           
        }
    });

}

$(".background_grey").click(function() {
  $(this).fadeOut('fast');
  $('header .propose_list').slideUp('fast');
  $('header .propose_left').removeClass('propose_left_active');
});

 $("body").on("click",'.bascket_delete', function() {

   $(this).find('.popup_bascket_item').css('display', 'block');
});

 $("body").on("click",'.popup_bascket_item_bottom', function() {

    $(this).parent().hide();
});

$.ajax({
        url: ''+currency_url+'/currency/get-type-currency',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                   type_currency = data.result.type;
                   custom_currency = data.result.value;
                   custom_currency_dollar = data.result.value_dollar;
        }
     });
setTimeout(function() {
  if (type_currency == 1) {
    setTimeout(function() {
var flickerAPI = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";
  $.getJSON( flickerAPI, {
    tags: "mount rainier",
    tagmode: "any",
    format: "json"
  })
  .done(function(data) {
    global_curs = data[1]['buy'];
    global_curs_dollar = data[0]['buy'];
    console.log(data);
   $(".translate_price").each(function() {
        var price= parseFloat($(this).text());
        console.log(price);
        console.log(global_curs);
        console.log(global_curs_dollar);
        if ($(this).attr('data-currency') == 2) {
        $(this).text(Math.floor(price * global_curs));
      }
      if ($(this).attr('data-currency') == 3) {
        $(this).text(Math.floor(price * global_curs_dollar));
      }
        $(this).css("opacity","1");
    });
  })

}, 400);
  } else {
    global_curs = custom_currency;
    $(".translate_price").each(function() {
        var price= parseFloat($(this).text().replace(",", "."));
        console.log(price);
        console.log(custom_currency);
        console.log(custom_currency_dollar);
        if ($(this).attr('data-currency') == 2) {
        $(this).text(Math.floor(price * custom_currency));
        }

        if ($(this).attr('data-currency') == 3) {
        $(this).text(Math.floor(price * custom_currency_dollar));
        }
        $(this).css("opacity","1");
    });

  }
},400);



function change_currency() {
  var type_currency ;
var custom_currency;
var custom_currency_dollar;
$.ajax({
        url: ''+currency_url+'/currency/get-type-currency',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                    console.log("type: "+ data.result.type);

                   type_currency = data.result.type;
                   custom_currency = data.result.value;
                   console.log('custom_currency'+custom_currency);
                   custom_currency_dollar = data.result.value_dollar;
        }
     });
  if (type_currency == 1) {
    setTimeout(function() {
var flickerAPI = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5";
  $.getJSON( flickerAPI, {
    tags: "mount rainier",
    tagmode: "any",
    format: "json"
  })
  .done(function(data) {
    global_curs = data[1]['buy'];
    global_curs_dollar = data[0]['buy'];
    console.log(data);
   $(".translate_price_search").each(function() {
      var price= parseFloat($(this).text());
        if ($(this).attr('data-currency') == 2) {
        $(this).text(Math.floor(price * global_curs));
      }
      if ($(this).attr('data-currency') == 3) {
        $(this).text(Math.floor(price * global_curs_dollar));
      }
      $(this).removeClass('translate_price_search');
        $(this).css("opacity","1");
    });
  })
}, 500);
  } else {
        setTimeout(function() {
    console.log('tow');
    global_curs = custom_currency;
    $(".translate_price_search").each(function() {
      console.log('this_text' + $(this).text());
      console.log(custom_currency);
      console.log(custom_currency_dollar);

      var price= parseFloat($(this).text());
        if ($(this).attr('data-currency') == 2) {
        $(this).text(Math.floor(price * custom_currency));
        }

        if ($(this).attr('data-currency') == 3) {
        $(this).text(Math.floor(price * custom_currency_dollar));
        }
        //$(this).removeClass('translate_price_search');
        $(this).css("opacity","1");
    });

  

}, 600);

} }

$(document).ready(function() {

 $(".product_tabs_top_item").click(function() {
   
   var index = $(this).index();

   $(".product_tabs_top_item").removeClass("product_tabs_top_item_active");
   $(this).addClass("product_tabs_top_item_active");
   $(".product_tabs_item").css("display","none");
   $(".product_tabs_item").eq(index).css("display","block");

 });


 $(".header_mobile_top").click(function() {
   $('.header_mobile_list').slideToggle();
 });

 $("header .propose_left_top").click(function() {
   if (!$(this).parent().hasClass('propose_left_active')) {
     $(this).parent().addClass('propose_left_active');
     $(".background_grey").fadeIn('fast');
     $(this).parent().parent().find('.propose_list').addClass('propose_list_active');
   } else {
     $(this).parent().removeClass('propose_left_active');
     $(this).parent().parent().find('.propose_list').removeClass('propose_list_active');
     $(".background_grey").fadeOut('fast');
   }

 });
 
  $("body .propose_left_top").click(function() {
    $(this).parent().parent().find('.propose_list').slideToggle();
  });

 $(".header_search").click(function() {
  $(".haeder_search_popup").css("display","block");
 });

 $(".close_search_form").click(function() {
  $(".haeder_search_popup").css("display","none");
 });

 $(".header_bascet_top").click(function() {
   $(".header_bascket_list").slideToggle();
 });

$(".header_menu").click(function() {
  $(".mobile_menu").animate({
    right: "+=320",
  }, 500, function() {
    // Animation complete.
  });
});


$(".mobile_menu_close").click(function() {
  $(".mobile_menu").animate({
    right: "-=320",
  }, 500, function() {
    // Animation complete.
  });
});

$(".propose_item_list_two").each(function(i) {
  if ($(this).find('a').length > 0 ) {
    $(this).parent().addClass('propose_item_list_item_float');
    $(this).parent().parent().addClass('propose_item_list_big');
  }

});

$(".propose_item_list").each(function(i) {
var top = 20;
  $(this).find('.propose_item_list_item_float').each(function(el) {
     $(el).css("top",top+"px");
  top = top + 150;
  });
  
});

$("boby .propose_list").hover(function() {
 $(this).addClass('propose_list_active');
// $(".background_grey").fadeIn('fast');

});

$("body .propose_list").mouseleave(function() {
 
 $(this).removeClass('propose_list_active');
// $(".background_grey").fadeOut('fast');

});

$(".sales_list_item").eq(0).css('display', 'flex');
$(".sales_categories_item").eq(0).addClass('sales_categories_item_active');

$(".sales_categories_item").click(function() {
  var index = $(this).index();
  $(".sales_categories_item").removeClass('sales_categories_item_active');
  $(this).addClass('sales_categories_item_active');
  
  $(".sales_list_item").css('display', 'none');
  $(".sales_list_item").eq(index).css('display', 'flex');

});

$(".filter_elements_items_item_close").click(function() {
   
   $(this).toggleClass('filter_elements_items_item_close_closed');

   if ($(this).hasClass('filter_elements_items_item_close_closed')) {
     $(this).find('.fa').removeClass('fa-plus');
     $(this).find('.fa').addClass('fa-minus');

   }
   else {
     $(this).find('.fa').removeClass('fa-minus');
     $(this).find('.fa').addClass('fa-plus');
   }
   
   $(this).parent().parent().find('.filter_elements_items_item_bottom').slideToggle();
});

});

$(document).ready(function(){
$(".custom-select-two").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
   $("#product_sort").submit();
});
});

$(document).ready(function() {
 
  $(".header_center_text").keyup(function() {
    $(".header_search_products").html("");
    if ($(this).val() != "") {

      $(".header_search_block").css("display", "block");
      $(".hide_search").css("display", "block");
      $(".loader.loader--style3").css("display", "block");





      $.ajax({
        url: ''+global_url+'search/search',
        type: 'POST',
        data: {"search": $(this).val()},
        success: function(data){ 
          $(".loader.loader--style3").css("display", "none");

          var html = "";
              setTimeout(function() {
          console.log(data);
          if (data.products.length >= 1) {
          for (i = 0; i < data.products.length; i++) {
           // html  = html + data.products[i];
            html  = html +'<div class="header_search_product">'+
                              '<a class="header_search_product_image">'+
                                '<img src="'+global_url+'products/'+data.products[i]['image']+'">'+
                              '</a>'+
                              '<div class="header_search_product_description">'+
                                '<p class="header_search_product_title">'+data.products[i]['title']+'</p>'+
                                '<p class="header_search_product_price"><span class="translate_price_search" data-currency='+data.products[i]['currency_id']+'>'+data.products[i]['price']+'</span> грн</p>'+
                                '<a href="'+global_url+'/products/'+data.products[i]['slug']+'" class="header_search_product_link">Перейти</a>'+
                              '</div>'+
                            '</div>';
          } 
          $(".header_search_products").html(html);
        } else {
          $(".header_search_products").html("<p class='products_not_found'>Товарів за вашим запитом не знайдено.</p>");
        }
      }, 300);
          setTimeout(function() {
        
change_currency();
          }, 500);
          
        }
     });
    } else {
      $(".header_search_block").css("display", "none");
      $(".hide_search").css("display", "none");
       $(".loader.loader--style3").css("display", "none");
    }

  });



 
  $(".hide_search").click(function() {
    $(".header_search_block").css("display", "none");
    $(".header_center_text").val("");
    $(this).css('display', 'none');
  });

});

$('#modalPopup').modal();



$(document).ready(function() {
setTimeout(function() {
  update_bascket();

 /* var total = 0;
  $(".total_basket").each(function(i) {
      total = total + parseInt($(this).text());

  });
  $(".total_of_bascket").text(total); */
}, 1500);

 $("body").on("click",'.bascket_item_buttons_plus', function() {
     

     var index = $(this).parent().parent().parent().parent().parent().index();
     console.log(cart.length);
     var keys = Object.keys(cart);
     
     console.log(cart);
     var new_count = parseInt(cart[keys[index]]['count']) + 1;
     cart[keys[index]]['count'] = new_count;

     $(this).parent().find('.bascket_item_buttons_output').text(cart[keys[index]]['count']);
     
     set_new_price_tovar($(this), cart[keys[index]], cart[keys[index]]['count']);
     save_count_bascket(new_count, keys[index]);
     update_bascket();
       
 });

 $("body").on("click",'.bascket_item_buttons_minus', function() {

    $.ajax({
        url: ''+currency_url+'/carts/list',
        type: 'POST',
        success: function(data){ 
         var  cart = data.products;
        }
        });
      
     var index = $(this).parent().parent().parent().parent().parent().index();
     console.log(cart.length);
     var keys = Object.keys(cart);
     
     var new_count = parseInt(cart[keys[index]]['count']) - 1;
     cart[keys[index]]['count'] = new_count;

     $(this).parent().find('.bascket_item_buttons_output').text(cart[keys[index]]['count']);

     set_new_price_tovar($(this), cart[keys[index]], cart[keys[index]]['count']);
     save_count_bascket(new_count, keys[index]);
     update_bascket();
       
 });

function save_count_bascket(count, key) {
  $.ajax({
        url: currency_url+'/carts/change',
        method: 'POST',
      data: { "count": count, "key": key},
      success: function(data){ 
        alert("Змінено");
        }
    });

}

function set_new_price_tovar(element, product, new_count) {
  console.log(product);
  const reducer = (accumulator, currentValue) => accumulator + currentValue;
   var value_of_options = 0;
   if (product['array_option_value'].length > 0) {
     var value_of_options = product['array_option_value'].reduce(reducer);
     console.log(product['array_option_value'].reduce(reducer));
   }
   
   price_product = product['one_price'];

   if (product['product']['currency_id'] == 2) {

      price_product =  price_product * global_curs;
      value_of_options = value_of_options * global_curs;
   } 

   if (product['product']['currency_id'] == 3) {
      price_product = price_product * global_curs_dollar;
      value_of_options = value_of_options * global_curs_dollar;
   } 
   
   console.log(product['product']['currency_id']);
   console.log(global_curs_dollar); 
   console.log(global_curs);
   console.log(value_of_options);
   console.log(price_product);
   
   if (value_of_options == "undefined" || value_of_options == "NaN") {
       value_of_options = 0;
   }
   
   if (product['is_empty_price']) {
     var final_price = value_of_options * new_count;
   } else {
   var final_price = (price_product + value_of_options) * new_count;
   }

   $(element).parent().parent().parent().find('.total_basket').text(parseInt(final_price));
}


});

$(document).ready(function() {

 $("body").on("click",'div.add_product_to_wishlist', function() {

   
   var id_product = $(this).attr("data-product");
   var element = $(this);

   $.ajax({ 
        url: currency_url+'/wishlist/add',
        method: 'POST',
        data: { "id_product": id_product},
        success: function(data){ 
         $("#added_wishlist").modal({
              show: true
            }); 
         $(element).removeClass('add_product_to_wishlist');
        }
    });
     $(this).parent().parent().parent().parent().remove();
     update_bascket();

});






 $("body").on("click",'.popup_bascket_item_delete', function() {
  var id_product = $(this).attr("data-product");

   $.ajax({ 
        url: currency_url+'/carts/delete',
        method: 'POST',
        data: { "id_product": id_product},
        success: function(data){ 
          alert("Додано");
        }
    });
     $(this).parent().parent().parent().parent().remove();

     update_bascket();
});

 $("body").on("click",'.popup_bascket_item_bottom', function() {
   var element = $(this);
   setTimeout(function() {
  $(element).parent().css('display', 'none');

   }, 150);
});


});

$(document).ready(function() {

 $('.display_all').click(function() {
   $(this).parent().find('.all_description').toggleClass('all_description_dispayed');
   $(this).parent().find('.thre_comas').toggleClass('all_description_dispayed');
   if ($(this).parent().find('.all_description').hasClass('all_description_dispayed')) {
      $(this).html('Розгорнути <i class="fa fa-caret-down"></i>');
    
   } else {
           $(this).html('Згорнути <i class="fa fa-caret-up"></i>');

   }
 })
});


$(document).ready(function() {
   
   $(".add_product_to_bascket").click(function() {

       var id_product = $(this).attr('data-product');

           $.ajax({
        url: currency_url+'/carts/add',
        method: 'POST',
      data: { "product_id": id_product,  "count_id_bascket":1  },
      success: function(data){ 
        //alert("Додано");
        $("#basket").modal({
              show: true
            }); 
$('#basket').removeClass('show');
       $(".modal-backdrop").removeAttr('style');
       $("body").addClass('modal-open');
        $('#basket').css('opacity', 1);
        $('#basket').css('z-index', 1050);

update_bascket_list();
update_cart();
update_count_cart();
        }
    });
   });

  $(".product_shop_buy").click(function() {
    setTimeout(function() {
update_bascket_list();
update_cart();
update_count_cart();
    }, 100);

  });
});


$(document).ready(function() {
    $(".get_call_form").submit(function() {
       event.preventDefault(); 
       $('.auth_loader').css("display","inline-block");
       $(".quick_submit").css("display","none");
       $.ajax({
        url: currency_url+'calls/add',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
          $(".message_submit_quick_order").html("");
          console.log()

          if (data.status == "true")
           {

            setTimeout(function() {
               $(".message_submit_quick_order").html('<div class="message_submit_quick_order_message">'+
                ''+
                '<strong>Увага!</strong> Вашу заяку прийнято'+
                '</div>');

               $('.auth_loader').css("display","none");
              $(".quick_submit").css("display","block");
              $(".get_call_form input[type='text']").val("");
              $(".get_call_form input[type='number']").val("");
             },1000); 
           }

           
        }
     });
    }); 
});


$(document).ready(function() {
 $('.user_register').submit(function() {
       event.preventDefault(); 

       var element = $(this);
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');
       $.ajax({
        url: currency_url +'/users/auth-ajax' ,
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                   $(element).parent().find('.hide_submit').css("display",'block');
       $(element).parent().find(".loader_svg").css('display','none');
        if (data.status == false ) {
            $(element).parent().find('.display_message_register').html('<p class="display_message_register_alert btn-danger"><strong>Увага</strong> '+data.message+'</p>');
          }
         if (data.status == true) {
           window.location.href = currency_url+'/cabinet/cabinet';
         }
        }
     });
     });
  

  $('.header_top-item div').mouseover(function() {
     $(this).find('.empty_element').css('display', 'flex');
  });
  $('.header_top-item div').mouseout(function() {
     $(this).find('.empty_element').css('display', 'none');
  });


  $('.header_mobile_links div').mouseover(function() {
     $(this).find('.empty_element').css('display', 'flex');
  });
  $('.header_mobile_links div').mouseout(function() {
     $(this).find('.empty_element').css('display', 'none');
  });

})


$(document).ready(function() {
  var id_product;
  var element;
  var logget_header = true;
  $("body").on("click",'button.add_product_to_wishlist', function() {

   
    id_product = $(this).attr("data-product");
    element = $(this);

   $.ajax({ 
        url: currency_url+'/users/check-auth',
        method: 'POST',
        success: function(data){ 
          if (data.status == false) {
            logget_header = false;
            $("#wish_auth_modal").modal({
              show: true
            }); 
          } else {
                      add_product_wislist(element, id_product);

          }
        }
    });

});


 $('.wish_auth_modal').submit(function() {
       event.preventDefault(); 

       var elements = $(this);
       $(this).parent().find('.hide_submit').css("display",'none');
       $(this).parent().find(".loader_svg").css('display','block');
       $.ajax({
        url: currency_url +'/users/auth-ajax' ,
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                   $(elements).parent().find('.hide_submit').css("display",'block');
       $(elements).parent().find(".loader_svg").css('display','none');
        if (data.status == false ) {
            $(elements).parent().find('.display_message_register').html('<p class="display_message_register_alert btn-danger"><strong>Увага</strong> '+data.message+'</p>');
          }
         if (data.status == true) {
           $('#wish_auth_modal').modal('hide');
          
          // window.location.href = currency_url+'/cabinet/cabinet';
          if (logget_header == false) {
          add_product_wislist(element, id_product);
        } else {
          $(".header_top-item .empty_element").remove();
        } 
         }
        }
     });
     });

  function add_product_wislist(element, id_product) {

   $.ajax({ 
        url: currency_url+'/wishlist/add',
        method: 'POST',
        data: { "id_product": id_product},
        success: function(data){ 
          $("#added_wishlist").modal({
              show: true
            }); 
          $(element).removeClass('add_product_to_wishlist');
          $(element).addClass('added_product_to_wishlist');
          $(".header_top-item .empty_element").remove();
        }
    });
     update_bascket();
  }

$(".header_top-item .empty_element .empty_element_right a").click(function() {
   $(".header_top-item .empty_element").css('display', 'none');
});


$(".create_new_customer").submit(function() {
       event.preventDefault(); 
       $.ajax({
        url: currency_url +'/users/follow' ,
        type: 'POST',
        data: $(this).serialize(),
        success: function(data){ 
                   
         if (data.status == true) {
           $(".email_follower").text(data.email);
           $('#added_after_follow').modal({
              show: true
            }); 

        }}

      });
    
});



  $("body").on("click",'.add_product_to_compare', function() {

   
   var id_product = $(this).attr("data-product");
   var element = $(this);

   $.ajax({ 
        url: currency_url+'/compares/add',
        method: 'POST',
        data: { "id_product": id_product},
        success: function(data){ 
          $("#added_compare").modal({
              show: true
          }); 
          $('.link_to_compare').attr('href', currency_url+'/compares/'+data.category);
          $(element).removeClass('add_product_to_compare');

          var html = "";
          var total = 0;
          if ($("div").is(".lists_of_compares")) {
            
            if (data.list_of_compares.length >= 1) {
            for( i=0; i< data.list_of_compares.length; i++) {
                html = html +'<div class="list_of_compares_item">'+
                          '<a href="'+currency_url+'/compares/'+data.list_of_compares[i]['slug']+'">'+data.list_of_compares[i]['category_name']+' (<span class="count_item_compare">'+data.list_of_compares[i]['count']+'</span>)</a>'+
                        '<i class="fa fa-close delete_compares_item" data-item="'+data.list_of_compares[i]['product']+'"></i>'+
                        '</div>';
                        total = total + data.list_of_compares[i]['count'];
            }
          
          }
          
     $(".total_compares").text(total);

     
          $(".lists_of_compares").html(html);
        } else {

          var html = "";
          var total = 0;
          $(".empty_element").eq(1).remove();
          $(".compares_cont").append('<div class="lists_of_compares" style="display: none;"></div>');
          if (data.list_of_compares.length >= 1) {
            for( i=0; i< data.list_of_compares.length; i++) {
                html = html +'<div class="list_of_compares_item">'+
                          '<a href="'+currency_url+'/compares/'+data.list_of_compares[i]['slug']+'">'+data.list_of_compares[i]['category_name']+' (<span class="count_item_compare">'+data.list_of_compares[i]['count']+'</span>)</a>'+
                        '<i class="fa fa-close delete_compares_item" data-item="'+data.list_of_compares[i]['product']+'"></i>'+
                        '</div>';
                        total = total + data.list_of_compares[i]['count'];
            }
          
          }
           $(".lists_of_compares").html(html);
           $(".total_compares").text(total);
        }
        }
    });

});
  
});

   $('.cabinet_link_user').mouseover(function() {
     $(".sub_menu_for_cabinet").fadeIn('fast');
   });

   $('.sub_menu_for_cabinet').mouseover(function() {
     //alert('erg');
  //   $(".sub_menu_for_cabinet").fadeIn('fast');
   });

   $('.sub_menu_for_cabinet').mouseleave(function() {
     $(".sub_menu_for_cabinet").fadeOut('fast');
   });




   $('.display_list_of_compares').mouseover(function() {
     $(".lists_of_compares").fadeIn('fast');
   });

   $('.lists_of_compares').mouseover(function() {
     //alert('erg');
  //   $(".sub_menu_for_cabinet").fadeIn('fast');
   });

   $('.lists_of_compares').mouseleave(function() {
     $(".lists_of_compares").fadeOut('fast');
   });




   $('.compares_cont').mouseover(function() {
     $(".lists_of_compares").fadeIn('fast');
   });

   $('.lists_of_compares').mouseover(function() {
     //alert('erg');
  //   $(".sub_menu_for_cabinet").fadeIn('fast');
   });

   $('.lists_of_compares').mouseleave(function() {
     $(".lists_of_compares").fadeOut('fast');
   });


  $("body").on("click",".delete_compares_item", function(){
     var key = $(this).attr('data-item');
     var element = $(this).parent().parent();
       $.ajax({ 
        url: currency_url+'/compares/remove',
        method: 'POST',
        data: { "key": key},
        success: function(data){ 
         
        }
    });
       $(this).parent().remove();
     var total = 0;

     $(element).find(".count_item_compare").each(function() {
       total = total + parseInt($(this).text());
     });
     $(".total_compares").text(total);

     if (total == 0) {
       $('.lists_of_compares').remove();
       $(".compares_cont").append('<div class="empty_element" style="width: 353%; display: flex;">'+
                  '<div class="empty_element_left">'+
                    '<img src="http://rojac/img/compare.svg" alt="">'+
                  '</div>'+
                  '<div class="empty_element_right">'+
                    '<p>Немає товарів у порівнянні</p>'+
                    '<p>Додавайте товари до порівняння характеристик та обирайте товар, який вам підійте найкраще </p>'+
                  '</div>'+
                '</div>');
     }
   }); 