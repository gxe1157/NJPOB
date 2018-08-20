<?php
	if( isset( $default['flash']) ) {
		echo $this->session->flashdata('item');
		unset($_SESSION['item']);
	}
?>
<div class="row">
	<div style="padding: 0px 0px 10px 20px;">
	<h2 style="margin-top: -5px;"><small><?= $default['headline'] ?></small></h2>		
		<a href="<?= base_url().$this->uri->segment(1) ?>/create" >
			<button type="button" class="btn btn-primary"><?= $default['add_button'] ?></button>
		</a>

		<a href="<?= $cancel_button_url ?>" >
			<button type="button" class="btn btn-default">Cancel</button>
		</a>
	</div>
</div>	

<div class="row">		
	<div class="col-md-12">
			<table id="example" class="table table-striped table-bordered"
				   cellspacing="0" width="100%">

			  <thead>
				  <tr>
					  <th>Ad Tile</th>
					  <th>Ad Size</th>
					  <th>Price</th>
					  <th>Status</th>
					  <th>xxx</th>
					  <th>Actions</th>
				  </tr>
			  </thead>
			  <tbody>

			    <?php
			    	 foreach( $columns->result() as $row ){
			    	 	$edit_url = $redirect_url."/create/".$row->id;
			    	 	$remove = $redirect_url."/delete/".$row->id;			    	 	
			    	 	$status = $row->status;
			    	 	if( $status == 1) {
			    	 		$status_label = "success";
			    	 		$status_desc  = "Active";
			    	 	} else {
			    	 		$status_label = "defaults";
			    	 		$status_desc  = "Inactive";
			    	 	}
			    ?>
						<tr>
							<td class="right"><?= $row->item_title ?></td>
							<td class="right"><?= $row->ad_id ?></td>
							<td class="right"><?= $row->item_price ?></td>
							<td class="center">
								<span class="label label-<?= $status_label ?>"><?= $status_desc ?></span>
							</td>
							<td class="center">
								<span class="label label-<?= $status_label ?>">xxx</span>
							</td>
							<td class="text-right">
								<a class="btn btn-danger btn-sm btnConfirm" id="delete-danger"
							   	style="margin-top: 2px; width: 75px; font-size: 12px; padding: 2px;"
							   	href="<?= $remove ?>">
							  	<i class="fa fa-trash fa-fw"></i> Remove
								</a>
								<a class="btn btn-info btn-sm" style="font-size: 12px; padding: 0px 5px 0px 0px;" href="<?= $edit_url ?>">
									<i class="fa fa-pencil fa-fw"></i> Edit
								</a>
							</td>
						</tr>
			    <?php } ?>

			  </tbody>
		  </table>

	</div><!--/span-->

</div><!--/row-->
