(function ($) {
  'use strict';

  var galleryDefaults = {
    csrfToken: $('meta[name=csrf-token]').attr('content'),
    csrfTokenName: $('meta[name=csrf-param]').attr('content'),

    nameLabel: 'Name',
    descriptionLabel: 'Description',

    hasName: true,
    hasDesc: true,
    uploadUrl: '',
    deleteUrl: '',
    updateUrl: '',
    arrangeUrl: '',

    photos: [],

    is_sold: false
  };

  function galleryManager(el, options) {
    //Extending options:
    var opts = $.extend({}, galleryDefaults, options);
    //code
    var csrfParams = opts.csrfToken ? '&' + opts.csrfTokenName + '=' + opts.csrfToken : '';
    var photos = {}; // photo elements by id
    var $gallery = $(el);
    if (!opts.hasName) {
      if (!opts.hasDesc) {
        $gallery.addClass('no-name-no-desc');
        $('.edit_selected', $gallery).hide();
      }
      else $gallery.addClass('no-name');

    } else if (!opts.hasDesc)
      $gallery.addClass('no-desc');

    var $sorter = $('.sorter', $gallery);
    var $images = $('.images', $sorter);
    var $editorModal = $('.editor-modal', $gallery);
    var $progressOverlay = $('.progress-overlay', $gallery);
    var $uploadProgress = $('.upload-progress', $progressOverlay);
    var $editorForm = $('.form', $editorModal);

    function htmlEscape(str) {
      return String(str)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
    }

    function createEditorElement(id, src, name, description) {

      var html = '<div class="photo-editor row">' +
        '<div class="col-xs-4">' +
        '<img src="' + htmlEscape(src) + '"  style="max-width:100%;">' +
        '</div>' +
        '<div class="col-xs-8">' +

        (opts.hasName
          ?
        '<div class="form-group">' +
        '<label class="control-label" for="photo_name_' + id + '">' + opts.nameLabel + ':</label>' +
        '<input class="form-control" type="text" name="photo[' + id + '][name]" class="input-xlarge" value="' + htmlEscape(name) + '" id="photo_name_' + id + '"/>' +
        '</div>' : '') +

        (opts.hasDesc
          ?
        '<div class="form-group">' +
        '<label class="control-label" for="photo_description_' + id + '">' + opts.descriptionLabel + ':</label>' +
        '<textarea class="form-control" name="photo[' + id + '][description]" rows="3" cols="40" class="input-xlarge" id="photo_description_' + id + '">' + htmlEscape(description) + '</textarea>' +
        '</div>' : '') +

        '</div>' +
        '</div>';
      return $(html);
    }


    var photoTemplate = '<div class="playlist-item photo "><div class="playlist-item__image">' + '<img src="" alt=""><div class="playlist-item__description">';
    if (opts.hasName) {
      photoTemplate += '<p class="playlist-item__description__item"></p>';
    }
    if (opts.hasData) {
      photoTemplate += '<p class="playlist-item__description__item__data"></p>';
    }
    if (opts.hasTime) {
      photoTemplate += '<p class="playlist-item__description__item__timing"></p>';
    }

   
    if (opts.hasDesc) {
      photoTemplate += '<p></p>';
    }
    photoTemplate += '</div></div>';

    if (opts.allow_edit ) {
      // glyphicon glyphicon-pencil glyphicon-white
    //  photoTemplate += '<div class="item__description__change"><a class="editPhoto btn  change__user btn-xs"><i class="fa fa-pencil"></i></a> ';
    }
if (opts.allow_delete ) {

    // glyphicon glyphicon-remove glyphicon-white
    photoTemplate += '<div class="item__description__change"><span class="deletePhoto btn delete__user btn-danger btn-xs"><i class="fa fa-trash"></i></span></div>' +
    
    '</div></div>';
}

    function addPhoto(id, src, name, description, rank,data,time,is_admin) {

      var photo  = $(photoTemplate);
      photos[id] = photo;
      photo.data('id', id);
      photo.data('rank', rank);
      
      $('img', photo).attr('src', opts.baseurl+"uploads/files/"+name);
      if (opts.hasName){
        $('p.playlist-item__description__item', photo).text(name);
        $('a.editPhoto', photo).attr("href",opts.baseurl+"admin/media/edit/"+id+"");
      }
      if (opts.hasDesc){
        $('.caption p', photo).text(description);
      }
       if (opts.hasData){
        $('p.playlist-item__description__item__data', photo).text(data);
      }
      if (opts.role==1 && is_admin==1)
      {
         $('.deletePhoto', photo).remove();     
      }
      if (opts.hasTime){
        $('p.playlist-item__description__item__timing', photo).text(time);
      }

      $images.append(photo);
      return photo;
      
    }


    function editPhotos(ids) {
      var l = ids.length;
      var form = $editorForm.empty();
      for (var i = 0; i < l; i++) {
        var id = ids[i];
        var photo = photos[id],
          src = $('img', photo).attr('src'),
          name = $('.caption h5', photo).text(),
          description = $('.caption p', photo).text();
        form.append(createEditorElement(id, src, name, description));
      }
      if (l > 0){
        if (!!$.fn.modal) {
          $editorModal.modal('show');
        } else {
          $editorModal.addClass('in').show();
        }
      }
    }

    function removePhotos(ids) {
      console.log('id[]=' + ids.join('&id[]=') + csrfParams);
       $(".photo.selected").css('display','none');
       $(this).parent().parent().parent().css('display','none');
      $.ajax({
        type: 'POST',
        url: opts.deleteUrl,
        data: 'id[]=' + ids.join('&id[]=') + csrfParams,
        success: function (t) {

          if (this.status == 200) {
              var resp = JSON.parse(this.response);
             
              console.log(resp);
              console.log(resp.length);
              addPhoto(resp['id'], resp['file'], resp['preview'],"","");
              ids.push(resp['id']);
            }

          if (t == 'OK') {
            for (var i = 0, l = ids.length; i < l; i++) {
              photos[ids[i]].remove();
              delete photos[ids[i]];
            }
          } else {
           /* alert(t); */
          }
        }
      });
    }


    function deleteClick(e) {
      e.preventDefault();
      var photo = $(this).closest('.photo');
      var id = photo.data('id');
      // here can be question to confirm delete
      // if (!confirm(deleteConfirmation)) return false;
      removePhotos([id]);
      updateButtons();
      $(this).parent().parent().css("display","none");
      return false;
    }

    function editClick(e) {
      e.preventDefault();
      var photo = $(this).closest('.photo');
      var id = photo.data('id');
      editPhotos([id]);
      return false;
    }

    function updateButtons() {
      var selectedCount = $('.photo.selected', $sorter).length;
      $('.select_all', $gallery).prop('checked', $('.photo', $sorter).length == selectedCount);
      if (selectedCount == 0) {
        $('.edit_selected, .remove_selected', $gallery).addClass('disabled');
      } else {
        $('.edit_selected, .remove_selected', $gallery).removeClass('disabled');
      }
    }

    function selectChanged() {
      var $this = $(this);
      if ($this.is(':checked'))
        $this.closest('.photo').addClass('selected');
      else
        $this.closest('.photo').removeClass('selected');
      updateButtons();
    }

    $images
      .on('click', '.photo .deletePhoto', deleteClick)
      .on('click', '.photo .editPhoto', editClick)
      .on('click', '.photo .photo-select', selectChanged);


    $('.images', $sorter).sortable({cancel: ".fixed",tolerance: "pointer"}).disableSelection().bind("sortstop", function () {
      var data = [];
      $('.photo', $sorter).each(function () {
        
        var t = $(this);
        data.push('order[' + t.data('id') + ']=' + t.data('rank'));
      });
      console.log(data.join('&') + csrfParams); 
      var datas=data.join('&') + csrfParams;
      $.ajax({
        type: 'POST',
        url: opts.arrangeUrl,
        data: data.join('&') + csrfParams,
        dataType: "json"
      }).done(function (data) {
        console.log(data);
        for (var id in data[id]) {
          photos[id].data('rank', data[id]);
        }
        // order saved!
        // we can inform user that order saved
      });
    });

    if (window.FormData !== undefined) { // if XHR2 available
      var uploadFileName = $('.afile', $gallery).attr('name');

      var multiUpload = function (files) {
        if (files.length == 0) return;
        $progressOverlay.show();
        $uploadProgress.css('width', '5%');
        var filesCount = files.length;
        var uploadedCount = 0;
        var ids = [];
        for (var i = 0; i < filesCount; i++) {
          var fd = new FormData();

          fd.append(uploadFileName, files[i]);
          fd.append('is_sold', +opts.is_sold);
          if (opts.csrfToken) {
            fd.append(opts.csrfTokenName, opts.csrfToken);
          }
          var xhr = new XMLHttpRequest();
          xhr.open('POST', opts.uploadUrl, true);
          xhr.onload = function () {
            uploadedCount++;
            var i=0;
            console.log(this.response);
            if (this.status == 200) {
              var resp = JSON.parse(this.response);
             

              addPhoto(resp['id'], resp['file'], resp['preview'],"","");
              ids.push(resp['id']);
              i=i++;
            } else {
              // exception !!!
            }
            $uploadProgress.css('width', '' + (5 + 95 * uploadedCount / filesCount) + '%');

            if (uploadedCount === filesCount) {
              $uploadProgress.css('width', '100%');
              $progressOverlay.hide();
              // if (opts.hasName || opts.hasDesc) editPhotos(ids);
            }
          };
          xhr.send(fd);
        }

      };

      (function () { // add drag and drop
        var el = $gallery[0];
        var isOver = false;
        var lastIsOver = false;

        setInterval(function () {
          if (isOver != lastIsOver) {
            if (isOver) el.classList.add('over');
            else el.classList.remove('over');
            lastIsOver = isOver
          }
        }, 30);

        function handleDragOver(e) {
          e.preventDefault();
          isOver = true;
          return false;
        }

        function handleDragLeave() {
          isOver = false;
          return false;
        }

        function handleDrop(e) {
          e.preventDefault();
          e.stopPropagation();


          var files = e.dataTransfer.files;
          multiUpload(files);

          isOver = false;
          return false;
        }

        function handleDragEnd() {
          isOver = false;
        }


        el.addEventListener('dragover', handleDragOver, false);
        el.addEventListener('dragleave', handleDragLeave, false);
        el.addEventListener('drop', handleDrop, false);
        el.addEventListener('dragend', handleDragEnd, false);
      })();

      $('.afile', $gallery).attr('multiple', 'true').on('change', function (e) {
        e.preventDefault();
        multiUpload(this.files);
        $(this).val(null);
      });
    } else {
      $('.afile', $gallery).on('change', function (e) {
        e.preventDefault();
        var ids = [];
        $progressOverlay.show();
        $uploadProgress.css('width', '5%');

        var data = {
          is_sold: +opts.is_sold
        };
        if (opts.csrfToken) {
          data[opts.csrfTokenName] = opts.csrfToken;
        }
        $.ajax({
          type: 'POST',
          url: opts.uploadUrl,
          data: data,
          files: $(this),
          iframe: true,
          processData: false,
          dataType: "json"
        }).done(function (resp) {
                        console.log(resp);
              console.log(Object.keys(resp));
          addPhoto(resp['id'], resp['preview'], resp['name'], resp['description'], resp['rank']);
          ids.push(resp['id']);
          $uploadProgress.css('width', '100%');
          $progressOverlay.hide();
          if (opts.hasName || opts.hasDesc) editPhotos(ids);
        });
      });
    }

    $('.save-changes', $editorModal).click(function (e) {
      e.preventDefault();
      $.post(opts.updateUrl, $('input, textarea', $editorForm).serialize() + csrfParams, function (data) {
        alert(data);
        var count = data.length;
        for (var key = 0; key < count; key++) {
          var p = data[key];
          var photo = photos[p.id];
          $('img', photo).attr('src', p['src']);
          if (opts.hasName)
            $('.caption h5', photo).text(p['name']);
          if (opts.hasDesc)
            $('.caption p', photo).text(p['description']);
        }
        if (!!$.fn.modal) {
          $editorModal.modal('hide');
        } else {
          $editorModal.removeClass('in').hide();
        }
        //deselect all items after editing
        $('.photo.selected', $sorter).each(function () {
          $('.photo-select', this).prop('checked', false)
        }).removeClass('selected');
        $('.select_all', $gallery).prop('checked', false);
        updateButtons();
      }, 'json');

    });

    $('.edit_selected', $gallery).click(function (e) {
      e.preventDefault();
      var ids = [];
      $('.photo.selected', $sorter).each(function () {
        ids.push($(this).data('id'));
      });
      editPhotos(ids);
      return false;
    });

    $('.remove_selected', $gallery).click(function (e) {
      e.preventDefault();
      var ids = [];
      $('.photo.selected', $sorter).each(function () {
        ids.push($(this).data('id'));
      });
      removePhotos(ids);

    });

    $('.select_all', $gallery).change(function () {
      if ($(this).prop('checked')) {
        $('.photo', $sorter).each(function () {
          $('.photo-select', this).prop('checked', true)
        }).addClass('selected');
      } else {
        $('.photo.selected', $sorter).each(function () {
          $('.photo-select', this).prop('checked', false)
        }).removeClass('selected');
      }
      updateButtons();
    });

    for (var i = 0, l = opts.photos.length; i < l; i++) {
      var resp = opts.photos[i];
      addPhoto(resp['id'], resp['preview'], resp['name'], resp['description'], resp['rank'],resp['data'],resp['time'],resp['is_admin']);
      console.log(resp['is_admin']);
    }
  }

  // The actual plugin
  $.fn.galleryManager = function (options) {
    if (this.length) {
      this.each(function () {
        galleryManager(this, options);
      });
    }
  };
})(jQuery);
