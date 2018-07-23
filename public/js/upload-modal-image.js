/* upload-modal-image */

// var img ={};
// var output = {};
// var dupe_found = [];
var client_files = [];

var model_js_mess = {
    'delete' : '<h3>Remove this document?</h3>',
    'suspend': '<h3>Suspend this user account?</h3>'
}


function imgFileInfo( imageId ) {
    var file = _(imageId).files[0];
    console.log(file.name+" | "+file.size+" | "+file.type );
    return file.name;
}

/* ------- Dedupe functions -------*/
function dedupe(){
    // from client
    var file = imgFileInfo( 'imageFile' );
    var a = client_files.indexOf(file);
    if( a == -1 ){
      client_files.push(file);
    } else {
    // console.log(client_files, file );
    var prom = ezBSAlert({
                  messageText: file+" has already been selected.<br>Please enter a different image.",
                    alertType: "danger"
                  }).done(function (e) {
                    $("body").append('<div>Callback from alert</div>');
                });
      return false;
    }

}

function cancel( obj ){
  if( obj != undefined )
      assign_id(obj.id);

  // from client
  var file = imgFileInfo( 'imageFile' );
  client_files_remove(file);
  noPreview();
}

function client_files_remove(fileName){
  // console.log('remove: ',fileName+'...', client_files);
  let index = client_files.indexOf(fileName);
  if (index > -1) {
      client_files.splice(index, 1);
  }
  // console.log('Done.... ', client_files);
}

function noPreview(){
  $( '#imageFile').val('');  
  $( '#preview' ).css("display", "none");  
}

function imagePath(image){
  let folder = _('module').value;
  fullImageName = dir_path+'upload/'+folder+'/'+image;
  return fullImageName;
}

function previewImg(image) {
  let imageSource = imagePath(image);

  $( '#uploadModal #pre_upload' ).css("display", "none");      
  $( '#update_button' ).css("display", "block");    
  $( '#preview' ).css("display", "block");  
  $( '#modelPreviewImg' ).attr('src', imageSource );
}

function selectImage(e) {
  $('#modelPreviewImg').attr('src', e.target.result);
  $('#preview').css("display", "block");      
  $( '#submit_button' ).css("display", "block");
}

function remove( obj ){ 
  let controller = _('module').value;  
  let manage_rowid  = _('manage_rowid').value;            
  let required_docs = 0;
  let id = (obj.id).split('|');    
  let img_id = id[0];    
  let position = id[1];      
  let img_name = obj.value;
  let messText  = "Do you want to remove "+img_name+"?";
  // console.log( $('#upload-image-form').serializeArray() );

  ezBSAlert({
    type: "confirm",
    messageText: messText,
    alertType: 'danger'
  }).done(function (e) {
    if( e ) {
      let formData = new FormData(this);
      formData.append('controller', controller );      
      formData.append('manage_rowid', manage_rowid );      
      formData.append('required_docs', required_docs );
      formData.append('img_id', img_id );
  
      $.ajax({
        url: dir_path+controller+'/ajax_remove_one',
        method:"POST",
        data: formData,
        contentType: false,
        cache: false,
        processData:false,      
        success : function(data){
          // console.log( 'Return Data:......  ', data);
          let response = JSON.parse( data );
          // console.log( 'Return Data:......  ', response);
          if( response['success'] == 1 ){
              $('#tr'+position).remove();
              client_files_remove(response["remove_name"]);                 
          } else {
            myAlert('Error!',response['flash_message']);
            // console.log('Error: Record failed to be added to database.');            
          } 
        }
      });
    }
  });
}


function image_path(image){
  let path = [];
  let array = image.split('/');
  let len = array.length;
  let upload_path = array.splice(len -3, 3).join('/');
  return  dir_path+upload_path;
}

function build_table_row(response){
  response['show_img'] = image_path(response['full_path']);
  let table_row  = '<tr id="tr'+response['image_position']+'" ><td><img src="'+response['show_img']+'" class ="img img-responsive" style="width: 100%;"></td>';
      table_row += '<td class="right">'+response['caption']+'</td>';
      table_row += '<td class="right" id="image_name_'+response['image_position']+'">'+response['client_name']+'</td>';
      table_row += '<td class="right" id="image_date_'+response['image_position']+'">'+response['image_date']+'</td>';
      table_row += '<td class="center">';
      table_row += '<button class="btn btn-danger btn-sm" id="'+response['record_id']+'|'+response['image_position']+'" value="'+response['remove_name']+'" type="button" ';
      table_row += '  onClick="javascript: remove(this)" ><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</button>';
      table_row += ' <button  class="btn btn-info btn-sm btn-edit" id="'+response['record_id']+'|'+response['image_position']+'" type="button"';
      table_row += 'onClick="javascript: edit(this) "> Edit Caption</button>';
      table_row += '</td></tr>';
      return table_row;
}

function edit(obj) {
    let idArrayrowId = (obj.id).split('|');   
    let rowId = idArrayrowId[0];
    let position = idArrayrowId[1];
    let controller = _('module').value;
    let caption = $('#caption_'+position).html();

    $("#uploadModal").modal('toggle');

    /* assign values to modal */
    $('#uploadModal #rowId').val(rowId);
    $('#uploadModal #show_rowId').val(rowId);  
    $('#uploadModal #image_position').val(position);      
    $('#uploadModal #caption').val(caption);      

    let path = $('#img_'+position).attr('src');
    let filename = path.replace(/^.*[\\\/]/, '');
    previewImg(filename);

};


/*----- jquery -----*/
$(document).ready(function (e) {
  $('#openUploadModal').on('click', function () {
      noPreview();
      $( '#uploadModal #pre_upload' ).css("display", "block");           
      $('#show_rowId').val('');          
      $('#uploadModal').modal();
      $('#submit_button').css("display", "none");             
  })

  $('#uploadModal').on('hidden.bs.modal', function () {
      if( _('imageFile') && _('imageFile').value != '' ) {
        let fileName = imgFileInfo( 'imageFile' );
        client_files_remove(fileName);    
      }      

      $('#show_rowId').val('');      
      $( '#submit_button' ).css("display", "none");
      $( '#update_button' ).css("display", "none");
  })

  $('#updateRecord').on('click',function (){
    let rowId = _('rowId').value;
    let position = _('image_position').value;
    let controller = _('module').value;

    let formData = new FormData(this);
    formData.append('rowId', rowId );
    formData.append('caption', _('caption').value);

    $.ajax({
      url: dir_path+controller+'/modal_post_ajax',
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,      
      success : function(data){
        // console.log( 'Return Data:......  ', data);
        let response = JSON.parse( data );
        // console.log( 'Return Data:......  ', response);

        if( response['success'] == 1 ){
          $("#uploadModal").modal('toggle');          
          $('#caption_'+position).html(response['new_caption']);
        } else {
          $('#caption').val('');
          myAlert('Error!','<b>'+response['flash_message']+'</b>');
          console.log('Error: Record failed to be added to database.');            
        }
      } //Success   
    });
  });

  $('#upload-image-form').submit( function( e ) {
      let position = 0;    
      let parent_cat = 0;
      let required_docs = 0;
      let controller = _('module').value;
      let member_id = _('member_id').value || 0;
      let img_id = _('rowId').value;  
      e.preventDefault();

  // console.log( $('#upload-image-form').serializeArray() );

      let formData = new FormData(this);
      formData.append('position', position);
      formData.append('parent_cat', parent_cat );
      formData.append('required_docs', required_docs );
      formData.append('controller', controller);    
      formData.append('member_id', member_id );
      formData.append('manage_rowid', _('manage_rowid').value );
      formData.append('caption', _('caption').value );
      formData.append('img_id', img_id );    

      $.ajax({
        url: dir_path+controller+'/ajax_upload_one',
        method:"POST",
        data: formData,
        contentType: false,
        cache: false,
        processData:false,      
        success : function(data){
          // console.log( 'Return Data:......  ', data);
          let response = JSON.parse( data );
          console.log( 'Return Data:......  ', response);

          let callback = function () { $("#uploadModal").modal('toggle'); }
          if( response['success'] == 1 ){
            $("#uploadModal").modal('toggle');

            let table_row =  build_table_row(response);
            if(response['new_update_id']>0) {
              $( table_row ).appendTo('#table_contents');
            }else{
              $('#tr_'+response['image_position']).html(table_row);
            }

          } else {
            myAlert('Error!',response['error_mess']);
            // console.log('Error: Record failed to be added to database.');            
          } 
        }
      });
      // e.preventDefault();
    } );

  if( $('#dbf_images').val() !== undefined )
        client_files = $.parseJSON( $('#dbf_images').val() );

  /* On change */
  $('#upload-image-form input[type="file"]').change(function() {
    // from server
    var maxsize = 1024 * 1024; // 500 KB

    /* check for dupes here */
    var proceed = dedupe();
    if( proceed == false ) {
      noPreview();
      return;
    }

    /* check for file attributes */
    var file = this.files[0];
    var match = ["image/jpeg", "image/png", "image/jpg"];

    if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) ) {
      noPreview();
      // $('#message_'+img['id']).html('<div class="alert alert-warning error_messages" role="alert">Unvalid image format. Allowed formats: JPG, JPEG, PNG.</div>');

      return false;
    }

    if ( file.size > maxsize ) {
      noPreview();
      // $('#message_'+img['id']).html('<div class=\"alert alert-danger error_messages\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');

      return false;
    }

    /* preview selected image */
    var reader = new FileReader();
    reader.onload = selectImage;
    reader.readAsDataURL(this.files[0]);

  });


});
