<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
  foreach ($plans as $plan ) {
      $dues1      = $plan->mem_dues1;
      $dues2      = $plan->mem_dues2;
      $dues3      = $plan->mem_life;
      $init_fee   = $plan->mem_initiation;
      $image_name = $plan->mem_plan_image;
      $savings    = ($plan->mem_dues1*3 - $plan->mem_dues2);
      $category   = $plan->mem_category;

      // sprintf(format,arg1,arg2,arg++);
      $mem_dues1 = '$'.number_format( ($plan->mem_dues1),2 );        
      $mem_initiation = '$'.number_format( ($plan->mem_initiation),2 );
      $total_due = '$'.number_format( ($plan->mem_dues1+$plan->mem_initiation),2 );
      $details = sprintf($plan->mem_plan_details, $mem_dues1, $mem_initiation, $total_due);  
  }
  
  $return_url = [ 'LE' => 'Membership-Law-Enforcement', 'Civilian' => 'Membership-Law-Civilian', 'Club' => 'membership_club'];
?>


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

#ad_box_banner, .top_box_banner{
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

.content-checkout{
    padding: 10px;
    background-color: #F0AD4E;
    font-size: 1.2em;
}
.content-checkout-radio{
  margin-left: 30px; 
  margin-right: 30px;   
}

</style>

<div class="col-md-12" style="margin-top:20px;">
    <div class="col-md-3">
         <img class="img-responsive img-thumbnail"
         src="<?= base_url() ?>public/images/<?= $category ?>/<?= $image_name ?>" width="80%" />
    </div>

    <div class="col-md-9">
      <div style="clear:both;"></div>
      <?= $details ?>
    </div>

    <div style="clear:both;"></div>
    <div class="row">
      <div class="col-md-12">

<div class="col-sm-12" >
    <!-- paypal-express-checkout/process.php -->
    <form id="myForm" name="myForm"
          method="post"
          action="users_registration/process_payment" >

    <fieldset>
        <input type="hidden" name="itemQty" value="1" />
        <input type="hidden" name="itemnumber" id="itemnumber"
               value="<?= $_POST['selected_plan'] ?>" />
        <input type="hidden" name="itemprice" id="itemprice" value="0.00" />
        <input type="hidden" name="trans_type" value="selected_plan" />
        <input type="hidden" name="gateway_name" value="<?= $gateway_name ?>" />

      <div style="clear:both;"></div>
      <hr>

      <div class="col-md-6">
      <div class="row">
      <?= validation_errors("<p style='color: red;'>", "</p>") ?> 
           <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">First Name</label>
            <div class="col-md-9 inputGroupContainer">
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="first_name" value="<?php echo set_value('first_name'); ?>" 
                    placeholder="First Name" class="form-control"  type="text">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label" >Last Name</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="last_name" value="<?php echo set_value('last_name'); ?>"
                   placeholder="Last Name" class="form-control"  type="text">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label" >Middle</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="middle_name" value="<?php echo set_value('middle'); ?>"
                   placeholder="Middle Name" class="form-control"  type="text">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">Phone</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="phone" id="phone" value="<?php echo set_value('phone'); ?>" 
                   placeholder="(845)555-1212" class="form-control" type="text">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">E-Mail</label>
            <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input name="email" value="<?php echo set_value('email'); ?>"
                       placeholder="E-Mail Address" class="form-control"  type="text">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm</label>
              <div class="col-md-9 inputGroupContainer">
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input name="confirmEmail" value="<?php echo set_value('confirmEmail'); ?>"
                         placeholder="Confirm E-Mail Address" class="form-control" type="text">
              </div>
            </div>
          </div>

      </div>    
      </div>

      <div class="col-md-6">
      <div class="row">
          <div class="col-md-12" >
            <div class="top_box_banner">Payment Plan</div>
            <div class="content-checkout">
              <div class="radio">
                <div class="content-checkout-radio" >
                <label>
                  <input type="radio" name="itemname"
                   value="1 Year Subscription with Initiation"
                   onClick="Javascript: update_payment('<?= $dues1 ?>','<?= $init_fee ?>', 1);" >
                   Annual dues <?= '$'.number_format( ($dues1),2 ) ?> for the year. 
                </label>
                </div>
              </div>
              <div class="radio">
                <div class="content-checkout-radio" >
                <label>
                  <input type="radio" name="itemname"
                   value="3 Year Subscription with Initiation"
                   onClick="Javascript: update_payment('<?= $dues2 ?>','<?= $init_fee ?>',3);">
                   3 year dues <?= '$'.number_format( ($dues2),2 ) ?> a savings of $<?= $savings ?>.
                </label>
                </div>
              </div>
              <?php if( $dues3 > 0 ) { ?>
              <div class="radio">
                <div class="content-checkout-radio" >              
                <label>
                  <input type="radio" name="itemname"
                   value="Lifetime membership Subscription"
                   onClick="Javascript: update_payment('<?= $dues3 ?>','0',99);">
                   Lifetime Membership dues <?= '$'.number_format( ($dues3),2 ) ?>
                </label>
                </div>
              </div>
              <?php  } ?>              
             </div>

             <div class="top_box_banner" id="checkout" >Total Dues: $ 0.00</div>

            <!-- checkbox input-->
            <div class="form-group">
              <div class="checkbox btnConfirmPDF" id="Terms and Agreement-<?= $category ?>">
                <label>
                <input type="checkbox" name="agree_terms" id="agree_terms" >
                I agree to the following: <a class="AdSpace-link" href="#" >Terms and Conditions</a>
                </label>
                   <ul>
                  <li>I have read and accepted the 
                     <a href="Javascript: agreeToTerms('<?= $category ?>')"
                        style="text-decoration:underline; color:blue; " >
                          membership oath and obligation of compliance.
                     </a>
                  </li>
                  <li>I am at least 18 years old.</li>
                  <li>I may receive communications from the Police Officer's Brotherhood in any form.</li>
                  </ul>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <div style="border-top: 2px #999 solid; padding-top: 5px; text-align: center; ">
                <button type="submit"
                        name="submitPayPal"
                        id="#submitPayPal"
                        class="btn btn-success btn-lg">Submit
                </button>
                <a href="<?= base_url().$return_url[$category] ?>" class="btn btn-default btn-lg">Cancel</a>
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


      </div>
    </div>

</div>

