/* Build obj to be used by model_js */
var model_js_mess = {
        'delete' : '<h3>Delete this account?</h3>',
        'suspend': '<h3>Suspend this account?</h3>',
        'reset_pswrd' : '<h3>Reset Password?</h3>',
        'submit_option' : null
}

const fldNames = {'child_fname':'First Name', 'child_lname' : 'Last Name',
                'child_dob':'Date of Birth', 'child_gender': 'Gender' };

model_js_mess.fldNames = fldNames;

function prvSectorUpdate( ) {
    let arg = prv_sector_arg();
    $(".clear_error_mess").html('');     

    $('#prv_sector_employer').prop( 'disabled', arg);
    $('#prv_sector_dept').prop( 'disabled', arg);              
    $('#prv_sector_position').prop( 'disabled', arg);              
    $('#prv_sector_add1').prop( 'disabled', arg);                            
    $('#prv_sector_add2').prop( 'disabled', arg);                            
    $('#prv_sector_city').prop( 'disabled', arg);                            
    $('#prv_sector_state').prop( 'disabled', arg);                            
    $('#prv_sector_zip').prop( 'disabled', arg);
    $('#prv_sector_email').prop( 'disabled', arg);                                          
    $('#prv_sector_phone').prop( 'disabled', arg);                                                        
    $('#prv_sector_dt_hired').prop( 'disabled', arg);                                                        
}

function prv_sector_arg() {
    let arg = $('#prv_sector').val() == 'Yes' ? false : true;
    return arg;
} 

function save_changes_ajax( id ){
    let update_flds = {};
    let formData = new FormData();
    let div_id = id.split('-');

    let jdata = div_id[1]; // This is the id of the div we want data from.
    let getData = $('#'+jdata).find(':input').serializeArray();

    formData.append( 'fld_group', div_id[1] );              
    formData.append( 'id', div_id[2]);                            
    $.each(getData, function(i, field){
        formData.append( field.name, field.value);  
        update_flds[field.name] = field.value; 
    });
    
    $.ajax({
      url: dir_path+'site_users/save_changes_ajax', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        $(".clear_error_mess").html('');            

        let response = JSON.parse(data);
        console.log(response);

        if( response['success'] == 1 ) {
            let message = response['flash_type'];
            myAlert( jsUcfirst(message)+' ! ',response["flash_message"], message );

            if( update_flds['first_name'] || update_flds['last_name'] )
               $('#fullname').html( update_flds['first_name']+' '+update_flds['last_name']);

            if( update_flds['social_sec'] ) {
                let last4_social = 'xxx-xx-'+(update_flds['social_sec']).substr(5,4);
                $('#social_sec').val(last4_social);
            }
                
            change_occurred = false;
            // console.log('update_flds',update_flds);

        } else {
          // console.log('response',response);
          myAlert('Error!',response["flash_message"], 'danger');

          let error_message = response['errors_array'];
          for ( var key in error_message ) {
            if (error_message.hasOwnProperty(key)){
              if( key !== 'contains' ) {
                $('.'+key).html(error_message[key]);               
              }
            }
          }
        } //data

      }// success

    })  
 
}



$(document).ready(function() {
    prvSectorUpdate();    

    $('#prv_sector').on('change', function(){
        prvSectorUpdate();
    })

    $('input[name="dob"], input[name="spouse_dob"], input[name="child_dob"], input[name="le_dt_hired"], input[name="prv_sector_dt_hired"]').on('keydown', function(event) {
        formatData(this,event,'DOWN','date');
    })

    $('input[name="dob"], input[name="spouse_dob"], input[name="child_dob"], input[name="le_dt_hired"], input[name="prv_sector_dt_hired"]').on('keyup', function(event) {
        formatData(this,event,'UP','date');        
    })


    $('#phone, #cell_phone, #le_phone, #prv_sector_phone').on('keydown', function(event) {
        formatData(this,event,'DOWN','phone');
    })

    $('#phone, #cell_phone, #le_phone, #prv_sector_phone').on('keyup', function(event) {
        formatData(this,event,'UP','phone');        
    })


    let change_occurred = false;
    $('#users_admin').on( 'focus', ':input', function(){
        $(this).attr( 'autocomplete', 'off' );
    });

    /* Save and continue */
    $('#users_admin :input').change(function(e){
        change_occurred = true;
    });


    $(".btn-primary").click(function (e) {
       /* This will do server side validation */    
       if( change_occurred ) {
           save_changes_ajax( this.id ); 
       } else {
          let = messTxt = '<h4>There were no changes detected to any of the fields.</h4>';
          myAlert( 'Alert!', messTxt, 'info')
       }    

    });

    /* Canel and return */
    $(".cancel").click(function (e) {
        window.location.replace('../site_users/manage');            
    });

    $(".cancel_member_manage").click(function (e) {
        window.location.replace('./youraccount/welcome');            
    });

});