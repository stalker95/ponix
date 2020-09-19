 $(document).ready(function() {

 var  results = "";
 var results_two = "";

 function get_list_options(id)
 {
    var result = "<option value='1'>1</option>";  
    var html = "";
    $.ajax({
  url: option_url,
  data: { "id_option": id },
  success: function(data){ 
    var html = "";
    for (i = 0; i < data.options.length; i++) {
      html = html + "<option value='"+data.options[i]['id']+"'>"+data.options[i]['name']+"</option>";
    }
    results = html;
  }
  });

 }

 $("#selected_option").change(function() {
 $(".selected_options_products_list").css("display", "block");
   var name_option = $('option:selected', this).attr('data-name');
   var id_option = $('option:selected', this).attr('data-option');
get_list_options(id_option);
setTimeout(function() {

   $(".selected_options_products_item").removeClass('selected_options_products_item_active');
    $(".selected_options_products").append(' <div class="selected_options_products_item selected_options_products_item_active">'+
                      '<button type="button" class="selected_options_delete_option"><i class="fa fa-minus"></i></button>'+
                      '<p>'+name_option+'</p>'+
                    '</div>');

    $(".selected_options_products_list").css("display", "none");
    
    $(".product_options_right_list_item").css("display","none");
    $(".product_options_right_list").append('<div class="product_options_right_list_item">'+name_option+''+
                      '<table>'+
                       '<thead>'+
                        '<th>Значення опції</th>'+
                        '<th>Ціна</th>'+
                        '<th>Дії</th>'+
                      '</thead>'+
                      '<tbody>'+
                       '<tr>'+
                        '<td>'+
                         '<select name="options_item[]" id="" class="choose_option">'+
                          results+
                         '</select>'+
                       '</td>'+
                       '<td>'+
                         '<input type="number" name="amount_option[]" step="0.01">'+
                       '</td>'+
                       '<td style="text-align: center;">'+
                         '<button class="delete_item_option">'+
                           '<i class="fa fa-minus"></i>'+
                         '</button>'+
                       '</td>'+
                     '</tr>'+
                     '</tbody>'+
                   '</table>'+
                   '<div style="text-align: right;">'+
                    '<button class="add_new_row">'+
                      '<i class="fa fa-plus"></i>'+
                    '</button>'+
                   '</div>'+
                    '</div>');
}, 1000);

 });

$('body').on('click', '.selected_options_products_item',  function(){
  $(".selected_options_products_item").removeClass("selected_options_products_item_active");
  $(this).addClass('selected_options_products_item_active');

  var index = $(this).index();
  $(".product_options_right_list_item").css("display",'none');
  $(".product_options_right_list_item").eq(index).css("display",'block');
});


$('body').on('click', ".add_new_row", function() {
  var html = $(this).parent().parent().find(" tbody:last-child tr").html();
  $(this).parent().parent().parent().find(".product_options_right_list_item:last-child tbody ").append("<tr>"+html+"</tr>");
  html = "";
});

$('body').on('click', ".product_options_right_list_item tbody", function() {
});

$('body').on('click', ".selected_options_delete_option", function() {
   
   var index = $(this).parent().index();
   $(this).parent().remove();
   $(".product_options_right_list_item").eq(index).remove();
});

$('body').on('click', ".delete_item_option", function() {
  $(this).parent().parent().remove();
  alert("regreg");
});

$('body').on('click', ".add_new_edit", function() {
 
 var id_option = $(this).attr('data-option');
 var elememt = $(this);
 get_list_options(id_option);
   setTimeout(function() {
 var  html = '<tr>'+
                        '<td>'+
                         '<select name="options_item[]" id="" class="choose_option">'+
                          results+
                         '</select>'+
                       '</td>'+
                       '<td>'+
                         '<input type="number" name="amount_option[]" step="0.01">'+
                       '</td>'+
                       '<td style="text-align: center;">'+
                         '<button class="delete_item_option">'+
                           '<i class="fa fa-minus"></i>'+
                         '</button>'+
                       '</td>'+
                     '</tr>';
  $(elememt).parent().parent().parent().find("tbody").append(html);
},500);
});


});