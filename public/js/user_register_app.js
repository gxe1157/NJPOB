    /*  Check Out */

    function update_payment( base_price, fee, terms ){
        // console.log( $('input[name="itemname"]:checked').val() );
        // console.log('Old School: '+document.myForm.itemname.value );
        // alert(base_price+' | '+fee+' | '+terms);
        var x = +base_price + +fee;
        document.getElementById('checkout').innerHTML = "Total Dues: $"+dollarValue(x);
        document.getElementById('itemprice').value = dollarValue(x);

        $('#myForm').bootstrapValidator('updateStatus', 'itemname', 'NOT_VALIDATED')
                    .bootstrapValidator('validateField', 'itemname' );        
     }

    function checkBox(){
        alert( document.getElementById('agree_terms').checked );
       
    }

    function dollarValue(n){
         if( n<.099 ){ var d = n;  return d; }
         var Bstr = "";
         var b = n * 100;
         var c = Math.round(b);
         var Astr = c.toString();
         var Alength = Astr.length;
         if (Alength <= 2) Bstr = Bstr + ".";
             var dot = Alength - 3;
             var counter = 0;
         while (counter < Alength )
           {
            Bstr = Bstr + Astr.charAt(counter);
            if (counter == dot) Bstr = Bstr + ".";
            counter = counter + 1;
           }
         var d = Bstr;
         return d;
     }

$(document).ready(function() {

    $('#myForm').on( 'focus', ':input', function(){
        $(this).attr( 'autocomplete', 'off' );
    });

    function updateState( fieldName ) {
        $('#myForm').bootstrapValidator('updateStatus', fieldName, 'NOT_VALIDATED')
                    .bootstrapValidator('validateField', fieldName );
    }

    $('#phone').on('keydown', function(event) {
        formatData(this,event,'DOWN','phone');
    })

    $('#phone').on('keyup', function(event) {
        formatData(this,event,'UP','phone');        
    })

    $('#myForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            agree_terms:{
                validators: {
                    notEmpty: {
                        message: 'You have to accept the terms and policies'
                    }
                }  
            },
            itemname: {
                validators: {
                    notEmpty: {
                        message: 'Selecting a plan is required'
                    }
                }
            },            
            first_name: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
            last_name: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
           email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    },
                    // Place the remote validator in the last
                    remote: {
                        message: 'The username is not available',                
                            url: './users_registration/check_user_ajax',
                           type: 'POST'
                    }
                }
            },    
            confirmEmail: {
                validators: {
                    notEmpty: {
                        message: 'The email confirm is required and can\'t be empty'
                    },
                    identical: {
                        field: 'email',
                        message: 'The email and its confirm are not the same'
                    }
                }
            },            
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                }
            }
          } // end fields
        })
        .on('error.field.bv', function(e, data) {
          // console.log('Errors....................');                        
          // console.log(data);          
        })

        if ($('#validate_state').val() == 'failed' ){
            updateState( 'itemname' );
            updateState( 'agree_terms' );
        }        

});
