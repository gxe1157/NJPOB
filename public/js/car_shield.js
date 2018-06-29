/* manage users table control  */

/* Build obj to be used by model_js */
var model_js_mess = {
        'delete' : '<h3>Delete this account?</h3>',
        'suspend': '<h3>Suspend this account?</h3>',
        'reset_pswrd' : '<h3>Reset Password?</h3>',
        'submit_option' : 'NewCarShield'
    }

var errors_array= [];

var fldNames = {
  'make' :'Make',
  'model' :'Model',
  'color' : 'Color',
  'model_year' :'Model Year',
  'plate_no' :'Plate Number',
  'vin_no' :'Vin Number'
}


/*----- jquery -----*/
$(document).ready(function (e) {
  if( $('#dl_required').val() == 1)
      fldNames['driver_lic'] = 'Driver\'s License';    
    
  if( $('#ss_required').val() == 1){
      fldNames['social_sec'] = 'Soical Security';
      fldNames['ss_confirm'] = 'Confirm Social Secuity';
  }
  model_js_mess.fldNames = fldNames;
}); // jquery end


$('#add_car_shield').on('click', function () {
    let max_shields = _('max_shields').value;
    let num_rows = _('num_rows').value;

    if( num_rows >= max_shields ){
      myAlert('Attention','<b>Sorry, We can not process your request.<br /> The total limit of Car Shields that may be leased is '+max_shields+'</b>');        
      return;
    }
        
    window.location.replace( dir_path+"car_shields/process_payment" );      
});


$('.btn-edit').on('click', function (e) {
    e.preventDefault();

    let myHeader = this.id;
    let editId = (this.id).split('-');
    let rowId = editId[1].split('/');

    let formData = new FormData();
    formData.append('rowId', rowId[0] );
    formData.append('userId', rowId[1] );    


    $.ajax({
      url: dir_path+'car_shields/modal_fetch_ajax', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,      
      success : function(data){
        // console.log( 'Return Data:......  ', data);
        let response = JSON.parse( data );
        // console.log( 'Return Data:......  ', response);
        openModal();

        if( response['success'] == 1 ){
          let columns = response['mysqlRows'];
          /* assign values to modal */
          $('#rowId').val(columns['id']);
          for ( var key in columns ) {
            if (columns.hasOwnProperty(key)){
              if( key !== 'contains' ) {
                 $('#'+key).val(columns[key]);
              }
            }
          } //foreach
          // console.log( 'Data:......  ', columns);        
           
        } else {
          myAlert('Error!','<b>Record failed to be added to database.</b>');
          console.log('Error: Record failed to be added to database.');            
        } 
      }

    });
});

function openModal(){
    model_js_mess.submit_option = null;
    let myHeader = 'Car Shield';
    let myBuild = '';
    myBuild = build_form_inputs();

    ezBSAlert({
      type: "myForm",
      messageText: myBuild,
      headerText : myHeader,
      alertType: "primary",
      button_mess: "Submit"            
    }).done(function (e) {
      // console.log('href '+href);  
    // if( e ) window.location.replace( href );     
    });
}


function add_data_ajax(){
    let formData = new FormData();
    let getData = $('#myModel').find(':input').serializeArray();
    $.each(getData, function(i, field){
        formData.append( field.name, field.value);  
        // console.log('jdata', field.name, field.value );
    });

    $.ajax({
      url: dir_path+'car_shields/modal_post_ajax', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        // console.log( 'Return Data:......  ', data);
        var response = JSON.parse( data );
        // console.log( 'Return Data:......  ', response);

        if( response['success'] == 1 ){
            /* Success */
            let target_url = $('#set_dir_path').val() == 0 ? 'manage_admin' : 'member_manage';
            let href= dir_path+"car_shields/"+target_url;

            /* getData[0].value is rowId If empty go to payment process */
            if( getData[0].value < 1 ) {
              window.location.replace( dir_path+"car_shields/process_payment" );
            } else {
              window.location.replace( href );
            }    

        } else if ( response['success'] == 2 ) {
            /* Failed to write t drive */
            myAlert('Error!','<b>Record failed insert/update to database.</b>');
        } else {  
          /* Failed validation */
          errors_array = response['errors_array'];
          for ( var key in errors_array ) {
            if (errors_array.hasOwnProperty(key)){
              if( key !== 'contains' ) {
                $('#error_'+key).html(errors_array[key])
              }
            }
          }
        }	
      }// success
    })  
}

