alert("loaded..... ad-forms.js");

  function chkBox( adPrice, opt ){
      document.getElementById('error_mess').innerHTML = '';
      document.getElementById('error_mess').style.display = 'none';
      document.getElementById('checkout').innerHTML ='';
      document.getElementById('itemnumber').value='';


      for (var i=1; i<=total_ads; i++){
        if( i == opt ){
          if( document.getElementById(i).checked==true ){
          	  var dollarAmount = dollarValue(adPrice);

              document.getElementById('checkout').innerHTML = document.getElementById(i).value+': $'+dollarAmount;
              document.getElementById('itemnumber').value = document.getElementById(i).value;
              document.getElementById('itemprice').value = dollarAmount;
              //console.log( 'cnt: '+i+' '+document.getElementById('itemprice').value );
          }
        }else{
          document.getElementById(i).checked=false;
        }

      }
   }

	function chkBox_check(){
         var mess = '';
         var proceed = false;

         for (var i=1; i<=total_ads; i++){
            if( document.getElementById(i).checked ){
               proceed =true;
               break;
            }
         }
         if( proceed === false ){
             mess ='<p style="text-align:left; font-size: 14px; font-weight:bold;">We noticed you did not pick an Ad.<br> Please choose by checking the box next to the Ad you wish to buy.</p>';
             error_mess(mess);
             return false;
         }

		return;
	}

	function validate_ads(opt){
   // chk required fields
		if( chkBox_check() === false )
			return false;
console.log( ' chkBox completed ...... OK');

		if( val_flds() === false ){
			return false;
		}
console.log( ' Fields fields not empty check completed ...... OK');

		if( val_terms() === false )
			return false;
console.log( ' validate check completed ...... OK');

        if(opt=='use_my_printer')
			print_form();

console.log('Ready for Pay Pal..................');
//alert('stop...............');
		return;
	}


	function validate_adPage(){
		if(document.getElementById('sel_level').value =='Select'){
			alert('Select is not valid');
			return false;
		}
	}

	function validate_donor(){
		if(document.getElementById('sel_level').value =='Select'){
		  alert( "Please Select a Sponsor Level.... " )
		  return false;
	   }

	  var sel_level=document.getElementById('sel_level').value;
	  switch( sel_level ){
		 case 'platinum_donor':
		   var hosted_id='XUNR9T65L4LUA';
		   break;
		 case 'gold_donor':
		   var hosted_id='SA3FGYV9XQTXL';
		   break;
		 case 'silver_donor':
		   var hosted_id='WHWCWTZW937QS';
		   break;
		 case 'bronz_donor':
		   var hosted_id='JKUDVR8EY3EGY';
		   break;
		 case 'supporter':
		  var hosted_id='ZZEMMLEH38HUS';
		  break;
	  }

	  document.forms["form1"]["hosted_button_id"].value = hosted_id;

	}
