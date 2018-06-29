
$('#add_name').on('click', function(){

    let finalState = checkState();
// alert('finalState1: '+finalState);

    if( finalState === false ) {
        let message = 'In order to procced, enter all of the child\'s information......';
        myAlert( 'Alert! : You clicked on the Add Name button.',message );
        return;
    }

    $('#child_message').empty();
    $('#fld_group2').prop( 'disabled', false);
    $('#submit-data2').prop( 'disabled', false);    

    let formData = new FormData();
    let getData = $('#family_info').find(':input').serializeArray();

    $.each(getData, function(i, field){
        formData.append( field.name, field.value);  
        // console.log( field.name, field.value );
    });
    add_name( formData );
})

$('input[name="child_fname"], input[name="child_lname"], input[name="child_dob"], #child_gender').on('change', function(){
    let finalState = checkState();
    $('#child_message').html('');
    $('#fld_group2').prop( 'disabled', finalState);
    $('#submit-data2').prop( 'disabled', finalState);    
})

function checkState(){
    let buttonState = [];
    let result = 0;
    let finalState = 0;

    buttonState[0] = $('#child_fname').val() != ''  ? 1 : 0;
    buttonState[1] = $('#child_lname').val() != ''  ? 1 : 0;
    buttonState[2] = $('#child_dob').val() != ''    ? 1 : 0;
    buttonState[3] = $('#child_gender').val() != '' ? 1 : 0;

    for( var i=0; i<buttonState.length; i++) {
         result += buttonState[i];
    }
   
    // console.log(result+' | ',buttonState);
    finalState = result == 4 ? true : false;
    
    return finalState;
}

function add_name( formData ){
    $.ajax({
      url: dir_path+'site_users/add_child_record', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        $(".clear_error_mess").html('');            
        $('#fld_group2').prop( 'disabled', false);
        $('#submit-data2').prop( 'disabled', false);    

        let response = JSON.parse(data);
        // console.log('response', response);

        if( response['success'] == 1 ) {
            $('#child_fname').val('');
            $('#child_lname').val('');            
            $('#child_dob').val('');            
            $('#child_gender').val('');                        

            let message = response['flash_type'];
            myAlert( jsUcfirst(message)+' ! ',response["flash_message"], message );
            $( response['table_lines'] ).appendTo('#table_contents');

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

$(".btnRemoveForm").on('click', function () {
    let id = this.id;
    remove_name( id );
});

function remove_name(id){
    let formData = new FormData();
    var remove_line = 'line_'+id;

    formData.append( 'id', id);  
    $.ajax({
      url: dir_path+'site_users/remove_child_record', 
      method:"POST",
      data: formData,
      contentType: false,
      cache: false,
      processData:false,
      success:function(data)
      {
        $(".clear_error_mess").html('');            

        let response = JSON.parse(data);
         // console.log('response', response);

        if( response['success'] == 1 ) {
            let message = response['flash_type'];
            myAlert( jsUcfirst(message)+' ! ',response["flash_message"], message );

            $("#"+remove_line).hide();
        } else {
            // console.log('response',response);
            let message = response['flash_type'];
            myAlert( jsUcfirst(message)+' ! ',response["flash_message"], message );
        } //data

      }// success

  })  
}    

