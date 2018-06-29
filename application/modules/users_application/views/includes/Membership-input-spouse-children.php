
    <div class="form-group">
       <div class="row">
            <div class="col-md-12 section_header">
                   <p><?= $top_line ?></p>
            </div>

            <div class="col-md-1 no_padding">
                <button type="button" class="<?= $class ?>" >
                  <span class="glyphicon glyphicon-<?= $icon ?>" aria-hidden="true"></span>
                </button>             
            </div>           

            <div class="col-md-11 <?= $class_div ?>">
              <div class="row "> 
                <?php foreach($fld_pos as $value) { ?>

                  <?php if( $fld_group[$value]['input_type'] == 'text' ) { ?>
                      <div class="col-sm-3 no_padding font-smaller">
                          <input class="form-control"
                                 type ="text"                        
                                 placeholder="<?= $fld_group[$value]['label'] ?>" 
                                 name  ="<?= $fld_group[$value]['field'] ?>"
                                 id ="<?= $fld_group[$value]['field'] ?>"
                                 value ="<?= $fld_group[$value]['input_value'] ?>"
                                 />             
                      </div>
                      
                      <div id="child_message"></div>

                  <?php } ?>

                  <?php if( $fld_group[$value]['input_type'] == 'drop_down_sel' ) { ?>
                    <div class="col-sm-3 no_padding font-smaller">
                          <?php

                            $additional_dd_code = 'class="form-control"';
                            $additional_dd_code .=' id="'.$fld_group[$value]['field'].'"';
                            //form_dropdown('status', $options, $selected_value, $additional_dd_code);                                  
                            echo form_dropdown(
                                  $fld_group[$value]['field'],
                                  $Select_option[ $fld_group[$value]['input_options']],
                                  $fld_group[$value]['input_value'], // selected option value
                                  $additional_dd_code);
                          ?>
                     </div>
                  <?php } ?>


                <?php } ?>
              </div>
            </div> 

        </div>          
    </div>
