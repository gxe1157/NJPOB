
    <section>
        <div class="wizard">
<!-- Top progess line -->        
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">1</span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">2</span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">3</span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

<!-- Begin form -->      
            <div id="error_message"></div>
                       
            <form id="myForm" name="myForm" role="form"
                              action="<?= base_url() ?>default_module/formSubmit"
                              method="POST">

                <input type="hidden"  id="car_shield"  
                       name="car_shield"  
                       value="<?= $car_shield ?>" />       

                <input type="hidden"  id="update_profile"  
                       name="update_profile"  
                       value="<?= $update_profile ?>" />       
                       
                <div class="tab-content">
<!-- Begin step 1 -->                 
                  <div class="tab-pane active" role="tabpanel" id="step1">
                      <div class="step1">
                          <div class="step_21">
                              <div class="row">
                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <?php 
                                      $data['start'] = 0;
                                      $data['end']   = 9;
                                      $data['fld_group'] = $fld_group1;
                                      $data['Select_option'] =$Select_option;
                                      $data['col_width'] = "col-md-9";
                                      $this->load->view( 'includes/Membership-input', $data);
                                    ?>
                                </div>  

                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <?php 
                                      $data['start'] = 9;
                                      $data['end']   = count($fld_group1);
                                      $data['fld_group'] = $fld_group1;
                                      $data['Select_option'] =$Select_option;
                                      $data['col_width'] = "col-md-9";
                                      $this->load->view( 'includes/Membership-input', $data);
                                    ?>
                                </div>
                              </div>
                          </div>
                      </div>

<!-- controller youraccount -->

                      <ul class="list-inline pull-right">
<!--                            <li><button type="button" 
                                      class="btn btn-default next-step">Skip</button></li>
 -->
                          <li><button type="button" 
                                      class="btn btn-default"
                                      name ="fld_group1"
                                      id ="fld_group1"
                                      >Save and Exit</button></li>                                                              
                          <li><button type="button"  
                                      name="submit-data1"
                                      id="submit-data1" 
                                      class="btn btn-primary">Save and continue</button></li>
                      </ul>
                  </div>

<!-- Begin step 2 -->                  
                  <div class="tab-pane" role="tabpane2" id="step2">
                       <div class="step1">
                          <div class="step_21">
                              <div class="row">
                                <!-- col-md-2 -->
                                <div class="col-md-2">&nbsp;</div>  

                                <!-- col-md-8 -->
                                <div class="col-md-8">
                                    <?php 
                                      // $data['fldName'] = 'spouse';
                                      // $data['fldNameAdd'] = ''; // Not needed
                                      $data['fld_group'] = $fld_group4;
                                      $data['icon']="user";
                                      $data['cl']="btn btn-info btn-md";
                                      $data['cl_form']="form-group";
                                      $data['top_line'] ="Member personal details here.................................";

                                      $data['Select_option'] =$Select_option;
                                      $this->load->view( 'includes/Membership-input-profile', $data);
                                    ?>

                                    <div class="form-group">
                                      <div class="col-md-3 no_padding"><br><label>Physical Profile</label></div>
                                      <div class="col-md-9">
                                            <div class="row">

                                              <div class="col-sm-3 font-smaller"><label>Height</Label>
                                                <input type="text" class="form-control"
                                                       placeholder="<?= $fld_group4[2]['placeholder'] ?>"
                                                       name="<?= $fld_group4[2]['field'] ?>" 
                                                       value="<?= $fld_group4[2]['input_value'] ?>" />             
                                              </div>
                                              <div class="col-sm-3 font-smaller"><label>Weight</Label>
                                                <input type="text" class="form-control"
                                                       placeholder="<?= $fld_group4[3]['placeholder'] ?>"
                                                       name="<?= $fld_group4[3]['field'] ?>" 
                                                       value="<?= $fld_group4[3]['input_value'] ?>" />
                                              </div>
                                              <div class="col-sm-3 font-smaller"><label>Hair Clr</Label>
                                                <input type="text" class="form-control"
                                                       placeholder="<?= $fld_group4[4]['placeholder'] ?>"
                                                       name="<?= $fld_group4[4]['field'] ?>" 
                                                       value="<?= $fld_group4[4]['input_value'] ?>" />
                                              </div>
                                              <div class="col-sm-3 font-smaller"><label>Eye Clr</Label>
                                                <input type="text" class="form-control"
                                                       placeholder="<?= $fld_group4[5]['placeholder'] ?>"
                                                       name="<?= $fld_group4[5]['field'] ?>" 
                                                       value="<?= $fld_group4[5]['input_value'] ?>" />
                                              </div>

                                            </div>           
                                      </div>
                                    </div>

                                    <?php 
                                      $data['start'] = 0;
                                      $data['end']   = count($fld_group2);
                                      $data['fld_group'] = $fld_group2;
                                      $data['Select_option'] =$Select_option;
                                      $data['col_width'] = "col-md-9";
                                      $this->load->view( 'includes/Membership-input', $data);
                                    ?>

                                    <?php 
                                      $data['fld_pos'] = array(6,7,8,9,10);
                                      $data['fld_group'] = $fld_group4;
                                      $data['icon']="user";
                                      $data['class']  = "btn btn-info btn-md";
                                      $data['top_line'] ="Spouse's info here.................................";

                                      $this->load->view( 'includes/Membership-input-spouse-children', $data);
                                    ?>

                                    <?php 
                                      // Use the site_user/partial_children view file to list children

                                      $data['user_children_data'] = $user_children_data;
                                      $this->load->view('site_users/partial_children', $data);
                                    ?>

                                </div>
                            </div>
                          </div>
                      </div>

                      <!-- col-md-2 -->
                      <div class="col-md-2">&nbsp;</div>  
                      <ul class="list-inline pull-right">
                          <li><button type="button" class="btn btn-default prev-step">Previous</button></li>

                          <li><button type="button" 
                                      name ="fld_group2"
                                      id ="fld_group2"                          
                                      class="btn btn-default">Save and Exit</button></li>                                                                                
                          <li><button type="button"  name="submit-data2" id="submit-data2" class="btn btn-primary">Save and continue</button></li>
                      </ul>
                  </div>

<!-- Begin step 3 -->
                    <div class="tab-pane" role="tabpane3" id="step3">
                       <div class="step1">
                          <div class="step_21">
                              <div class="row">
                                <!-- col-md-2 -->
                                <div class="col-md-3">&nbsp;</div>  

                                <!-- col-md-6 -->
                                <div class="col-md-6">
                                    <h4>LE Job information goes here</h4>
                                    <?php 
                                      $data['start'] = 0;
                                      $data['end']   = 14;
                                      $data['fld_group'] = $fld_group3;
                                      $data['Select_option'] =$Select_option;
                                      $data['col_width'] = "col-md-9";
                                      $this->load->view( 'includes/Membership-input', $data);
                                    ?>

                                    <!-- These fields will not be validated as long as they are not visible -->
                                    <div id="jobInfo" style="display: none;">
                                    <?php 
                                      echo '<h4>Private Sector information goes here</h4>';
                                      $data['start'] = 14;
                                      $data['end']   = count($fld_group3);
                                      $data['fld_group'] = $fld_group3;
                                      $data['Select_option'] =$Select_option;
                                      $data['col_width'] = "col-md-9";
                                      $this->load->view( 'includes/Membership-input', $data);
                                    ?>
                                    </div>

                                </div>

                                <!-- col-md-2 -->
                                <div class="col-md-3">&nbsp;</div>  

                              </div>
                          </div>
                      </div>

                        <ul class="list-inline pull-right">
                            <li><button type="button"
                                        class="btn btn-default prev-step">Previous</button></li>

                            <li><button type="button"
                                        class="btn btn-default"
                                        name="fld_group3"
                                        id="fld_group3" 
                                        >Save and exit</button></li>

                            <li><button type="button"
                                        class="btn btn-primary"
                                        name="submit-data3"
                                        id="submit-data3" 
                                        >Save and continue</button></li>
                        </ul>
                    </div>

<!-- Form is completed -->     

                    <div class="tab-pane" role="tabpanel" id="complete">
                        <div class="step33">
                          <div class="row">
                              <div class="col-md-2">&nbsp;</div>
                              <div class="col-md-8">                        
                                  <h3>Congratulations! Your membership application is now completed.</h3>
                                  <p>We are almost finished with the enrollment process.</p> 
                                  <p>Please scan and upload the following items:</p>

                                  <?php if($is_law_officer) : ?>
                                    <ul>
                                        <li>Law Enforcement Id Card front and back</li>
                                        <li>Drivers License front and back</li>
                                        <li>Passport size color picture for your ID Card</li>
                                        <li>Right Thumb Fingerprint</li>
                                    </ul>
                                  <?php else: ?>                                  
                                    <ul>
                                        <li>Picture Card front and back</li>
                                        <li>Passport size color picture for your ID Card</li>
                                        <li>Right Thumb Fingerprint</li>
                                    </ul>
                                  <?php endif; ?>

                              </div>
                          </div>
                          <div class="col-md-4 pull-right" style="margin-top: 25px;">
                              <a href="<?= base_url() ?>site_users/member_upload" class="btn btn-primary btn-lg">
                                  Go to upload page</a>
                              <a href="youraccount/logout" class="btn btn-primary btn-lg">
                                  Save and Exit </a>
                        </div>
                      </div>
                    </div> <!--  -->

                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>

