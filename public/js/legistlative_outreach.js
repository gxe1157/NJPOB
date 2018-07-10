/* manage users table control  */

/* Build obj to be used by model_js */
var model_js_mess = {
        'delete' : '<h3>Delete this account?</h3>',
        'suspend': '<h3>Suspend this account?</h3>',
        'reset_pswrd' : '<h3>Reset Password?</h3>',
        'submit_option' : null
    }

var errors_array= [];
// 'username',
var fldNames = {'first_name':'First Name', 'last_name' : 'Last Name', 'middle_name':'Middle Name', 'address1':'Address1',
				'address2':'Address2', 'city':'City', 'state': 'State', 'zip':'Zip', 'occupation':'Occupation', 'phone':'Phone', 'cell_phone':'Cell Phone',
 				'dob':'Date of Birth ( mm/dd/yyyy )', 'email': 'Email' };

model_js_mess.fldNames = fldNames;

function editBtn( obj ){
    let rowId = ( obj.id ).split('/');
    let formData = new FormData();
    formData.append('rowId', rowId[0] );
    formData.append('userId', rowId[1] );    
// alert( rowId[0]+' | '+rowId[1]);

    $.ajax({
      url: dir_path+'legislative_outreach/modal_fetch_ajax',
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,      
      success : function(data){
        // console.log( 'Return Data:......  ', data);
        let response = JSON.parse( data );
        console.log( 'Return Data:......  ', response);

        $( ".btnSubmitForm" ).trigger( "click" );

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
          // console.log('Successfully added record to database.' );
        } else {
          myAlert('Error!','<b>Record failed to be added to database.</b>');
          console.log('Error: Record failed to be added to database.');            
        } 
      }

    });
};

function add_data_ajax(){
    let formData = new FormData();
    let getData = $('#myModel').find(':input').serializeArray();
    let row_id = 0;

    $.each(getData, function(i, field){
        formData.append( field.name, field.value);  
        // console.log('jdata', field.name, field.value );
        if( field.name == 'rowId') { row_id = field.value;}
    });

    formData.append( 'update_id', _('update_id').value);  

    $.ajax({
      url: dir_path +'legislative_outreach/modal_post_ajax', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        //console.log( 'Return Data:......  ', data);
        var response = JSON.parse( data );
        // console.log( 'Return Data:......  ', response);

        if( response['success'] == 1 ){
          /* Success */
          if(response['new_update_id'] > 0) {
            // New Record Added
            $( response['table_lines'] ).appendTo('#example');
          }else{
            // Update Record
            $('#tr_'+row_id).html(response['table_lines']);
            // console.log(response['table_lines']);
          }
          let flash_type = response['flash_type'];
          myAlert( 'Alert'+' ! ',response["flash_message"], flash_type );

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

