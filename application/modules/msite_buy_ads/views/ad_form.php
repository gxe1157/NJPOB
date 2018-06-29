<style type="text/css">
/*  ad-forms.php css code here */


/* Create 2 columns of equal width */
.columns {
    float: left;
    width: 100%;
    padding: 1%;
}

/* Style the list */
.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
}

/* Add shadows on hover */
.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

/* Pricing header */
.price .header {
    padding: 5px;
    background-color:#999999;
    text-align: left;

    /*background-color: #111;*/
    color: white;
    font-size: 18px;
}

/* List items */
.price li {
    border-bottom: 1px solid #eee;
    padding: 0px;
    text-align: center;
}

/* Grey list item */
.price .grey {
    background-color: #eee;
    font-size: 16px;
} 


#ad_box_banner{
    text-align: center;
    display: block;
    background-color: #999999;
    height: 25px;
    color: #fff;
    font-size: 18px;    
}

#ad_box_content{
    text-align: center;
    display: block;
    border: 2px #999999 solid;
    background-color: #EEEEEE;
    color: #000;
    height: 35px;"
}


</style>

<?php
	$hdr_row1='COST OF ADVERTISEMENT TO BE PLACED IN COMMEMORATIVE AD JOURNAL';
	$hdr_row2='(PLEASE CHECK ONE)';
	$bot_row1='(TAX DEDUCTIBLE)';
?>

<?= validation_errors("<p style='color: red;'>", "</p>") ?>
<div class="col-sm-12" >
    <!-- paypal-express-checkout/process.php -->
    <form id="myForm" method="post" action="<?= base_url() ?>msite_buy_ads/process_payment";>

    <fieldset>
        <input type="hidden" name="itemQty" value="1" />
        <input type="hidden" name="itemnumber" id="itemnumber"value="" />
        <input type="hidden" name="itemname" id="itemname"
               value="<?= $data_ad_info['item_title'] ?>" />
        <input type="hidden" name="itemprice" id="itemprice" value="0.00" />
        <input type="hidden" name="trans_type" value="ad_sponsor" />
        <input type="hidden" name="pay_method" value="pay_pal" />        

<!-- ad-form page form details  -->
  		<?php $this->load->view('ad_foms_includes.php', $data_ad_info ); ?>
      <!-- ad-form page form details  -->

      <div style="clear:both;"></div>
      <hr>

      <div class="col-md-6">
      <div class="row">
          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">Company</label>
            <div class="col-md-9 inputGroupContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="company_name" placeholder="Company Name" class="form-control"
                   type="text" value="<?php echo set_value('company_name'); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">First Name</label>
            <div class="col-md-9 inputGroupContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="first_name" placeholder="First Name" class="form-control"
                    type="text" value="<?php echo set_value('first_name'); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label" >Last Name</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="last_name" placeholder="Last Name" class="form-control"
                   type="text" value="<?php echo set_value('last_name'); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">Phone #</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="phone" placeholder="(845)555-1212" class="form-control"
                   type="text" value="<?php echo set_value('phone'); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">E-Mail</label>
            <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input name="email" placeholder="E-Mail Address" class="form-control"
                       type="text" value="<?php echo set_value('email'); ?>">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input name="confirmEmail" placeholder="Confirm E-Mail Address"
                         class="form-control"
                         type="text" value="<?php echo set_value('confirmEmail'); ?>">
              </div>
            </div><br>
          </div>

          <!-- Text area -->
          <div class="form-group">
            <label class="col-md-3 control-label">Comment</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                  <textarea class="form-control" name="comment" placeholder="Enter Comment.....  "></textarea>
            </div>
            </div>
          </div>
      </div>    
      </div>

      <div class="col-md-6">
      <div class="row">
          <div class="col-md-12" >
            <div id="ad_box_banner">Selected Ad Space</div>
            <div id="ad_box_content">&nbsp;</div>
 
            <!-- checkbox input-->
            <div class="form-group">
              <div class="checkbox">
                <label><input type="checkbox" name="agree_terms" >
                I have read I agree to the <a class="AdSpace-link" href="#" >Terms and Conditions</a></label>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <!-- <label class="col-md-3 control-label"></label> -->
              <div class="col-md-4">
                <button type="submit"
                        name="submitPayPal"
                        class="btn btn-warning btn-block">Pay Pal
                </button>
              </div>
            </div>           

            <!-- Button -->
            <div class="form-group">
              <!-- <label class="col-md-3 control-label"></label> -->
              <div class="col-md-8">
                <button type="button"
                        name="PrintFormayPal"                
                        class="btn btn-default btn-block"
                        id="printer">Print Form and Mail with Check
                </button>
              </div>
            </div>
         </div>
      </div> 
      </div>
      <!-- // col-md-6 -->
    </fieldset>
    </form>
    <hr>

</div> <!-- id="form-container -->

<script>
  var total_ads = '<?= $item_counts ?>';

    function chkBox( adPrice, opt ){
        document.getElementById('ad_box_content').innerHTML ='';
        document.getElementById('itemnumber').value='';

        for (var i=1; i<=total_ads; i++){
          if( i == opt ){
            if( document.getElementById(i).checked==true ){
                document.getElementById('ad_box_content').innerHTML = document.getElementById(i).value+': $'+adPrice;
                document.getElementById('itemnumber').value = document.getElementById(i).value;
                document.getElementById('itemprice').value = adPrice;
            }
          }else{
            document.getElementById(i).checked=false;
          }
        }
    }

</script>