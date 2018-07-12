<?php
	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}
?>

<h2 style="margin-top: -5px;"><small><?= $default['headline'] ?></small></h2>
<p style="margin-top: 30px,">
	<a href="<?= base_url().$this->uri->segment(1) ?>/create" >
		<button type="button" class="btn btn-primary"><?= $default['add_button'] ?></button>
	</a>
</p>

<div class="row">		
	<div class="col-md-12">
	<?= validation_errors("<p style='color: red;'>", "</p>") ?>
	
			<table id="example" class="table table-striped table-bordered"
				   cellspacing="0" width="100%">
			  <thead>
				  <tr>
					  <th>Type</th>
					  <th>Plan Name</th>
					  <th>Date Created</th>
					  <th>Image</th>					  
					  <th>Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

					<?php
						foreach( $columns->result() as $row ) {
				    	 	$remove = base_url().$this->uri->segment(1).'/delete/'.$row->id;
				    	 	$edit_url = base_url().$this->uri->segment(1)."/create/".$row->id;
							$image_status = !empty($row->mem_plan_level) ? 'Uploaded':'Pending'; 
							$create_date = convert_timestamp($row->create_date, 'datepicker_us'); ?>
						<tr>
							<td class="right"><?= $row->mem_plan_level ?></td>
							<td class="right"><?= $row->form_header ?></td>
							<td class="right"><?= $create_date ?></td>
							<td class="right"><?= $image_status ?></td>


							<td >
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

</div><!--/row-->
