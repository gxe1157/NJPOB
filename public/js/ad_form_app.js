

$(document).ready(function() {

    $('#cancel').on('click', function() {
        let base_url = $('#base_url').val();
        window.location.replace( base_url );        
    })

    $('#printer').on('click', function() {
alert('Print form');
    })

    $('#phone').on('keydown', function(event) {
        formatData(this,event,'DOWN','phone');
    })

    $('#phone').on('keyup', function(event) {
        formatData(this,event,'UP','phone');        
    })


    $('#ad_box_content').html('....');        

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
            'chkBoxes[]': {
                validators: {
                    notEmpty: {
                        message: 'Please specify at least one advertisement plan.'
                    }
                }
            },
            company_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your company name'
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
            confirmEmail: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and can\'t be empty'
                    },
                    identical: {
                        field: 'email',
                        message: 'The email and its confirm are not the same'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                }
            },
          } // end fields
        })
        .on('error.field.bv', function(e, data) {
            if(data['field'] == 'chkBoxes[]'){ 
              $('#ad_box_content').html('<p style="color: red; font-size: 14px; font-weight: bold;">Please select Ad Space by clicking check box.</p>');
            }

        })


});
