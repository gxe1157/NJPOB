
<?php
	if( isset( $default['flash']) ) {
	    echo $this->session->flashdata('item');
	    unset($_SESSION['item']);
	}

	$form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
?>

<?php if( is_numeric($update_id) ) { ?>
	<div class="row">
		<div class="col-md-12">
		<h2 style="margin-top: -5px;"><small><?= $default['page_header'] ?></small></h2>		
			<div class="well">
  				<a class ="btnConfirm " id="delete-danger"
     			   href="<?= base_url().$this->uri->segment(1) ?>/delete/<?= $update_id ?>/<?= $default['username'] ?>">
    			<button type="button" class="btn btn-danger">Delete Account</button></a>
			</div>
		</div><!-- end 12 span -->
	</div><!-- end row -->
<?php } else { ?>
	<div class="well  well-sm">
		<h2 style="margin-top: 0px;"><small><?= $default['page_header'] ?> </small></h2>		
	</div>	
<?php } ?>


<div class="row">
	<div class="col-md-12">
			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
				<fieldset>			    
					<?php
						foreach( $columns as $key => $value ) {
							if( in_array($key, $columns_not_allowed ) === false ) {

							switch ($fld_data[$key]['input_type']) {
							    case 'textarea': ?>
									<div class="form-group">
					  				  <label for="page_content"
									   		class="col-sm-2 col-md-3 control-label">
									   		<?= $fld_data[$key]['label'] ?>
									  </label>	

									  <div class="col-sm-6 col-sm-offset-0 col-md-6">
										<textarea class="cleditor"
										          id="textarea2"
												  rows="3"
												  name = "body">
													  <?= nl2br($value) ?>
										</textarea>
					                    <!-- Show errors here -->
			        		            <div style="color: red; ">
			        		            	<?php echo form_error($key); ?>
			        		            </div>
									  </div>
									</div>
							<?php   break;
								    case 'select': ?>
										<div class="form-group">
										  <label for="<?= $key ?>"
										  		 class="col-sm-2 col-md-3 control-label"><?= $fld_data[$key]['label'] ?></label>

										  <div class="col-sm-4 col-md-4 col-lg-4">
												<?php
													$additional_opt = ' id = status class="form-control"';
													$options = array(
													        '' => 'Please Select....',
													        '0' => 'Active',
													        '1' => 'Inactive',
													);
													echo form_dropdown('status', $options, $columns['status'], $additional_opt);
													?>
								                    <!-- Show errors here -->
						        		            <div style="color: red; ">
						        		            	<?php echo form_error($key); ?>
						        		            </div>
											</div>						
							     		</div>
							<?php   break;
  								    default: ?>

									<div class="form-group">
									  <label for="<?= $key ?>"
									  		 class="col-sm-2 col-md-3 control-label"><?= $fld_data[$key]['label'] ?></label>

									  <div class="col-sm-4 col-md-4 col-lg-4">
			                        	<input type="text"
			                        		   id="<?= $key ?>"
			                        		   name="<?= $key ?>" 
			                        		   class="form-control"
			                        		   value="<?= $value ?>">
					                    <!-- Show errors here -->
			        		            <div style="color: red; ">
			        		            	<?php echo form_error($key); ?>
			        		            </div>
									  </div>
									</div>

							<?php   break;
							} // switch

			    	} } // foreach ?>

					<div class="col-sm-6 col-sm-offset-4 col-md-6 col-md-offset-3">
		                <ul class="list-inline">
			                <li><button type="submit" class="btn btn-primary"
			                			name="submit" value="Submit">Submit</button></li>                                                              
			                <li><button type="submit" class="btn" 
			                			name="submit" value="Cancel">Cancel</button></li>
		            	</ul>
		            </div>	
			  </fieldset>
			</form>   
	</div><!--/span-->

</div><!--/row-->