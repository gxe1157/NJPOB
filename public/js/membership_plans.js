
var model_js_mess = {
        'delete' : '<h3>Delete this account?</h3>',
        'suspend': '<h3>Suspend this account?</h3>',
        'reset_pswrd' : '<h3>Reset Password?</h3>'
    }

function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};


$(document).ready(function() {
    let last_clicked_href = null;
    // if( $('#cnt_errors').val() > 0 ) {
    //   let error_mess =  $('#error_mess').val();
    //   error_mess = error_mess.split("|");
    //   myAlert( jsUcfirst('Error')+' ! ', error_mess, 'danger' );
    // }
    
    /* update show_panel hidden field */
    if( $('#show_panel').val() ) {
        let val = $('#show_panel').val();
        activaTab(val);    
    }

    $("a").click(function (e) {
      last_clicked_href = $(this).attr('href').substr(1); 
      $('#show_panel').val(last_clicked_href);
    });

    /* field Formating on input */
    $('#bus_phone, #cell_phone').on('keydown', function(event) {
        formatData(this,event,'DOWN','phone');
    })

    $('#phone, #cell_phone').on('keyup', function(event) {
        formatData(this,event,'UP','phone');        
    })

    $('#users_admin').on( 'focus', ':input', function(e){
        $(this).attr( 'autocomplete', 'off' );
    });


    /* detect any input change */
    // let change_occurred = false;    
    // $('#business_app :input').change(function(e){
    //    console.log($(e.target).attr('id'));
    //   change_occurred = true;
    // });

    $('#business_app #submit_btn').on('click', function() {
        $('#show_panel').val(last_clicked_href);
alert( $('#show_panel').val()+' | '+last_clicked_href)        ;

        // let error_mess = '<b>No changes have occurred to this record.</b>';
        //  if( change_occurred == false ){
        //     myAlert( jsUcfirst('Alert'), error_mess, 'warning' );                  
        //     return false;
        // }
    });


});