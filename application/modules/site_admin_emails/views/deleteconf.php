
<div class="row">
	<div class="col-md-12">
		<div class="container">
			<h2 style="margin-top: -5px;"><small>Delete Email Details</small></h2>		
			<p>Are you sure that you want to delete the email?</p>

			<?php echo form_open_multipart( base_url().$this->uri->segment(1).'/delete/'.$update_id,
											array('class' => 'form-horizontal') ); ?>
			  	<fieldset>
					<div class="control-group">
							<button type="submit" class="btn btn-danger" name="submit" value="Yes - Delete Email">Yes - Delete Email.</button>
							<button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
					</div>          
			  </fieldset>
			</form>   
		</div>
	</div><!-- end 12 span -->
</div><!-- end row-fluid sortable -->