<!-- include in Become-A-Member.php -->

    <div class="<?= $cl_form ?>">
          <div class="row">
            <div class="col-md-12 section_header">
                 <p><?= $top_line ?></p>
            </div>

             <div class="col-md-1 no_padding">
                <button type="button" class="<?= $cl ?>">
                  <span class="glyphicon glyphicon-<?= $icon ?>" aria-hidden="true"></span>
                </button>             
             </div>           
             <div class="col-md-11">
               <div class="row"> 
                 <div class="col-sm-3 no_padding font-smaller">
                    <input type="text" class="form-control classname"
                           value="Date of Birth" readonly />
                 </div>
                 <div class="col-sm-3 no_padding font-smaller">
                    <input type="text" class="form-control"
                           placeholder='MM/DD/YYYY'
                           value="<?= $fld_group[0]['input_value'] ?>"
                           name="<?= $fld_group[0]['field'] ?>"
                           id="<?= $fld_group[0]['field'] ?>"/>             
                 </div>
                 <div class="col-sm-3 no_padding font-smaller">
                    <input type="text" class="form-control classname"
                           value="Gender" readonly />
                 </div>
                 <div class="col-sm-3 no_padding font-smaller">
                        <?php
                          $additional_dd_code = 'class="form-control"';
                          $additional_dd_code .=' id="'.$fld_group[1]['field'].'"';
                          //form_dropdown('status', $options, $selected_value, $additional_dd_code);                                  
                          echo form_dropdown(
                              $fld_group[1]['field'],
                              $Select_option[ $fld_group[1]['input_options'] ],
                              $fld_group[1]['input_value'], // selected option value
                              $additional_dd_code);
                        ?>
<!--                                              
                      <select class="form-control" name="gender" id="">
                          <option value=''>Select</option>
                          <option value='male'>Male</option>
                          <option value='female'>Female</option>
                          <option value='other'>Other</option>                          
                      </select>
 -->                 </div>
                </div> 
             </div>
          </div>           
    </div>
