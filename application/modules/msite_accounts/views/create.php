
<?php
	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}
	
	$form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
?>

<?php if( !is_numeric($update_id) ) { ?>
	<div class="row">
		<div class="col-md-12">
		<h2 style="margin-top: -10px;"><small><?= $default['headline'] ?></small></h2>				
			<div class="well well-sm">
				<a href="<?= base_url().$this->uri->segment(1) ?>/update_password/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Password</button></a>
				<a href="<?= base_url().$this->uri->segment(1) ?>/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Account</button></a>
			</div>
		</div><!-- end 12 span -->
	</div><!-- end row -->
<?php } else { ?>
	<div class="well  well-sm">
		<h2 style="margin-top: 0px;"><small>Create Account</small></h2>		
	</div>	
<?php } ?>

<div class="row">
	<div class="col-md-12">
	<?= validation_errors("<p style='color: red;'>", "</p>") ?>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
				<fieldset>			    
					<?php
						foreach( $columns as $key => $value ) {
							if( in_array($key, $columns_not_allowed ) === false ) {

						if($labels[$key] == "Comments"){ ?>
							<div class="form-group">
			  				  <label for="page_content"
							   		class="col-sm-2 col-md-3 control-label"> <?= $labels[$key] ?>
							  </label>	

							  <div class="col-sm-6 col-sm-offset-0 col-md-5">
								<textarea class="form-control" id="page_keywords"
								 							   rows="3" name = "page_keywords">
								    <?= nl2br( $columns['comment'] ) ?>
							    </textarea>
							  </div>
							</div>
						<?php }	else { ?>	
							<div class="form-group">
							  <label class="col-sm-2 col-md-3 control-label"
							  		 for="typeahead"><?= $labels[$key] ?></label>							
							  <div class="col-sm-4 col-md-5 col-lg-5">
								<input type="text"
									   class="form-control"
									   id="<?= $key ?>"
									   name="<?= $key ?>" 
									   value="<?= $value ?>">
							  </div>
							</div>
						<?php } ?>	
			    	<?php } } ?>

					<div class="form-actions">
					  <div class="col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-3">	
						  <button type="submit" class="btn btn-primary"
						  		  name="submit" value="Submit">Submit</button>
						  <button type="submit" class="btn" 
						  		  name="submit" value="Cancel">Finished</button>
					  </div>
					</div>
			  </fieldset>
 			</form>   
		</div>
	</div><!--/span-->
</div><!--/row-->