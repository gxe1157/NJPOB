<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}

	$admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1;
	$redirect_base = base_url().$this->uri->segment(1);
?>

<?php if( $default['admin_mode'] == 'admin_portal' ) { ?>
	<h2 style="margin-top: -5px;"><small><?= $default['page_title'] ?></small></h2>
<?php } ?>

<!-- Memeber Detail Panel -->
<div class="row">
	<?php if( $default['admin_mode'] == 'admin_portal' )
          $this->load->view( 'default_module/admin_banner')  ?>
</div>
<!-- // Memeber Detail Panel -->

<div class="row">
	<div style="padding: 0px 0px 10px 20px;">
	    <a 
	       id="Business Network"
	       href="<?= base_url() ?>business_listings/create">
	      <button type="button" class="btn btn-primary">Add New Business</button>
	    </a>
		<a href="<?= $cancel_button_url ?>" >
			<button type="button" class="btn btn-default">Cancel</button>
		</a>
	</div>
</div>	

<div class="row">		
	<div class="col-md-12">

			<table id="example" class="table table-striped table-bordered">
			 <thead>
				  <tr>
					  <th style="width: 16%;">Business Name</th>
					  <th style="width: 16%;">Category</th>
					  <th style="width: 16%;">specialization</th>	  
					  <th style="width: 16%;">Location</th>
					  <th style="width: 20%;">--</th>					  
				  </tr>
			  </thead>
			  <tbody>

			    <?php
			    	// checkArray($columns->result(),1);
			    	// checkArray($bus_categories,1);			    	
			    	foreach( $columns->result() as $row ){
			    	 	$edit_url = $redirect_base.'/create/'.$row->id;
			    	 	$remove = $redirect_base.'/delete/'.$row->id;
			    	 	$location = $row->city.", ".$row->state;
			    	 	$date_assigned = convert_timestamp($row->create_date, 'datepicker_us');
			    ?>
						<tr>
							<td ><?= $row->business ?></td>
							<td ><?= $bus_categories[$row->bus_category] ?></td>
							<td ><?= $row->specialization ?></td>					
							<td ><?= $location ?></td>

							<td style="width: 20%;">
								<a class="btn btn-danger btn-sm btnConfirm" id="delete-danger"
							   	style="margin-top: 2px; width: 75px; font-size: 12px; padding: 2px;"
							   	href="<?= $remove ?>">
							  	<i class="fa fa-trash fa-fw"></i> Remove
								</a>
								<a class="btn btn-info btn-sm btn-edit"
								   id="edit-<?= $edit_url ?>"
							   	   style="margin-top: 2px; width: 75px; font-size: 12px; padding: 2px;"
							   	   href="<?= $edit_url ?>">
							  	<i class="fa fa-pencil fa-fw"></i> Edit
								</a>
							</td>						
						</tr>
			    <?php } ?>

			  </tbody>
		  </table>
	</div><!--/span-->

	<form id="params">
 		<input type="hidden" name="base_url"  id="base_url" value="<?= base_url() ?>" />
		<input type="hidden" id="set_dir_path" value = "<?php echo $admin_mode ?>" >	
		<input type="hidden" id="dl_required" value = "<?php echo $dl_required ?>" >		
		<input type="hidden" id="ss_required" value = "<?php echo $ss_required ?>" >
	</form>
</div><!--/row-->
