 $(document).ready(function() {


//
 $('body').on('click', ".search_attribute", function() {
   $(this).parent().find(".attributes_list").css('display','block');
 });

 $('body').on('click',".choose_attribute", function() {

   var name_attribute = $(this).attr("data-name");
   var id_attribute = $(this).attr('data-attribute');
   $(this).parent().parent().parent().parent().parent().find('.search_attribute').val(name_attribute);
   $(this).parent().parent().parent().parent().parent().find('.search_attribute_id').attr("value", id_attribute);
   $(this).parent().parent().parent().parent().parent().find('.attributes_list').css("display","none");
 });

 $('body').on("keypress" ,".search_attribute", function (e)  {
  var value = $(this).val();
  $.ajax({
  url: attributes_url,
  data: { "attribute": value },
  success: function(data){ 
      
      var html = '';
      
      if (data.type == 1) {
       for (i = 0; i < data.attributes.length; i++) {
        var list_attributes = "";
        if (data.attributes[i]['attributes_items'].length != 0) {
         list_attributes = '<p class="attributes_list_item_list_item choose_attribute" data-attribute="'+data.attributes[i]['attributes_items'][0]['id']+'" data-name="'+data.attributes[i]['attributes_items'][0]['name']+'">'+data.attributes[i]['attributes_items'][0]['name']+'</p>';
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

$(".add_new_attribute").click(function() {
  $(".attributes_list").css("display","none");
  html_attributes = $('.attributes_list_parent').html();
   html = '<tr>'+
                      '<td style="width: 30%;position: relative;">'+
                        '<input type="text" class="search_attribute" name="attribute" autocomplete="off">'+
                        '<input type="text" class="search_attribute_id" name="attributes[]" style="display: none;">'+
                        '<div class="attributes_list" style="display: none;">'+
                         html_attributes+
                        '</div>'+
                      '</td>'+
                      '<td>'+
                        '<input type="text" name="attributes_values[]">'+
                      '</td>'+
                      '<td style="text-align: center;">'+
                        '<button class="delete_new_attribute btn-danger">'+
                         '<i class="fa fa-trash"></i>'+
                        '</button>'+
                      '</td>'+
                    '</tr>';

  $('.attributes_table tbody').append(html);
});

$('body').on("click" ,".delete_new_attribute",  function() {
   $(this).parent().parent().remove();
});
});