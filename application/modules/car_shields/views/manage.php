
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}

	$admin_mode = $default['admin_mode'] == 'admin_portal' ? 0 : 1

?>

<?php if( $default['admin_mode'] == 'admin_portal' ) { ?>
	<h2 style="margin-top: -5px;"><small><?= $default['page_title'] ?></small></h2>
<?php } ?>


<style>
.car_shield_button{
   margin-top: 2px; text-align: left; width: 75px; font-size: 12px; padding: 2px; }
</style>


<!-- Memeber Detail Panel -->
<div class="row">
    <?php if( $default['admin_mode'] == 'admin_portal' ) {
        $this->load->view('default_module/admin_banner'); } ?>
</div>
<!-- // Memeber Detail Panel -->

<div class="row">
	<div style="padding: 0px 0px 10px 20px;">
	    <button id="add_car_shield" type="button" class="btn btn-primary" >Add New Car Shield</button>
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
					  <th style="width: 10%;">Status</th>
					  <th style="width: 16%;">Vehicle</th>
					  <th style="width: 5%;">Date</th>
					  <th style="width: 25%;">Required Documents</th>					  
					  <th style="width: 10%;">--</th>					  
				  </tr>
			  </thead>
			  <tbody>

			    <?php
			    	// checkArray($columns->result(),1);
			    	foreach( $columns->result() as $row ){
			    	 	$edit_url = $row->id.'/'.$row->user_id;
			    	 	$upload = base_url().'car_shields/car_shield_upload/'.$row->id;
			    	 	$remove = $redirect_base.'/delete/'.$row->id;
			    	 	$car_shield_status = $redirect_base.'/status/'.$row->id;    
			    	 	$status = empty($row->shield_no) ? 'Pending' : $row->shield_no; 
			    	 	$date_assigned = convert_timestamp($row->create_date, 'datepicker_us');
			    ?>
						<tr>
							<td ><?= $status ?></td>
							<td >Make: <?= $row->make ?><br>
								 Model: <?= $row->model ?><br>
								 Plate No: <?= $row->plate_no ?>
							</td>
							<td ><?= $date_assigned ?></td>					
							<td ><?= $document_status[$row->id]; ?></td>							
							<td>
								<ul style="list-style-type: none; margin: 0; padding: 0;">
									<li>
										<a class="btn btn-danger btn-sm btnConfirm car_shield_button"
										   id="delete-danger"
									   	   href="<?= $remove ?>">
									  	<i class="fa fa-trash-o fa-fw"></i> Remove
										</a>
									</li>
									</li>										
										<a class="btn btn-info btn-sm car_shield_button"
										   id="upload"
									   	   href="<?= $upload ?>">
									  	<i class="fa fa-upload fa-fw"></i> upload
										</a>
									</li>
									<li>
										<a class="btn btn-info btn-sm btn-edit car_shield_button"
										   id="edit-<?= $edit_url ?>"
									   	   href="<?= $edit_url ?>">
									  	<i class="fa fa-pencil fa-fw"></i> Edit
										</a>
									</li>
								</ul>
							</td>							
						</tr>
			    <?php } ?>
      			<input type="hidden" id="num_rows" value="<?= count($columns->result()) ?>">

			  </tbody>
		  </table>
	</div><!--/span-->
	<form id="params">
		<input type="hidden" name="base_url" id="base_url" value="<?= $base_url ?>" />
		<input type="hidden"  id="max_shields" name="max_shields" value="<?= $max_shields ?>">
		<input type="hidden" id="set_dir_path" value = "<?php echo $admin_mode ?>" >	
		<input type="hidden" id="dl_required" value = "<?php echo $dl_required ?>" >		
		<input type="hidden" id="ss_required" value = "<?php echo $ss_required ?>" >
	</form>
</div><!--/row-->
