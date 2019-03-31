<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $options[0] = "Select...";
    foreach ($member_plans as $key => $value) {
      $options[] = $value->mem_plan_level;
    }

?>
<style>
  .min_height {
    padding: 3px 0px 3px 0px;
    min-height: 110px;
  }
  #note {font-size: 11pt; background-color: yellow; padding: 10px 25px;  color: #000; }
  #note_hdr {font-weight: bold; color: red; }
  #note_alt_form { color:red; padding: 5px; text-align:justify;}

</style>  

<div class="col-md-12" style="margin-top:20px;">
    <div class="col-md-8">
      <?php foreach ($member_plans as $key => $value) {
        $num = $key+1;

        // sprintf(format,arg1,arg2,arg++);
        $mem_dues1 = '$'.number_format( ($value->mem_dues1),2 );        
        $mem_initiation = '$'.number_format( ($value->mem_initiation),2 );
        $total_due = '$'.number_format( ($value->mem_dues1+$value->mem_initiation),2 );
        $mem_plan_details = sprintf($value->mem_plan_details, $mem_dues1, $mem_initiation, $total_due);
        $plans[$num] = $member_plans[$key]->mem_plan_benefits;
        $plan_fees[$num] = $mem_dues1;
        $category = $value->mem_category;

        echo '<div class="row min_height" id="plan_'.$num.'" >';
        echo '<div class="col-md-2"><span><img class="image img-responsive img-thumbnail" src="'.base_url().'public/images/'.$value->mem_category.'/'.$value->mem_plan_image.'" /></span></div>';
        echo '<div class="col-md-10"><span>'.$mem_plan_details.'</span></div>';        
        echo '</div>';        
      }

      ?>

    </div>

    <div class="col-md-4">
        <div class="pricing-table">
            <div class="panel panel-primary" style="border: none;">

                <div class="controle-header panel-heading panel-heading-landing">
                    <h3 class="panel-title panel-title-landing">
                        <?= $category ?> Membership
                    </h3>
                </div>

                <div class="panel-body panel-body-landing">
                     <table class="table" style="min-height: 210px;">
                         <tr>
                            <td  style="font-size: 1.5em; text-align:center; color: red; ">
                              <span id="show_fee"></span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span id="show_plan"></span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="panel-footer panel-footer-landing">
                  <div class="row clearfix">
                    <div class ="col-sm-12" style="margin: 0 auto; text-align:center; ">

                    <form class="form-inline" role="form"
                          action="<?= base_url() ?>users_registration"
                          method="POST"
                          onSubmit=" return validate()" >
                      <input type="hidden" name="selected_plan" id="selected_plan"  />
                      <input type="hidden" name="plan" id="plan" value='<?php echo json_encode($plans) ?>'  />
                      <input type="hidden" name="plan_fees" id="plan_fees" value='<?php echo json_encode($plan_fees) ?>'  />                      

                       <div class="form-group">
                          <label for="selected_option" >Membership level&nbsp; &nbsp;
                          <?php
                                  $additional_dd_code = 'class="form-control"';
                                  $additional_dd_code .=' id="selected_option"';
                                  $field_name = "selected_option";

                                  echo form_dropdown(
                                        $field_name,
                                        $options,
                                        $value, // selected option value
                                        $additional_dd_code);
                                ?>

                          </label>

                       </div>
                       <button type="submit" class="btn btn-primary">Register</button>
                    </form>

                   </div> 
                   </div>
                   <div id="error-mess"></div>                   
                </div>

            </div>
        </div>

       <p id="note_alt_form">If you are not comfortable applying or making payments on-line, Click on the Download App link below, fill out the application, print it out, enclose a check and send it us ASAP.<br /> Thank You!</p>
        <div style="cursor:pointer;" >
          <a onClick="Javascript: do_post();">
            <img class="image img-responsive center-block" src="<?= base_url() ?>public/images/Become A Member Section-4.png"
               width="300"
               height="45" />
            </a>
        </div>
        <br />
        <a href="<?= base_url().'Become-A-Member' ?>" class="btn btn-warning btn-lg center-block">Return</a>

    </div>

    <div style="clear:both;"></div> 
  
    <div class="col-md-12">
      <br />
      <section>
      <p id="note" >
      <span id="note_hdr">Please Note:</span><br />This organization is governed by active & retired / former Law Enforcement officers. Therefore the activities and decisions of the organization are made only by law enforcement officers. Civilians have a right to voice their concerns as associated members but do not have voting powers!</p>
      </section>
    </div>

</div>

