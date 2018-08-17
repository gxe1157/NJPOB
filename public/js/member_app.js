
$(document).ready(function() {
    /* init FormCheck */
    var FormCheck = {'fld_group1': 0, 'fld_group2': 0, 'fld_group3': 0, 'submit_id' : null, 'step_id' : 0 }

    // $('input[name="fullname"]').prop('disabled', true );
    // $('input[name="email"]').prop('disabled', true );
    // $('input[name="phone"]').prop('disabled', true );

    $('input[name="prv_sector_dt_hired"], input[name="dob"], input[name="spouse_dob"], input[name="child_dob"], input[name="le_dt_hired"], input[name="le_dt_retired"], input[name="prv_sector_hire_dt"]').on('keydown', function(event) {
        formatData(this,event,'DOWN','date');
    })

    $('input[name="prv_sector_dt_hired"], input[name="dob"], input[name="spouse_dob"], input[name="child_dob"], input[name="le_dt_hired"], input[name="le_dt_retired"], input[name="prv_sector_hire_dt"]').on('keyup', function(event) {
        formatData(this,event,'UP','date');        
    })


    $('#phone, #cell_phone, #le_phone, #prv_sector_phone').on('keydown', function(event) {
        formatData(this,event,'DOWN','phone');
    })

    $('#phone, #cell_phone, #le_phone, #prv_sector_phone').on('keyup', function(event) {
        formatData(this,event,'UP','phone');        
    })

    if( $('#car_shield').val() == true ) { //if true then no car shield
        // $('.social_sec').css('display', 'none');
        // $('.ss_confirm').css('display', 'none');        
        // $('#social_sec').prop('disabled', true);
        // $('#ss_confirm').prop('disabled', true);
    }

    function updateState( fieldName ) {
        $('#myForm').bootstrapValidator('updateStatus', fieldName, 'NOT_VALIDATED')
                    .bootstrapValidator('validateField', fieldName );
    }

    //marital_status
    function marital_status( arg ) {
        $('input[name="spouse_fname"]').prop('disabled', arg);
        $('input[name="spouse_lname"]').prop('disabled', arg);
        $('input[name="spouse_dob"]').prop('disabled', arg);        
        $('input[name="spouse_email"]').prop('disabled', arg);                
        $('#spouse_gender').prop('disabled', arg); 

        if( arg == true ){
            $('input[name="spouse_fname"]').val('');
            $('input[name="spouse_lname"]').val('');
            $('input[name="spouse_dob"]').val(''); 
            $('input[name="spouse_email"]').val('');                                   
            $('#spouse_gender').val(''); 
        }
    }

    function mailToAdd( arg ) {
        $('input[name="mail_add1"]').prop('disabled', arg);
        $('input[name="mail_add2"]').prop('disabled', arg);
        $('input[name="mail_city"]').prop('disabled', arg);        
        $('input[name="mail_state"]').prop('disabled', arg);        
        $('input[name="mail_zip"]').prop('disabled', arg); 
    }

    function update_profile(){
        if( $('#update_profile').val() == '1' ) {
            $('#myForm').data('bootstrapValidator').validate();  
        };
    }

    function val(){ // Not in use in this script - code reference
        var AnswerInput = document.getElementsByName('Answer[]');
        for (i=0; i<AnswerInput.length; i++) {
            if (AnswerInput[i].value == "") {
              alert('Complete all the fields');    
              return false;
            }
        }
    }

    /* ---------- Wizard -----------------------------------*/
    // alert($("#prv_sector option:selected").index() );

    let selected = $('#prv_sector').prop('selectedIndex');
    selected == '1' ? $('#jobInfo').show("slow"):$('#jobInfo').hide("slow");

    $('#prv_sector').on('change', function() {
        var selected = this.value;
        selected == 'Yes' ? $('#jobInfo').show("slow"):$('#jobInfo').hide("slow");
    });

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
    });

    $(".prev-step").click(function (e) {
        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }

    /* Save and exit */
    $("#fld_group1, #fld_group2, #fld_group3").click(function (e) {
        var fld_group = this.id;
        var step_id = fld_group.substr(-1,1);   
        save_exit_ajax(fld_group, step_id);
    });

    /* Canel and return */
    $(".cancel").click(function (e) {
        window.location.replace('../youraccount/welcome');            
    });

    /* Save and continue */
    $("#submit-data1").click(function (e) {
        FormCheck['submit_id'] = 'fld_group1';
        FormCheck['step_id']   = 1;
        // mailToAdd( false );                
        $('#myForm').data('bootstrapValidator').validate();                  
    });

    $("#submit-data2").click(function (e) {
        FormCheck['submit_id'] = 'fld_group2';
        FormCheck['step_id']   = 2;        
        $('#myForm').data('bootstrapValidator').validate();                  
    });

    $("#submit-data3").click(function (e) {
        FormCheck['submit_id'] = 'fld_group3';
        FormCheck['step_id']   = 3;        
        $('#myForm').data('bootstrapValidator').validate();                  
    });


    /* ---------- Form validation --------------------------*/
    MAX_OPTIONS = 10;
    /* init field - disable mail address */
    mailToAdd( true );                    
    marital_status( true );                                     

    $('#myForm').on( 'focus', ':input', function(){
        $(this).attr( 'autocomplete', 'off' );
    });

    $('#marital_status').change(function(){
      if( $('#marital_status').val() == 'Married' ){
          marital_status( false );                                     
      } else {
          marital_status( true );                                     
      }  
    });
        
    $('#mail_to').change(function(){
        mailToAdd( false );         
        $('.mail_add1_error_mess').html('');
        $('.mail_city_error_mess').html('');
        $('.mail_state_error_mess').html('');
        $('.mail_zip_error_mess').html('');      

        if( $('#mail_to').val() == 'Yes' ){
          $('input[name="mail_add1"]').val( $('input[name="address1"]').val() );
          $('input[name="mail_add2"]').val( $('input[name="address2"]').val() );
          $('input[name="mail_city"]').val( $('input[name="city"]').val() );
          $('input[name="mail_state"]').val( $('input[name="state"]').val() );            
          $('input[name="mail_zip"]').val( $('input[name="zip"]').val() );   
           mailToAdd( true );           
        } else {
          $('input[name="mail_add1"]').val( '' );
          $('input[name="mail_add2"]').val( '' );
          $('input[name="mail_city"]').val( '' );
          $('input[name="mail_state"]').val( '' );            
          $('input[name="mail_zip"]').val( '' ); 
        }

        if( $('#mail_to').val() == '') {
            mailToAdd( true ); 
        } else {
            // updateState( 'mail_zip');            
        }

    });


    $('#myForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            address1: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            city: {
                validators: {
                    stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your city name'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your abbreviate the state name'
                    },
                    regexp: {
                        regexp: /^(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$/,
                        message: 'The abbreviate the state. example: CT, NJ, CA ...'
                    }                    
                }
            },
            zip: {
                validators:{
                    notEmpty: {
                        message: 'Please supply US zipcode'
                    },
                    regexp: {
                        regexp: /^\d{5}$/,
                        message: 'The US zipcode must contain 5 digits'
                    }                    
                }
            },
            county: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your county name'
                    }
                }
            },
            registered_voter: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your registered voter status'
                    }
                }
            },
            // legislative_dist: {
            //          stringLength: {
            //             min: 2,
            //         },
            //     validators: {
            //         notEmpty: {
            //             message: 'Please supply your legislative district'
            //         }
            //     }
            // },
            dob: {
                validators: {
                    notEmpty: {
                        message: 'The date of birth is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date of birth is not valid. ( MM/DD/YYYY )'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            },
            height: {
                validators:{
                    notEmpty: {
                        message: 'Please supply your height'
                    }
                }

            },
            weight: {
                validators:{
                    notEmpty: {
                        message: 'Please supply your weight'
                    },                  
                    digits: {},
                    stringLength: {
                        min: 2,
                        message:'..'
                    }
                }
            },
            hair_color: {
                validators:{
                    notEmpty: {
                        message: 'Please supply your hair color'
                    }
                }

            },
            eye_color: {
                validators:{
                    notEmpty: {
                        message: 'Please supply your eye color'
                    }
                }

            },
            driver_lic: {
                validators:{
                    notEmpty: {
                        message: 'Please supply your driver\'s License'
                    },                  
                }
            },
            social_sec: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your social security number'
                    },                  
                    digits: {},
                    identical: {
                        field: 'ss_confirm',
                        message: '..'
                     }
                }
            },
            ss_confirm: {
                validators: {
                    notEmpty: {
                        message: 'Please confirm your social security number'
                    },                               
                    identical: {
                        field: 'social_sec',
                        message: 'The social security and its confirm are not the same'
                    }
                }
            },
            marital_status: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your marital status'
                    },                               
                }
            },
            gender_sel: {
                validators: {
                    notEmpty: {
                        message: 'The gender option is required'
                    },                               
                }
            },
            spouse_fname: {
               feedbackIcons: 'false',
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply first  name'
                    }
                }
            },
            spouse_lname: {
               feedbackIcons: 'false',
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply last name'
                    }
                }
            },
            spouse_dob: {
               feedbackIcons: 'false',
                validators: {
                    notEmpty: {
                        message: 'The date of birth is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date of birth is not valid. ( MM/DD/YYYY )'
                    }
                }
            },            
            spouse_gender: {
               feedbackIcons: 'false',
                validators: {
                    notEmpty: {
                        message: 'The gender option is required'
                    }
                }
            },            
            le_agency: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply Agency name'
                    }
                }
            },
            le_dept: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your department'
                    }
                }
            },
            le_rank: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your rank/title'
                    }
                }
            },
            le_add1: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            le_city: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your city name'
                    }
                }
            },
            le_state: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your abbreviate the state name'
                    },
                    regexp: {
                        regexp: /^(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$/,
                        message: 'The abbreviate the state. example: CT, NJ, CA ...'
                    }                    
                }
            },
            le_zip: {
                validators:{
                    notEmpty: {
                        message: 'Please supply US zipcode'
                    },
                    regexp: {
                        regexp: /^\d{5}$/,
                        message: 'The US zipcode must contain 5 digits'
                    }                    
                }                
            },
            le_email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            le_phone: {
                validators:{
                     stringLength: {
                        min: 14,
                        message:'Please supply a vaild phone number (xxx) xxx-xxxx'                        
                    },
                    notEmpty: {
                        message: 'Please supply a vaild phone number (xxx) xxx-xxxx'
                    },
                }
            },
            le_dt_hired: {
                validators: {
                    notEmpty: {
                        message: 'The date of hire is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date of hire is not valid. ( MM/DD/YYYY )'
                    }
                }
            },
            // le_dt_retired: {
            //     validators: {
            //         notEmpty: {
            //             message: 'The date of hire is required'
            //         },
            //         date: {
            //             format: 'MM/DD/YYYY',
            //             message: 'The date of hire is not valid. ( MM/DD/YYYY )'
            //         }
            //     }
            // },
            prv_sector_employer: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply Agency/Company name'
                    }
                }
            },
            prv_sector_dept: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your department'
                    }
                }
            },
            prv_sector_position: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your title'
                    }
                }
            },
            prv_sector_add1: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            prv_sector_city: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your city name'
                    }
                }
            },
            prv_sector_state: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your abbreviate the state name'
                    },
                    regexp: {
                        regexp: /^(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$/,
                        message: 'The abbreviate the state. example: CT, NJ, CA ...'
                    }                    
                }
            },
            prv_sector_zip: {
                validators:{
                    notEmpty: {
                        message: 'Please supply US zipcode'
                    },
                    regexp: {
                        regexp: /^\d{5}$/,
                        message: 'The US zipcode must contain 5 digits'
                    }                    
                }                
            },
            prv_sector_email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            prv_sector_phone: {
                validators:{
                     stringLength: {
                        min: 14,
                        message:'Please supply a vaild phone number (xxx) xxx-xxxx'                        
                    },
                    notEmpty: {
                        message: 'Please supply a vaild phone number (xxx) xxx-xxxx'
                    },
                }
            },
            prv_sector_hire_dt: {
                validators: {
                    notEmpty: {
                        message: 'The date of hire is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date of hire is not valid. ( MM/DD/YYYY )'
                    }
                }
            },
            prv_sector: {
                validators: {
                    notEmpty: {
                        message: 'Please supply employment status'
                    },
                }
            },

          } // end fields
        })
        .on('error.field.bv', function(e, data) {
          // console.log('Errors....................');                        
          // console.log(data);          
            // if(data['field'] == 'chkBoxes[]'){ 
            //   $('#ad_box_content').html('<p style="color: red; font-size: 14px; font-weight: bold;">Please select Ad Space by clicking check box.</p>');
            // }
            // console.log( data );
        })
        .on('success.form.bv', function(e) {
            var $form = $(e.target),                        // The form instance
                bv    = $form.data('bootstrapValidator');   // BootstrapValidator instance
            // Prevent form submission
            e.preventDefault();

            if( $('#update_profile').val() == '1' ) {
                // console.log('update profile is true --- return');
            }    

            /* This will do server side validation */    
            // console.log('submit_id ', FormCheck['submit_id'], 'step_id', FormCheck['step_id'] );
            validate_ajax( FormCheck['submit_id'], FormCheck['step_id'] ); 
        })
        .on('error.form.bv', function(e) {
            // console.log('Looks like it did not pass.......');
            return false;
        });    


    function validate_ajax(fld_group, step_id ){
        mailToAdd( false );
        var formData = new FormData();
        var jdata = "#step"+step_id+" input, #step"+step_id+" select";

        var getData = $(jdata).serializeArray();
        $.each(getData, function(i, field){
            formData.append( field.name, field.value);                    
            // console.log('jdata', field.name, field.value );
        });

        formData.append( 'fld_group', fld_group );                    

        $.ajax({
          url: 'users_application/ajax_validate', 
          method:"POST",
          data: formData,
          contentType: false,
          cache: false,
          processData:false,
          success:function(data)
          {
            // console.log( 'Return Data:......  ', data);
            let response = JSON.parse(data);
            console.log(response);

            if( data == 1 ) {
               FormCheck[fld_group] = 1;            
               var $active = $('.wizard .nav-tabs li.active');
               $active.next().removeClass('disabled');
               nextTab($active);            
            } else {
              FormCheck[fld_group] = 0;

              // $('#error_message').html(data);
              // let error_message = response['errors_array'];
              for ( var key in response ) {
                if (response.hasOwnProperty(key)){
                  if( key !== 'contains' ) {
                    $('.'+key).html(response[key]).css({ 'color': 'red', 'font-weight': 'regular' });

                  }
                }
              }

             // console.log('Failed server side validation.............' );
            }
          }// success

        })  
    }

    function save_exit_ajax(fld_group, step_id ){
        var formData = new FormData();
        var jdata = "#step"+step_id+" input, #step"+step_id+" select";

        var getData = $(jdata).serializeArray();
        $.each(getData, function(i, field){
            formData.append( field.name, field.value);                    
            // console.log('jdata', field.name, field.value );
        });

        formData.append( 'fld_group', fld_group );                    

        $.ajax({
          url: 'users_application/ajax_save_exit', 
          method:"POST",
          data: formData,
          contentType: false,
          cache: false,
          processData:false,
          success:function(data)
          {
            // console.log( 'Return Data:......  ', data);
            if( data == 1 ) {
                // console.log('Success server side............' );                
                window.location.replace('auth/logout');                
            } else {
                console.log('Failed server side.............' );
            }
          }// success

        })  
    }
    /* Put this last to make it runs after js loads */ 
    // update_profile();

});
