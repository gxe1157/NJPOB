
<div class="row">
    <div class="col-md-12" >
        <div class="col-sm-4 col-md-3">
            <img style="margin-top: 20px; max-width:100%;"
                 src="<?= base_url() ?>public/images/shields/Shield_Law_NJ.jpg" />
        </div>

        <div class="col-sm-8 col-md-9" style="text-align: justify; text-justify: inter-word;">
          <form name="myForm" method="post"
                action="<?= base_url('car_shields/process_payment') ?>">

             <input type="hidden" name="itemprice" value ="39.00" />
             <input type="hidden" name="itemQty" value ="1" />
             <input type="hidden" name="itemname" value ="Car Shield Lease" />
             <input type="hidden" name="itemnumber" value ="" />           
             <input type="hidden" name="gateway_name" value ="<?= $gateway_name ?>" />           

            <h3>Order your Car Shield</h3>            
            <p style="font-size: 1.2em; padding:5px;">
                    Welcome to the Motor Vehicle Shield page. All law enforcement members have the opportunity to rent/lease a car shield for their vehicles. Our car shield is larger & heavier than usual shields therefore; we made a special car shield holder. Our 3D car shield is very detailed and has many more colors than any other organizations who offered this benefit. <span style="font-weight: bold;">Therefore the fee for said shield is $29.00 + $10.00 for the holder totaling $39.00 for the life of your membership as long as you pay your dues every year.</span> A yearly insert bar will be sent to you to affix it to the stem of your shield above the engraved assigned shield number, once dues are received and paid in full for that year. Law Enforcement Officers who have several vehicles registered in their names can lease a maximum of 3 shields as long as they sign for, agree and acknowledge the policy regarding the shields and the proper use thereof.<br /><br />

                    Please complete this form and make sure to upload your driver’s license, registration & insurance card information in the membership portal. We cannot process your shield or ID Credentials until your membership is in compliance with our by-laws. The car shield is the property of the Police Officers Brotherhood & can be confiscated for non-payment of dues. Once all information is uploaded and processed your shield will come with a Motor Vehicle Shield ID Card & Traveling Dues ID Card. The traveling ID card must be presented in order to receive discounts at the participating businesses published in our business directory and buyers guide, as well as at all of our meetings and functions. Thank you!
            </p>
            <p style="background-color: #f7f3a8; color: red; padding:10px; font-weight: bold">
               Members are strictly prohibited from selling or lending their assigned numbered shield to anyone. Shields are not transferable! Be advised if your shield is not in your possession or vehicle the member is responsible to report said shield lost or stolen to your local Police Department. Members are obligated to report and send a copy of the police report concerning their shield to us ASAP.
            </p>

            <?php foreach ($columns as $key => $value) { ?>
                  <div class="form-group">
                      <label class="col-md-3 control-label" for="<?= $value['label'] ?>" >
                        <?= $value['label'] ?></label>
                      <div class="col-md-8">
                          <input type="text" id="<?= $value['field'] ?>"
                                 name="<?= $value['field'] ?>"
                                 value="<?= set_value($value['field'], ''); ?>"
                                 placeholder="<?= $value['placeholder'] ?>" 
                                 class="form-control">
                          <?= form_error($value['field'], '<div class="error" style="color:red; font-weight: regular;">', '</div>'); ?>
                      </div>
                  </div>
            <?php } ?>

            <?php if(!$dl_required): ?>
                  <div class="form-group">
                      <label class="col-md-3 control-label" for="dl" >
                        Driver's Lic.</label>
                      <div class="col-md-8">
                          <input type="text"
                                 name="dl"
                                 value="<?= $dl; ?>"
                                 class="form-control" readonly>
                      </div>
                  </div>
            <?php endif; ?> 

            <?php if(!$ss_required): ?>                                   
                  <div class="form-group">
                      <label class="col-md-3 control-label" for="ss" >
                        Social Security</label>
                      <div class="col-md-8">
                          <input type="text"
                                 name="ss"
                                 value="<?= $ss; ?>"
                                 class="form-control" readonly>
                      </div>
                  </div>
            <?php endif; ?>      

            <!-- Pay Pal -->
            <div class="col-md-12 text-center" style="margin-top: 25px; margin-bottom:25px;"> 
                <button type = "submit" class="btn btn-default"
                        name = "submit" value = "Cancel">Cancel</button>
                <button type = "submit" class="btn btn-success"
                        name = "submit" value = "Paypal" >Pay Pal</button>
            </div>
          </form>          
      </div>
    </div> <!-- //col-md-12 -->
</div> <!-- //row -->
        

