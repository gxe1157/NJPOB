
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

    /* use in Membership-Law-Civilian.php */
    $('#selected_option').on('change', function(){
        let option = $('#selected_option').val();
        let color = '#fff';
        let length = $('#selected_option > option').length;

        let resp_plan = JSON.parse( $('#plan').val() );
        let resp_fee = JSON.parse( $('#plan_fees').val() );

        $('#selected_plan').val( $( "#selected_option option:selected" ).text() );
        if( option != 0  ) {
            $('#show_plan').html(resp_plan[option]);
            $('#show_fee').html('Annual Membership: '+resp_fee[option]);            
        }else{
            $('#show_plan').html('');
            $('#show_fee').html('');
        }

        for( var i = 0; i<length; i++ ) {
            color = i == option ? '#F9C809' : '#fff';
            $('#plan_'+i).css('background-color', color);            
        }

    });

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

    $('#membership_plan #submit_btn').on('click', function() {
        $('#show_panel').val(last_clicked_href);
    });


});