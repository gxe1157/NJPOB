							<div class="form-group">
							  <label for="<?= $key ?>" class="col-sm-4 col-md-4 control-label">
							  		<?= $labels[$key] ?>
 					  		  </label>
							  <div class="col-sm-6 col-md-5 inputGroupContainer">
							  	<div class="input-group" style="width: 50%; margin-left: 7px;">
			                        <span class="input-group-addon">
			                          <i class="glyphicon glyphicon-user"></i>
			                        </span>
		                            <?php
		                              $additional_dd_code = 'class="form-control"';
		                              $additional_dd_code .=' id="'.$key.'"';

		                              echo form_dropdown(
		                                    $key,
											$Select_option[ $pos[1] ],
		                                    $columns->$key, // selected option value
		                                    $additional_dd_code);
		                            ?>
	                        	</div>
							  </div>
							</div>  