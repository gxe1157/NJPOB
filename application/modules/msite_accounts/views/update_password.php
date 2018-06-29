<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;	
	$form_location = base_url().$this->uri->segment(1)."/update_password/".$update_id;
?>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span><?= $headtag ?></h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">

			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
				<fieldset>			    
					<div class="control-group">
					  <label class="control-label" for="typeahead">Password </label>
					  <div class="controls">
						<input type="password" class="span6" name = "password">
					  </div>
					</div>
					<div class="control-group">
					  <label class="control-label" for="typeahead">Confirm Password</label>
					  <div class="controls">
						<input type="password" class="span6" name = "confirm_password">
					  </div>
					</div>
					<div class="form-actions">
					  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
					  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
					</div>

			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->

