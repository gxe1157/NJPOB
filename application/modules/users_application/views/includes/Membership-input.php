<!-- include in Become-A-Member.php -->
<!-- <?= dd($fld_group,1) ?> -->

          <?php for( $i = $start; $i<$end; $i++ ) { ?>



            <!-- Select input-->
            <div class="row">
            
            <?php if ( $fld_group[$i]['input_type'] == 'drop_down_sel'): ?>

                <div class="form-group">
                <label class="col-md-3 control-label"><?= $fld_group[$i]['label'] ?></label>                
                <div class="<?= $col_width ?>" >
                    <div class="input-group input-group-md">
                    <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"> </i></span>
                        <div class="input-group-btn ">
                            <button tabindex="-1" class="btn btn-default" type="button">
                              <?= $fld_group[$i]['placeholder'] ?>
                            </button>
                        </div>
                            <?php
                              $additional_dd_code = 'class="form-control"';
                              $additional_dd_code .=' id="'.$fld_group[$i]['field'].'"';
                              //form_dropdown('status', $options, $selected_value, $additional_dd_code);                                  
                              echo form_dropdown(
                                    $fld_group[$i]['field'],
                                    $Select_option[ $fld_group[$i]['input_options'] ],
                                    $fld_group[$i]['input_value'], // selected option value
                                    $additional_dd_code);
                            ?>

                    </div>
                </div>
                </div>     
 
            <?php else: ?>
                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-3 control-label"><?= $fld_group[$i]['label'] ?></label>
                  <div class="<?= $col_width ?> inputGroupContainer">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-<?= $fld_group[$i]['icon'] ?>"></i>
                        </span>
<?php
if($fld_group[$i]['field'] == '')
?>
                        <input  name="<?= $fld_group[$i]['field'] ?>" 
                                value="<?= $fld_group[$i]['input_value'] ?>"
                                id = "<?= $fld_group[$i]['field'] ?>" 
                                placeholder="<?= $fld_group[$i]['placeholder'] ?>"
                                class="form-control"
                                type="<?= $fld_group[$i]['input_type'] ?>">
                      </div>
                      <!-- Report error here -->
                      <div class="<?= $fld_group[$i]['field'] ?>_error_mess"></div> 

                  </div>
                </div>
            <?php endif ?>  
            </div>                

          <?php } ?>
