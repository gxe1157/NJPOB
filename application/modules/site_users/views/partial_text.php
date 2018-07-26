			                <div class="form-group"  style="margin: 5px;">
			                  <label for="<?= $key ?>" class="col-sm-4 col-md-4 control-label"><?= $labels[$key] ?></label>

			                  <div class="col-sm-6 col-md-5 inputGroupContainer">
			                      <div class="input-group">
			                        <span class="input-group-addon">
			                          <i class="glyphicon glyphicon-user"></i>
			                        </span>
			                    	<input type="<?= $type ?>"
			                    		   id="<?= $key ?>"
			                    		   name="<?= $key ?>" 
			                    		   class="typeahead form-control"
										   autocomplete="autocomplete-off"                    		   
			                    		   value="<?= $columns->$key ?>">
			                        </div>

			                        <!-- Show errors here -->
			    				  	<span class="<?= $key ?> clear_error_mess"
								  		  style="color: red; text-align: left;"></span>

			                  </div>
			                </div>
