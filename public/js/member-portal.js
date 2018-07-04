

/*----- jquery -----*/
$(document).ready(function (e) {

  function noPreview_avatar(){
    let user_avatar = document.getElementById('user_avatar').value;
    $( 'input[type="file"]').val('');
    $( '#pre_upload' ).css("display", "block");
    $( '#previewImg').attr('src', dir_path+'upload/avatars/'+user_avatar );
    $( '#confirm_upload').css("display", "none");
  }

  $("#change_password").click(function (e) {
      $( '#new_password' ).css("display", "block");
      $( '#profile_div' ).css('display', 'none');
  });

  $("#cancelImg").click(function (e) {
      noPreview_avatar();
  });

  function selectImage_avatar(e) {
    $( '#previewImg').attr('src', e.target.result).css("height","150").css("width","200");
    $( '#confirm_upload' ).css("display", "block");
    $( '#pre_upload' ).css("display", "none");
  }

  var maxsize = 1024 * 1024; // 500 KB
  $('#max-size').html((maxsize/1024).toFixed(2));

  $('#remove_avatar').on('click', function( ) {
    var messText  = "Do you want to remove avatar image ?";
    ezBSAlert({
      type: "confirm",
      messageText: messText,
      alertType: 'danger'
    }).done(function (e) {
      if( e ) {
        let formData = new FormData();
        formData.append( 'update_id', _('update_id').value );           

        let target_url = dir_path+'site_upload/users_upload/ajax_remove_avatar';
        upload_ajax_avatar( target_url, formData );
      }
    });
  });

  /* Avatar submit */
  $('#upload-image-avatar').on('submit', function(e) {
    $( '#upload-button').prop("disabled",true);
    $( '#cancelImg').prop("disabled",true);

    e.preventDefault();

    let target_url = dir_path+'site_upload/users_upload/ajax_upload_one';
    let formData = new FormData(this);
    formData.append( 'update_id', _('update_id').value );           

    upload_ajax_avatar( target_url, formData );
  });


  function upload_ajax_avatar(target_url, formData) {
    $.ajax({
      url: target_url,
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        var imgData = JSON.parse( data );
        // console.log( 'Return Data:......  ', imgData, imgData['file_name'] );
        document.getElementById('user_avatar').value = imgData['file_name'];

        $( '#upload-button').prop("disabled",false);
        $( '#cancelImg').prop("disabled",false);
        $( '#confirm_upload').css("display", "none");
        $( '#pre_upload').css("display", "block");

       if( imgData['file_name'] == 'annon_user.png' ) noPreview_avatar();

      }

    });
  }

  /* On change */
  $('#upload-image-avatar').on('change','#avatar', function() {
    /* assign to value to img obj */
    var img_id = this.id;
    $('#message').empty();

    /* check for file attributes */
    var file = this.files[0];
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) ) {
      noPreview_avatar();
      $('#message').html('<div class="alert alert-warning error_messages" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');
      return false;
    }

    if ( file.size > maxsize ) {
      noPreview_avatar();
      $('#message').html('<div class=\"alert alert-danger error_messages\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');
      return false;
    }
    console.log('Upload Image');

    /* preview selected image */
    var reader = new FileReader();
    reader.onload = selectImage_avatar;
    reader.readAsDataURL(this.files[0]);

  });

}); // jquery end


